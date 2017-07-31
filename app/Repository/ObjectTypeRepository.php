<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class ObjectTypeRepository extends EntityRepository
{

	public function getObjectTypeById($objectTypeId)
	{
		$repo = $this->_em->find('App\Entity\Realestate\ObjectType', $objectTypeId);
		
		if(!empty($repo)){
			return array(
					'id' => $repo->getId(),
					'name' => $repo->getName()
				);
		}
		return array();
	}
}

?>