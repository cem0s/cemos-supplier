<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class AddressRepository extends EntityRepository
{

	public function create($data, $companyId)
	{
		if(isset($data['address']['id'])) {
			$result = $this->_em->find(\App\Entity\Management\Address::class, $data['address']['id']);
			$result->setName($data['address']['address_1']);
			$result->setAddress1($data['address']['address_1']);
			if(isset($data['address']['address_2'])) {$result->setAddress2($data['address']['address_2']);}
			$result->setZipcode($data['address']['zipcode']);
			$result->setTown($data['address']['town']);
			$result->setCountry("Philippines");
			$result->setCompanyId($companyId);
			$this->_em->merge($result);
			$this->_em->flush();
			return 1;
		}
		$address = new \App\Entity\Management\Address();
		$address->setName($data['address_1']);
		$address->setAddress1($data['address_1']);
		if(isset($data['address_2'])) {$address->setAddress2($data['address_2']);}
		$address->setZipcode($data['postal_code']);
		$address->setTown($data['town']);
		$address->setCountry("Philippines");
		$address->setCompanyId($companyId);
		$this->_em->persist($address);
		$this->_em->flush();
		return 1;

	}

	public function createInvoiceAddress($data, $companyId)
	{

		$address = new \App\Entity\Management\InvoiceAddress();
		$address->setName($data['address_1']);
		$address->setAddress1($data['address_1']);
		if(isset($data['address_2'])) {$address->setAddress2($data['address_2']);}
		$address->setZipcode($data['postal_code']);
		$address->setTown($data['town']);
		$address->setCountry("Philippines");
		$address->setCompanyId($companyId);
		$address->setEmail($data['email']);
		$address->setPayment($data['isDebit']);
		$address->setCocNumber($data['iban']);
		$address->setTaxNumber($data['tax_number']);
		$this->_em->persist($address);
		$this->_em->flush();
		return 1;

	}

	public function getAddressByCompanyId($companyId)
	{
		$addResult = $this->_em->getRepository(\App\Entity\Management\Address::class);
		$search = $addResult->findBy(array('companyId'=> $companyId));
		if(isset($search[0]) && !empty($search[0])) {
			return array(
					'id' => $search[0]->getId(),
					'name' => $search[0]->getName(),
					'address_1' => $search[0]->getAddress1(),
					'address_2' => $search[0]->getAddress2(),
					'zipcode' => $search[0]->getZipcode(),
					'town' => $search[0]->getTown(),
					'country' => $search[0]->getCountry(),

				);
		}
		return array();
	}

	public function getInvoiceAddressByCompanyId($companyId)
	{
		$addResult = $this->_em->getRepository(\App\Entity\Management\InvoiceAddress::class);
		$search = $addResult->findBy(array('companyId'=> $companyId));
		if(isset($search[0]) && !empty($search[0])) {
			return array(
					'id' => $search[0]->getId(),
					'name' => $search[0]->getName(),
					'address_1' => $search[0]->getAddress1(),
					'address_2' => $search[0]->getAddress2(),
					'zipcode' => $search[0]->getZipcode(),
					'town' => $search[0]->getTown(),
					'country' => $search[0]->getCountry(),
					'iban' => $search[0]->getSepaIban(),
					'tax' => $search[0]->getTaxNumber(),
					'payment' => $search[0]->getPayment(),
					'cocNumber' => $search[0]->getCocNumber(),

				);
		}
		return array();
	}
}
