<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class OrderRepository extends EntityRepository
{

	/**
     * Create new data for order 
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return integer
     */
	public function createOrder($data)
	{
		$order = new \App\Entity\Commerce\Order();
		try {

			$order->setCompanyId($data['company_id']);
			$order->setObjectId($data['object_id']);
			$order->setUserId($data['user_id']);
			$order->setOrderStatusId(1);
			$this->_em->persist($order);
			$this->_em->flush();

			//Log activity
			$this->addLog(array(
					'user_id' => $data['user_id'],
					'company_id' => $data['company_id'],
					'data' => 'You created new order for object id '.$data['object_id'].' with order id '.$order->getId().'.',
					'category' => 'order',
					'action' => 'create' 
				));

			return $order->getId();

		} catch (Exception $e) {
			return 0;
		}
	}


	/**
     * This function gets all the orders with orderlines for displaying in cemos portal
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return array
     */
	public function getOrders($objId)
	{
		$orderLines = array();
		$orderArray = array();
		$orderPRepo = $this->_em->getRepository('App\Entity\Commerce\OrderProduct');
		$objectRepo = $this->_em->getRepository('App\Entity\Realestate\Object');
		$ordersByObject = $this->getOrdersByObjId($objId);
		$objDetails  = $objectRepo->getObjectByid($objId);

		if(!empty($ordersByObject)) {
			foreach ($ordersByObject as $key => $value) {
				$orderArray[] = $orderPRepo->getOrderProductByOrderId($value['id']);
			}
		}

		if(!empty($orderArray)){
			foreach ($orderArray as $key => $value) {
				foreach ($value as $key2 => $value2) {
					$orderLines[] = $value2;
				}
				
			}
		}
	
		return array('orderData'=>$orderLines,'objData' => $objDetails);

	}

	/**
	* This function can be reusable to get all the orders by objId
	* @author Gladys Vailoces
	* @return array
	*/
	public function getOrdersByObjId($objId)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('o')
		   ->from('App\Entity\Commerce\Order', 'o')
		   ->where('o.objectId = :objId')
		   ->setParameter('objId', $objId);

		$queryResult = $qb->getQuery()->getArrayResult();
		if(!empty($queryResult)) {
			return $queryResult;
		} 
		return array();
	}

	/**
	* Fetch all orders
	* @author Gladys Vailoces
	* @return array
	*/
	public function getAllOrders()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('o.id, c.name as company, u.firstName, u.lastName, o.createdAt, s.name as status, p.name as objectName, p.address1, p.town, p.country, p.zipcode')
		   ->from('App\Entity\Commerce\Order', 'o')
		   ->leftJoin('App\Entity\Management\Company','c','WITH','c.id = o.companyId')
		   ->leftJoin('App\Entity\Management\User','u','WITH','u.id = o.userId')
		   ->leftJoin('App\Entity\Commerce\Status','s','WITH','s.id = o.orderStatusId')
		   ->leftJoin('App\Entity\Realestate\Object','p','WITH','p.id = o.objectId');

		$queryResult = $qb->getQuery()->getArrayResult();
		if(!empty($queryResult)) {
			foreach ($queryResult as $key => $value) {
				$queryResult[$key]['createdAt'] = $value['createdAt']->format('c');
			}
			return $queryResult;
		} 
		
		return array();
	}

	/**
     * Get order By Id
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $id
     * @return array
     */
	public function getOrderById($id)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('o.id, o.objectId as objectId, c.name as company, u.firstName, u.lastName, o.createdAt, s.name as status, p.name as objectName, p.slug, p.address1, p.town, p.country, p.zipcode')
		   ->from('App\Entity\Commerce\Order', 'o')
		   ->leftJoin('App\Entity\Management\Company','c','WITH','c.id = o.companyId')
		   ->leftJoin('App\Entity\Management\User','u','WITH','u.id = o.userId')
		   ->leftJoin('App\Entity\Commerce\Status','s','WITH','s.id = o.orderStatusId')
		   ->leftJoin('App\Entity\Realestate\Object','p','WITH','p.id = o.objectId')
		   ->where('o.id = :id')
		   ->setParameter('id', $id);
		     
		$queryResult = $qb->getQuery()->getSingleResult();

		if(isset($queryResult['id'])) {
			$queryResult['createdAt'] = $queryResult['createdAt']->format('c');

			return $queryResult;
		} 
		
		return array();
	}

	/**
     * Updates order status
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param array $data
     * @return boolean
     */
	public function updateOrderStatus($data)
	{
		$result = $this->_em->find(\App\Entity\Commerce\Order::class, $data['orderId']);
		$orderProductRepo = $this->_em->getRepository('App\Entity\Commerce\OrderProduct');
		if(!empty(array($result))){
			$result->setOrderStatusId($data['id']);
			$this->_em->merge($result);
			$this->_em->flush();

			if($data['id'] == 3){
				$orderProductRepo->updateOrderProductStatusByOrderId(4, $data['orderId']);
			}
			return 1;
		}
		return 0;
	}

	/**
	* Fetch all orders by user id
	* @author Gladys Vailoces
	* @return array
	*/
	public function getSupplierOrderBySupplierUserId($userId)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('o.id, op.id as opId, c.name as company, u.firstName, u.lastName, o.createdAt, s.name as status, p.name as objectName, p.address1, p.town, p.country, p.zipcode, pr.name, op.step, op.productId')
		   ->from('App\Entity\Commerce\Order', 'o')
		   ->leftJoin('App\Entity\Management\Company','c','WITH','c.id = o.companyId')
		   ->leftJoin('App\Entity\Management\User','u','WITH','u.id = o.userId')
		   ->leftJoin('App\Entity\Commerce\Status','s','WITH','s.id = o.orderStatusId')
		   ->leftJoin('App\Entity\Realestate\Object','p','WITH','p.id = o.objectId')
		   ->leftJoin('App\Entity\Commerce\OrderProduct','op','WITH','op.orderId = o.id')
		   ->leftJoin('App\Entity\Commerce\Product','pr','WITH','pr.id = op.productId')
		   ->where('op.supplierUserId = :userId')
		   ->setParameter('userId', $userId);
		     
		$queryResult = $qb->getQuery()->getArrayResult();
		if(!empty($queryResult)) {
			foreach ($queryResult as $key => $value) {
				$queryResult[$key]['createdAt'] = $value['createdAt']->format('c');
			}
			return $queryResult;
		} 
	
		return array();
	}


	/**
	* Fetch all orders by supplier id
	* @author Gladys Vailoces
	* @return array
	*/
	public function getSupplierOrderBySupplierId($supplierId)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('o.id, c.name as company, u.firstName, u.lastName, o.createdAt, s.name as status, p.name as objectName, p.address1, p.town, p.country, p.zipcode, pr.name, op.step, op.productId')
		   ->from('App\Entity\Commerce\Order', 'o')
		   ->leftJoin('App\Entity\Management\Company','c','WITH','c.id = o.companyId')
		   ->leftJoin('App\Entity\Management\User','u','WITH','u.id = o.userId')
		   ->leftJoin('App\Entity\Commerce\Status','s','WITH','s.id = o.orderStatusId')
		   ->leftJoin('App\Entity\Realestate\Object','p','WITH','p.id = o.objectId')
		   ->leftJoin('App\Entity\Commerce\OrderProduct','op','WITH','op.orderId = o.id')
		   ->leftJoin('App\Entity\Commerce\Product','pr','WITH','pr.id = op.productId')
		   
		   
		   ->where('op.supplierId = :supplierId')
		   ->setParameter('supplierId', $supplierId);
		     
		$queryResult = $qb->getQuery()->getArrayResult();
		if(!empty($queryResult)) {
			foreach ($queryResult as $key => $value) {
				$queryResult[$key]['createdAt'] = $value['createdAt']->format('c');
			}
			return $queryResult;
		} 
	
		return array();
	}


	public function getOrderCompanyByOrderId($id)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c')
		   ->from('App\Entity\Commerce\Order','o')
		   ->leftJoin('App\Entity\Management\Company','c', 'WITH', 'c.id = o.companyId')
		   ->where('o.id = :id')
		   ->setParameter('id', $id);

		$queryResult = $qb->getQuery()->getArrayResult();
		if(!empty($queryResult[0])) {
			return array(
				'id' => $queryResult[0]['id'],
				'name' => $queryResult[0]['name']
			);
		}
		return array();
	}

	 /**
     * This logs all activity
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $data 
     * @return boolean
     */
    private function addLog($data)
    {
    	$log = $this->_em->getRepository('App\Entity\Management\CompanyActivityLog');
    	$log->create($data); 
    	return 1;
    }

	

}

?>