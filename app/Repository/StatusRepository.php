<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class StatusRepository extends EntityRepository
{

	/**
     * This gets status details by id
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @params id integer
     * @return  array
     */
	public function getStatusById($id)
	{
		$statusRepo = $this->_em->find('App\Entity\Commerce\Status', $id);
		$obj = (array)$statusRepo;
		
		if(!empty($obj)) {
			return array(
				'id' => $statusRepo->getId(),
				'name' => $statusRepo->getName(),
			);
		}
	}
}

?>