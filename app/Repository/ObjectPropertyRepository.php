<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class ObjectPropertyRepository extends EntityRepository
{
	public function getObjectPropertyByObjectId($id = 0) 
	{	
		$objectPropertyRepo = $this->_em->getRepository('App\Entity\Realestate\ObjectProperty');
        $criteria = array(
            'objectId' => $id
        );

        $objectProps = $objectPropertyRepo->findOneBy($criteria);
        $data = null;
        if(isset($objectProps) && !empty($objectProps))
        {
        	$data = array(
        		'property_type' => $objectProps->getPropertyType(),
        		'built' => $objectProps->getBuilt(),
        		'built_in' => $objectProps->getBuiltIn(),
        		'area' => $objectProps->getArea(),
        		'no_rooms' => $objectProps->getRooms(),
        		'no_floors' => $objectProps->getFloors(),
        		'occupied' => $objectProps->getOccupied(),
        		'owner_name' => $objectProps->getOwnerName(),
        		'owner_tel' => $objectProps->getOwnerTel(),
        		'owner_mob' => $objectProps->getOwnerMob(),
        		'owner_email' => $objectProps->getOwnerEmail(),
        	);
        }

		return $data;
	}

}