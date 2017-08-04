<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class OrderProductRepository extends EntityRepository
{

	/**
     * Create new data for order line
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return boolean
     */
	public function createOrderLine($data, $orderId)
	{
		$oData = get_object_vars($data);

		$dataArray = array();
		if(isset($oData['options'])) {
			foreach ($oData['options'] as $key => $value) {
				$dataArray[$key] = $value;
			}
		}
	
	
		try {
			
			$orderLine = new \App\Entity\Commerce\OrderProduct();
			$orderLine->setQuantity($oData['qty']);
			$orderLine->setPrice($oData['price']);
			$orderLine->setData(serialize($dataArray));
			$orderLine->setStep(1);
			$orderLine->setOrderId($orderId);
			$orderLine->setSupplierId(0);
			$orderLine->setSupplierUserId(0);
			$orderLine->setProductId($oData['id']);
			$orderLine->setOrderProductStatusId(2);
			$this->_em->persist($orderLine);
			$this->_em->flush();

			return 1;

		} catch (Exception $e) {

			return 0;
		}

	}

	/**
     * Get order product by order id
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $orderId
     * @return array
     */
	public function getOrderProductByOrderId($orderId)
	{
		$result = array();
		$repo = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class);
		$productRepo = $this->_em->getRepository(\App\Entity\Commerce\Product::class);
		$statusRepo = $this->_em->getRepository(\App\Entity\Commerce\Status::class);
		$compRepo = $this->_em->getRepository(\App\Entity\Management\Company::class);
		$search = $repo->findBy(array('orderId'=> $orderId));
		if(!empty($search)) {
			foreach ($search as $key => $value) {
				$result[] = array(
					'id' => $value->getId(),
					'quantity' => $value->getQuantity(),
					'price' => $value->getPrice(),
					'data' => unserialize($value->getData()),
					'step' => $value->getStep(),
					'orderId' => $value->getOrderId(),
					'product' => $productRepo->getProductById($value->getProductId()),
					'supplier' => $compRepo->getCompanyById($value->getSupplierId()),
					'supplierUserId' => $value->getSupplierUserId(),
					'status' => $statusRepo->getStatusById($value->getOrderProductStatusId()),
					'createdAt' => $value->getCreatedAt()->format('c'),
				);
			}
		}
		
		return $result;
	}

	/**
     * Updates order product status by order product id
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $statusId
     * @param integer $orderId
     * @param integer $orderPId
     * @return void
     */
	public function updateOrderProductStatusById($statusId = 0, $orderPId = 0, $step = 0)
	{

		$repo = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class);
		$nRepo = $this->_em->getRepository(\App\Entity\Management\Notification::class);

		$result = $repo->find($orderPId);	
		if(!empty(array($result))) {
			if(($result->getProductId() == 10 && $step == 3 ) || ($result->getProductId() == 11 && $step == 3 ) ||
				($result->getProductId() == 1 && $step == 4 ) || ($result->getProductId() == 2 && $step == 4 ) ||
				($result->getProductId() == 3 && $step == 4 ) || ($result->getProductId() == 4 && $step == 4 ) ||
				($result->getProductId() == 5 && $step == 4 ) || ($result->getProductId() == 6 && $step == 4 ) ||
				($result->getProductId() == 8 && $step == 4 ) || ($result->getProductId() == 9 && $step == 4 ) ||
				($result->getProductId() == 7 && $step == 3)  
			) {
				$statusId = 8;
			}
			
			if($statusId == 4){
				$result->setOrderProductStatusId($statusId);
				$result->setSupplierId(0);
				$result->setSupplierUserId(0);
			} else {
				$result->setOrderProductStatusId($statusId);
				$result->setSupplierId(0);
				$result->setSupplierUserId(0);
				$result->setStep($step);
			}
			
			$this->_em->merge($result);
			$this->_em->flush();

			//This checks if the the order status should be updated to delivered if 
			//all the order products under it is delivered.
			$this->checkForUpdateOrderStatus($result->getOrderId());

			if($statusId == 6 ){
				$nRepo->addNotif(array(
						'orderId'=> $result->getOrderId(),
						'productId' => $result->getProductId(),
						'step' => $result->getStep(),
					)
				);
			}
		}
		
	}

	/**
     * Updates order product status by order id: If order is changed to accepted status,change also the status of the order products
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $statusId
     * @param integer $orderId
     * @param integer $orderPId
     * @return void
     */
	public function updateOrderProductStatusByOrderId($statusId = 0, $orderId = 0)
	{
		$repo = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class);
		$results = $repo->findBy(array('orderId'=> $orderId));
		if(!empty($results)) {
			foreach ($results as $key => $value) {
				if($statusId == 4){
					$value->setOrderProductStatusId($statusId);
					$value->setSupplierId(0);
					$value->setSupplierUserId(0);
				} else {
					$value->setOrderProductStatusId($statusId);
					$value->setSupplierId(0);
					$value->setSupplierUserId(0);
				}
				
				$this->_em->merge($value);
				$this->_em->flush();
			}
		}
		
	}

	/**
     * Assigns supplierid to orderproduct
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param array $data
     * @return boolean
     */
	public function assignSupplierMember($data)
	{
		$repoRes = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class)->find($data['id']);
		if(!empty(array($repoRes))) {
			$repoRes->setSupplierUserId($data['supplier']);
			$this->_em->merge($repoRes);
			$this->_em->flush();
			return true;
		}
		return false;

	}

	/**
     * Get list of order product depending on the array of data given, (supplier id, user id, orderproduct id or all)
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param array $data
     * @return array
     */
	public function getCustomOrder($data) 
	{
	
		$result = array();
		$repo = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class);
		$productRepo = $this->_em->getRepository(\App\Entity\Commerce\Product::class);
		$statusRepo = $this->_em->getRepository(\App\Entity\Commerce\Status::class);
		$compRepo = $this->_em->getRepository(\App\Entity\Management\Company::class);
		$userRepo = $this->_em->getRepository(\App\Entity\Management\User::class);
		$orderRepo = $this->_em->getRepository(\App\Entity\Commerce\Order::class);
		if(isset($data['company_id'])) {
			$search = $repo->findBy(array('supplierId'=> $data['company_id']));
		} else if(isset($data['user_id'])) {
			$search = $repo->findBy(array('supplierUserId'=> $data['user_id']));
		} else if(isset($data['op_id'])) {
			$search = $repo->findBy(array('id'=> $data['op_id']));
		} else {
			$result = $this->getOrderProductWithSupplier();
		}
		
		if(!empty($search)) {
			foreach ($search as $key => $value) {
				$result[] = array(
					'id' => $value->getId(),
					'quantity' => $value->getQuantity(),
					'price' => $value->getPrice(),
					'data' => unserialize($value->getData()),
					'step' => $value->getStep(),
					'orderId' => $value->getOrderId(),
					'product' => $productRepo->getProductById($value->getProductId()),
					'supplier' => $compRepo->getCompanyById($value->getSupplierId()),
					'supplierUser' => $userRepo->getSupplierUserById($value->getSupplierUserId()),
					'status' => $statusRepo->getStatusById($value->getOrderProductStatusId()),
					'createdAt' => $value->getCreatedAt()->format('c'),
					'company' => $orderRepo->getOrderCompanyByOrderId($value->getOrderId())
				);
			}
		}
		
		return $result;
	}

	/**
     * Gets all the orderproduct with supplier id assigned on it, regardless of no supplier user  yet,
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return array
     */
	public function getOrderProductWithSupplier()
	{
		$result = array();
		$productRepo = $this->_em->getRepository(\App\Entity\Commerce\Product::class);
		$statusRepo = $this->_em->getRepository(\App\Entity\Commerce\Status::class);
		$compRepo = $this->_em->getRepository(\App\Entity\Management\Company::class);
		$userRepo = $this->_em->getRepository(\App\Entity\Management\User::class);
		$qb = $this->_em->createQueryBuilder();

		$qb->select('op')
		   ->from('App\Entity\Commerce\OrderProduct','op')
		   ->where('op.supplierId > 0 AND op.orderProductStatusId = 4');
		$queryResults = $qb->getQuery()->getArrayResult();

		if(!empty($queryResults)) {
			foreach ($queryResults as $key => $value) {
				$result[] = array(
					'id' => $value['id'],
					'quantity' => $value['quantity'],
					'price' => $value['price'],
					'data' => unserialize($value['data']),
					'step' => $value['step'],
					'orderId' => $value['orderId'],
					'product' => $productRepo->getProductById($value['productId']),
					'supplier' => $compRepo->getCompanyById($value['supplierId']),
					'supplierUser' => $userRepo->getSupplierUserById($value['supplierUserId']),
					'status' => $statusRepo->getStatusById($value['orderProductStatusId']),
					'createdAt' => $value['createdAt']->format('c'),
				);
			}
		}
		
		return $result;
	}

	public function checkForUpdateOrderStatus($id)
	{
		$repo = $this->_em->getRepository(\App\Entity\Commerce\OrderProduct::class);
		$orderRepo = $this->_em->getRepository(\App\Entity\Commerce\Order::class);
		$results = $repo->findBy(array('orderId'=> $id));
		$isDelivered = false;
		$pCount = count($results);
		$c = 0;
		if(!empty($results)) {
			foreach ($results as $key => $value) {
				if($value->getOrderProductStatusId() == 8){
					$c++;
				} 
			}
		}

		if($pCount == $c) {
			$orderRepo->updateOrderStatus(array('orderId' => $id,'id' => 7));
		} else {
			$orderRepo->updateOrderStatus(array('orderId' => $id,'id' => 5));
		}
	}
}

?>