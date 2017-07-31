<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class SupplierTypeRepository extends EntityRepository
{

	public function getSupplierTypes()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('st')
		   ->from('App\Entity\Supplier\SupplierType','st');

		return $qb->getQuery()->getArrayResult();
		
	}

	public function getSupplierByTypeId($id)
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c.id, c.name')
		   ->from('App\Entity\Supplier\SupplierSupplierType','sst')
		   ->leftJoin('App\Entity\Management\Company','c', 'WITH', 'sst.supplierId = c.id')
		   ->where('sst.supplierTypeId = :id')
		   ->setParameter('id', $id);
		   
		return $qb->getQuery()->getArrayResult();
	}


}

?>