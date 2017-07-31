<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Common;


class PhotographyController extends Controller
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
    			$files = $this->common->getImages($fileArray, 'raw');
    		} else  if($results[0]['step'] == 3) {
    			$files = $this->common->getImages($fileArray, 'edited');
    		}
    	
    		return view('pages.photography.index')->with('data',array(
	    			'orderP'=> $results[0], 
	    			'order' => $order,
	    			'files' => $files
	    			)
    			);
    	}

    	return view('pages.error.not-found');
    	
    }

    public function submitImages(Request $request)
    {
    	
    	$orderPId = $request->all()['id'];
    	$orderId = $request->all()['orderId'];
    	$step = $request->all()['step'];
    	$repo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	$orderRepo = $this->em->getRepository('App\Entity\Commerce\Order');
    	
    	$repo->updateOrderProductStatusById(6, $orderPId, $step);
    	$orderRepo->updateOrderStatus(array('orderId'=>$orderId, 'id'=>5));

    	return response()->json(['success'=>'success']);
    }

    public function successPage()
    {
    	return view('pages.orders.success');
    }

    
}
