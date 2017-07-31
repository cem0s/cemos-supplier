<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class OrderProductStepRepository extends EntityRepository
{
	public function addOrderProductStep($data)
	{
		$orderStep = new \App\Entity\Commerce\OrderProductStep();
		$orderStep->setOrderProductId($data['op_id']);
		$orderStep->setStep($data['step']);
		$orderStep->setSupplierId($data['supplier_id']);

		$this->_em->persist($orderStep);
		$this->_em->flush();

		return true;
	}
}