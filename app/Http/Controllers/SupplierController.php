<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;


class SupplierController extends Controller
{

    /**
     * em
     *
     * @var
     */
	protected $em;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EntityManager $em)
    {
    	$this->em = $em;

    }

    /**
    * Show all the supplier members
    * @author Gladys
    * @return encoded array
    */
    public function getMembers()
    {
    	$companyId = session('company_id');
    	$userRepo = $this->em->getRepository('App\Entity\Management\User');
    	$users = $userRepo->getUsersByCompany($companyId);

        echo json_encode($users);

    }

    /**
    * Assign member to order product
    * @author Gladys
    * @param object Request
    * @return encoded array
    */
    public function assignMember(Request $request)
    {
        $data = $request->all();
        $repo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
        echo $repo->assignSupplierMember($data);
    }
}
