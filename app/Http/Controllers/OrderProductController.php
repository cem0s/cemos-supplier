<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;

class OrderProductController extends Controller
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
    * Show the order product details
    * @author Gladys
    * @param integer id
    * @return view
    */
    public function orderProductDetails($id)
    {
    
    	$repo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	$orderRepo = $this->em->getRepository('App\Entity\Commerce\Order');
    	$results = $repo->getCustomOrder(array('op_id'=> $id));
    	if(isset($results[0])){
    		$order = $orderRepo->getOrderById($results[0]['orderId']);
    
    		return view('pages.orders.order-product')->with('data', array('order' => $order, 'orderP'=> $results[0]));
    	}
    	return view('pages.error.not-found');
    	
    }
}
