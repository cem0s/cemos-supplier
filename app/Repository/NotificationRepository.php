<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class NotificationRepository extends EntityRepository
{
	public function addNotif($data)
	{
		$notif = new \App\Entity\Management\Notification();
		$notif->setOrderId($data['orderId']);
		$notif->setProductId($data['productId']);
		$notif->setStep($data['step']);
		$notif->setIsActive(1);
		$this->_em->persist($notif);
		$this->_em->flush();

		return true;
	}

	public function getAll()
	{
		$res = $this->_em->getRepository('App\Entity\Management\Notification')->findBy(array('isActive' => true));
		$pRepo = $this->_em->getRepository('App\Entity\Commerce\Product');
		$allNot = array();
		if(!empty($res)) {
			foreach ($res as $key => $value) {
				$allNot[] = array(
						'id' => $value->getId(),
						'product' => $pRepo->getProductById($value->getProductId()),
						'step' => $value->getStep(),
						'orderId'=> $value->getOrderId()
					);
 			}
		}
		return $allNot;
	}
}
