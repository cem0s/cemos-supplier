<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Common;


class MarketingController extends Controller
{
    protected $em;

    protected $common;

    public function __construct(EntityManager $em)
    {
    	$this->em = $em;
    	$this->common = new Common;
    }

    public function index($id)
    {
    	$repo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	$orderRepo = $this->em->getRepository('App\Entity\Commerce\Order');
    	$results = $repo->getCustomOrder(array('op_id'=> $id));
    	$files = array();
    	if(isset($results[0])){
    		$order = $orderRepo->getOrderById($results[0]['orderId']);
    		$fileArray = array(
    			'orderId' => $order['id'],
    			'objectId' => $order['objectId'],
    			'orderProductId' => $results[0]['id'],
    			'companyId' => $results[0]['company']['id']
    			); 

    		if($results[0]['step'] == 2){
    			$files = $this->common->getImages($fileArray, 'edited');
    		} 
    		
    		return view('pages.marketing.index')->with('data',array(
	    			'orderP'=> $results[0], 
	    			'order' => $order,
	    			'files' => $files
	    			)
    			);
    	}

    	return view('pages.error.not-found');
    }


}
