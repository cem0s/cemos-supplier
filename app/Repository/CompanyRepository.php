<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class CompanyRepository extends EntityRepository
{

	public function create($data)
	{
		if(isset($data['company']['id'])) {
			$compResult = $this->_em->find(\App\Entity\Management\Company::class, $data['company']['id']);
			$compResult->setName($data['company']['name']);
			$compResult->setPhone($data['company']['phone']);
			$this->_em->merge($compResult);
			$this->_em->flush();
			return $compResult->getId();
		}
		$company = new \App\Entity\Management\Company();
		$company->setName($data['company_name']);
		$company->setPhone($data['company_phone']);
		$this->_em->persist($company);
		$this->_em->flush();
		return $company->getId();
	}

	public function getCompanyById($id)
	{
		$compResult = $this->_em->find(\App\Entity\Management\Company::class, $id);
		if(isset($compResult) && !empty($compResult)) {
			return array(
					'id' => $compResult->getId(),
					'name'=> $compResult->getName(),
					'phone'=> $compResult->getPhone()
				);
		}
		return array();
	}

	public function getAllCompany()
	{
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c')
		   ->from('App\Entity\Management\Company','c');

		$queryResults = $qb->getQuery()->getArrayResult();
		if(!empty($queryResults)) {
			return $queryResults;
		}

		return array();
	}

	public function getCompanyType($id)
	{
		$res = array();
		$qb = $this->_em->createQueryBuilder();
		$qb->select('c.id, c.name, ct.name as company_type')
		   ->from('App\Entity\Management\Company', 'c')
		   ->leftJoin('App\Entity\Management\CompanyCompanyType','cct','WITH','cct.companyId = c.id')
		   ->leftJoin('App\Entity\Management\CompanyType','ct','WITH','ct.id = cct.companyTypeId')
		   ->where('c.id = :id')
		   ->setParameter('id', $id);
		$queryResults = $qb->getQuery()->getArrayResult();
		if(!empty($queryResults)) {
			foreach ($queryResults as $key => $value) {
				$res[] = $value['company_type'];
			}
		}
	
		return $res;
	}
}



?>