<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Common;

class DashboardController extends Controller
{

    /**
     * em
     *
     * @var
     */
	protected $em;

    /**
     * common
     *
     * @var
     */
    protected $common;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
        $this->common = new Common;
	}

    /**
    * Returns the index view for dashboard
    * @author Gladys
    * @return view
    */
    public function index()
    {
    	$orderPRepo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	$orders = array();
        $isAdmin = false;
        if($this->common->checkIfAdmin()) {
            $orders = $orderPRepo->getCustomOrder(array());
            $isAdmin = true;
        } else if($this->common->checkIfSupplierAdmin()){
            $isAdmin = true;
            $orders = $orderPRepo->getCustomOrder(array('company_id' => session('company_id')));
        } else  {
            $orders = $orderPRepo->getCustomOrder(array('user_id' => session('user_id')));
          
            if(!empty($orders)){
                foreach ($orders as $key => $value) {
                    $orders[$key]['link'] = $this->common->getUrl($value['step'], $value['product']['id'], $value['id']);
                }
            }
        }
    
    	return view('pages.dashboard.index')->with('data',array('orders'=> $orders,'isAdmin' => $isAdmin));
    }

   
}
