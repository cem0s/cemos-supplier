<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use \App\Entity\Realestate\ResidentialObject;
use \App\Entity\Realestate\CommercialObject;
use \App\Entity\Realestate\ObjectProperty;

class ObjectRepository extends EntityRepository
{
	public function create($data = array())
	{	
		$object = new CommercialObject();

		if ($data['object_type'] === "residential") {
			$object = new ResidentialObject();
		} 

		$object->setName($data['address1']);
		$object->setAddress1($data['address1']);
		$object->setAddress2($data['address2']);
		$object->setZipcode($data['postalcode']);
		$object->setTown($data['town']);
		$object->setCountry($data['country']);
		$object->setSlug($data['slug']);
		$object->setObjectTypeId(1);  //to be replace
		$object->setRegionId(1); //to be replace
		$object->setCustomerId($data['company_id']); //note::customer refers to company
		$object->setUserId($data['user_id']);

		$this->_em->persist($object);
		$this->_em->flush();

		$property = $this->createObjectProperty($object->getId(), $data);

		return $object;
	}

	public function update($objectId = 0, $data = array())
	{
		$object = $this->_em->find('\App\Entity\Realestate\Object', $objectId);

		$object->setName($data['address1']);
		$object->setAddress1($data['address1']);
		$object->setAddress2($data['address2']);
		$object->setZipcode($data['postalcode']);
		$object->setTown($data['town']);
		$object->setCountry($data['country']);
		$object->setSlug($data['slug']);

		$this->_em->merge($object);
		$this->_em->flush();

		$property = $this->updateObjectProperty($object->getId(), $data);

		return $object;
	}

	private function createObjectProperty($objectId = 0, $data = array())
	{
		$property = new ObjectProperty();

		$property->setObjectId($objectId);
		$property->setPropertyType($data['buildingtype']);
		$property->setBuilt($data['built']);
		$property->setBuiltIn($data['builtin']);
		$property->setArea($data['area']);
		$property->setRooms($data['noofrooms']);
		$property->setFloors($data['nooffloors']);
		$property->setOccupied($data['occupied']);
		$property->setOwnerName($data['name']);
		$property->setOwnerTel($data['telno']);
		$property->setOwnerMob($data['mobno']);
		$property->setOwnerEmail($data['emailadd']);

		$this->_em->persist($property);
		$this->_em->flush();
		return $property;
	}

	private function updateObjectProperty($objectId = 0, $data = array())
	{
		$objectPropertyRepo = $this->_em->getRepository('App\Entity\Realestate\ObjectProperty');
        $criteria = array(
            'objectId' => $objectId
        );

        $objectProps = $objectPropertyRepo->findOneBy($criteria);

		$objectProps->setPropertyType($data['buildingtype']);
		$objectProps->setBuilt($data['built']);
		$objectProps->setBuiltIn($data['builtin']);
		$objectProps->setArea($data['area']);
		$objectProps->setRooms($data['noofrooms']);
		$objectProps->setFloors($data['nooffloors']);
		$objectProps->setOccupied($data['occupied']);
		$objectProps->setOwnerName($data['name']);
		$objectProps->setOwnerTel($data['telno']);
		$objectProps->setOwnerMob($data['mobno']);
		$objectProps->setOwnerEmail($data['emailadd']);

		$this->_em->merge($objectProps);
		$this->_em->flush();
		return $objectProps;
	}

	public function getObjectByid($id = 0) 
	{	
		// another way of retrieving data
		//$object = $this->_em->getRepository('\App\Entity\Realestate\Object')->findBy(array('id' => $id));
		$object = array();
		$objectTypeRepo = $this->_em->getRepository('App\Entity\Realestate\ObjectType');
		$objectPropertyRepo = $this->_em->getRepository('App\Entity\Realestate\ObjectProperty');
		$data = $this->_em->find('\App\Entity\Realestate\Object', $id);

		if(isset($data) && !empty($data)) {
			$object = array(
				'id' => $data->getId(),
				'address1' => $data->getAddress1(),
				'address2' => $data->getAddress2(),
				'postalcode' => $data->getZipcode(),
				'town' => $data->getTown(),
				'country' => $data->getCountry(),
				'slug' => $data->getSlug(),
				'company_id' => $data->getCustomerId(),
				'user_id' => $data->getUserId(),
				'objecttype' => $objectTypeRepo->getObjectTypeById($data->getObjectTypeId()),
				'object_property' => $objectPropertyRepo->getObjectPropertyByObjectId($id),
			);
		}

		return $object;
	}

	public function getAllObjects()
	{
		$data = array();
		$qb = $this->_em->createQueryBuilder();

		$qb->select('o')
		   ->from('App\Entity\Realestate\Object', 'o');

		$queryResult = $qb->getQuery()->getArrayResult();
		
		$userRepo = $this->_em->getRepository('App\Entity\Management\User');
		$objectTypeRepo = $this->_em->getRepository('App\Entity\Realestate\ObjectType');

		if(!empty($queryResult)){
			foreach ($queryResult as $key => $value) {
				$data[] = array(
						'id' => $value['id'],
						'name' => $value['name'],
						'address1' => $value['address1'],
						'address2' => $value['address2'],
						'zipcode' => $value['zipcode'],
						'country' => $value['country'],
						'town' => $value['town'],
						'slug' => $value['slug'],
						'objecttype' => $objectTypeRepo->getObjectTypeById($value['objectTypeId']),
						'object_property' => "",
						'user' => $userRepo->getAllUserInfo($value['userId']),
						'createdat' => $value['createdAt']->format('c'),
						'discr' => $value['discr']
					);
			}
		}

		
		return array(
				'property' => $data,
				'count' => count($qb->getQuery()->getArrayResult())
			);
	}

}