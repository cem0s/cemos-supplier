<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Hash;


class UserRepository extends EntityRepository
{

	/**
     * This create new user account
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $data userdata
     * @return user array
     */
	public function create($data)
	{
		//Initialize return array
		$result = array();

		//Check if email exists
		$isEmailExist = $this->checkEmail($data['email']);
	
		if($isEmailExist['exist']) {

			$result = array(
					'exist' => true
				);

		} else {
			//Initialize company and address repo
			$companyRepo = $this->_em->getRepository('App\Entity\Management\Company');
			$addressRepo = $this->_em->getRepository('App\Entity\Management\Address');

			//Create the company
			$companyId = $companyRepo->create($data);

			//Create new address
			$addressId = $addressRepo->create($data, $companyId);

			//Create new invoice address
			$invoiceAddressId = $addressRepo->createInvoiceAddress($data, $companyId);

			//Create the user
			$user = new \App\Entity\Management\User();
			$user->setFirstName($data['first_name']);
			$user->setLastName($data['last_name']);
			$user->setEmail($data['email']);
			$user->setUsername($data['first_name'].$data['last_name']);
			$user->setEmailVerified(0);
			$user->setPassword(Hash::make($data['password']));
			$user->setActive(0);
			$user->setCompanyId($companyId);
			
			$this->_em->persist($user);
			$this->_em->flush();

			//Create user activation code
			$code = $this->addUserActivation($user->getId());

			$result = array(
					'exist' => false,
					'user' => array(
						'id' 			=> $user->getId(),
						'firstname' 	=> $user->getFirstName(),
						'lastname' 		=> $user->getLastName(),
						'email' 		=> $user->getEmail(),
						'emailVerified' => $user->getEmailVerified(),
						'username' 		=> $user->getUsername(),
						'active' 		=> $user->getActive(),
						'company_id' 	=> $user->getCompanyId(),
						),
					'userObj' => $user,
					'code' => $code
				);
		}

			
		return $result;
	}

	/**
     * This create the user activation code. Code is saved in the database for checking once the user activates his/her account.
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $userId
     * @return code string
     */
	public function addUserActivation($userId)
	{
		$code = new \App\Entity\Management\UserActivationCode();
		$code->setUserId($userId);
		$code->setCode(str_random(30));
		$this->_em->persist($code);
		$this->_em->flush();
		return $code->getCode();
	}

	/**
     * This check if the given code exists
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $code string
     * @return array
     */
	public function checkIfCodeExist($code)
	{
		$res = array();
		$repo = $this->_em->getRepository(\App\Entity\Management\UserActivationCode::class);
		$search = $repo->findBy(array('code'=> $code));
		if(isset($search[0])){
			return $res = array('exist'=> true, 'user_id'=> $search[0]->getUserId());
		}
		return $res;
	}


	/**
     * This update the user account to verified
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $userId 
     * @return boolean
     */
	public function updateEmailVerified($userId)
	{
		$repo = $this->_em->find('App\Entity\Management\User', $userId);
		if(!empty((array)$repo)){
			$repo->setEmailVerified(1);
			$repo->setActive(1);
			$this->_em->merge($repo);
			$this->_em->flush();

			//Logs activity
			$this->addLog(array(
				'user_id' => $repo->getId(),
				'company_id' => $repo->getCompanyId(),
				'data' => 'Your account has verified.',
				'category' => 'user',
				'action' => 'update'
			));

		}
		return true;
	}

	/**
     * This check if the credentials provided exists
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $credentials array
     * @return array
     */
	public function checkCredentials($credentials)
    {
    	$repo = $this->_em->getRepository(\App\Entity\Management\User::class);
    	$companyRepo = $this->_em->getRepository('App\Entity\Management\Company');
		$search = $repo->findBy(array('email'=> $credentials['email']));
		if(isset($search) && !empty($search)){
			foreach ($search as $key => $value) {
				if(Hash::check($credentials['password'], $value->getPassword()) && $value->getActive() == 1) {
					if($value->getEmailVerified() == true) {
						if($this->checkIfSupplier($value->getCompanyId())) {
							return array('exist'=>'yes', 'user_id'=>$value->getId());
						} else {
							return array('exist'=>'not supplier');
						}
					} else {
						return array('exist'=>'not verified');
					}
				}
			}
		} 
		return array('exist'=>'no');
        
    }

    /**
     * This get the user object for Auth purposes
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $userId 
     * @return object
     */
    public function getUserById($userId)
    {
    	$user = $this->_em->find('App\Entity\Management\User', $userId);
		if(!empty((array)$user)){
			return $user;
		} 
		return null;
    }


    /**
     * This gets all the user info
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $userId 
     * @return array
     */
    public function getAllUserInfo($userId)
    {
    	$companyRepo = $this->_em->getRepository('App\Entity\Management\Company');
    	$addressRepo = $this->_em->getRepository('App\Entity\Management\Address');
    	$logs = $this->_em->getRepository('App\Entity\Management\CompanyActivityLog');
    	$user = $this->_em->find('App\Entity\Management\User', $userId);

		if(!empty((array)$user)){
			return array(
					'user' => array(
						'id' 			=> $user->getId(),
						'firstname' 	=> $user->getFirstName(),
						'lastname' 		=> $user->getLastName(),
						'email' 		=> $user->getEmail(),
						'emailVerified' => $user->getEmailVerified(),
						'username' 		=> $user->getUsername(),
						'active' 		=> $user->getActive(),
						'company_id' 	=> $user->getCompanyId(),
						'created_at' 	=> $user->getCreatedAt()->format('c'),
					),
					'company' => $companyRepo->getCompanyById($user->getCompanyId()),
					'address' => $addressRepo->getAddressByCompanyId($user->getCompanyId()),
					'invoiceaddress' => $addressRepo->getInvoiceAddressByCompanyId($user->getCompanyId()),
					'logs' => $logs->getLogs($userId)
				);
		} 
		return array();
    }

    /**
     * This checks if the given email exists
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $email 
     * @return array
     */
    public function checkEmail($email)
    {
    	$repo = $this->_em->getRepository(\App\Entity\Management\User::class);
    	$codeRepo = $this->_em->getRepository(\App\Entity\Management\UserActivationCode::class);
		$search = $repo->findBy(array('email'=> $email));

		if(isset($search[0]) && !empty($search[0])){
			$getCode = $codeRepo->findBy(array('userId'=> $search[0]->getId()));
			return array('exist' => true, 'user' => $search[0],'code'=> $getCode[0]->getCode());
		} 
		return array('exist'=>false);
    }

    /**
     * This updates the password only if the user request for reset in password
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $data 
     * @return array
     */
    public function updatePassword($data)
    {
    	$repo = $this->_em->getRepository(\App\Entity\Management\User::class);
    	$search = $repo->findBy(array('email'=> $data['uemail']));
    	if(isset($search[0]) && !empty($search[0])){
    		$search[0]->setPassword(Hash::make($data['password']));
    		$this->_em->merge($search[0]);
			$this->_em->flush();

			//Log activity
			$this->addLog(array(
				'user_id' => $search[0]->getId(),
				'company_id' => $search[0]->getCompanyId(),
				'data' => 'You updated your password.',
				'category' => 'user',
				'action' => 'update'
			));
			return $search[0];
    	}
    	return array();
    }

    /**
     * This updates the profile picture
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $userId 
     * @param $path 
     * @return boolean
     */
    public function updateProfilePic($userId, $path)
    {
    	//Get the user
    	$user = $this->getUserById($userId);
    	if(!empty((array)$user)){
    		//Update profile pic path
			$user->setProfilePic($path);
			$this->_em->merge($user);
			$this->_em->flush();

			//Log activity
			$this->addLog(array(
				'user_id' => $user->getId(),
				'company_id' => $user->getCompanyId(),
				'data' => 'You updated your profile picture.',
				'category' => 'user',
				'action' => 'update'
			));
			return true;
		} 
		return false;
    }

    /**
     * This updates the user information
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $data 
     * @return array
     */
    public function updateUser($data)
    {

		$companyRepo = $this->_em->getRepository('App\Entity\Management\Company');
		$addressRepo = $this->_em->getRepository('App\Entity\Management\Address');

		$companyId = $companyRepo->create($data);
		$addressId = $addressRepo->create($data, $companyId);

		$user = $this->getUserById($data['user']['id']);
    	if(!empty((array)$user)){
			$user->setFirstName($data['user']['firstname']);
			$user->setLastName($data['user']['lastname']);
			$user->setEmail($data['user']['email']);
			$user->setUsername($data['user'] ['firstname'].$data['user']['lastname']);
			$user->setCompanyId($companyId);
			
			$this->_em->merge($user);
			$this->_em->flush();
		} 

		//Log activity
		$this->addLog(array(
				'user_id' => $user->getId(),
				'company_id' => $user->getCompanyId(),
				'data' => 'You updated your profile.',
				'category' => 'user',
				'action' => 'update'
			));
			
		return array(
			'user' => array(
				'id' 			=> $user->getId(),
				'firstname' 	=> $user->getFirstName(),
				'lastname' 		=> $user->getLastName(),
				'email' 		=> $user->getEmail(),
				'emailVerified' => $user->getEmailVerified(),
				'username' 		=> $user->getUsername(),
				'active' 		=> $user->getActive(),
				'company_id' 	=> $user->getCompanyId(),
				),
		);
    }

    /**
     * Check if user company type is Supplier
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $companyId
     * @return boolean
     */
    private function checkIfSupplier($companyId)
    {
    	$repo = $this->_em->getRepository('App\Entity\Management\Company');
    	$types = $repo->getCompanyType($companyId);
    	if(!empty($types)) {
    		foreach ($types as $key => $value) {
    			if(strtolower($value) == "supplier") {
    				return true;
    			}
    		}
    	}
    	return false;
    }

    /**
     * Get the name of user supplier
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $id
     * @return array
     */
    public function getSupplierUserById($id)
    {
    	if($id > 0){
    		$user = $this->_em->find('App\Entity\Management\User', $id);

	    	if(count(array($user)) > 0) {
	    		return array(
	    			'name' => $user->getFirstName().' '.$user->getLastName(),
	    		);
	    	}
    	}
    
    	return array();
    }

    /**
     * Create users by Company
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @param integer $companyId
     * @return array
     */
    public function getUsersByCompany($companyId)
    {
    	$res = array();
    	$qb = $this->_em->createQueryBuilder();
    	$qb->select('u')
    	   ->from('App\Entity\Management\User','u')
    	   ->where('u.companyId = :companyId')
    	   ->setParameter('companyId',$companyId);
    	$queryResults = $qb->getQuery()->getArrayResult();
    	if(!empty($queryResults)) {
    		foreach ($queryResults as $key => $value) {
    			$res[] = array(
    				'id' => $value['id'],
    				'firstname' => $value['firstName'],
    				'lastname' => $value['lastName']
    				);
    		}
    	}
    	return $res;
    }

    /**
     * This logs all activity
     * @author Gladys Vailoces <gladys@cemos.ph>
     * @param $data 
     * @return boolean
     */
    private function addLog($data)
    {
    	$log = $this->_em->getRepository('App\Entity\Management\CompanyActivityLog');
    	$log->create($data); 
    	return 1;
    }
}



?>