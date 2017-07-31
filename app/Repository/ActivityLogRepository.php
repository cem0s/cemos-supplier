<?php
namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class ActivityLogRepository extends EntityRepository
{
	public function create($data)
	{
		$log = new \App\Entity\Management\CompanyActivityLog();
		$log->setUserId($data['user_id']);
		$log->setCompanyId($data['company_id']);
		$log->setData($data['data']);
		$log->setCategory($data['category']);
		$log->setAction($data['action']);
		$this->_em->persist($log);
		$this->_em->flush();
		return 1;
	}

	public function getLogs($userId)
	{
		$logs = array();
		$repo = $this->_em->getRepository(\App\Entity\Management\CompanyActivityLog::class);
		$search = $repo->findBy(array('userId'=> $userId));
		
		if(!empty($search)) {
			foreach ($search as $key => $value) {
				$logs[] = array(
						'log_id' => $value->getId(),
						'company_id' => $value->getCompanyId(),
						'user_id' => $value->getUserId(),
						'data' => $value->getData(),
						'action' => $value->getAction(),
						'category' => $value->getCategory(),
						'created_at' => $value->getCreatedAt()->format('c')
					);
			}
		}
		return $logs;
	}

}


?>