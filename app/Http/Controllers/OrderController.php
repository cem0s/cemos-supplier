<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use App\Common;


class OrderController extends Controller
{
     /**
     * em
     *
     * @var
     */
    protected $em;

     /**
     * orderRepo
     *
     * @var
     */
    protected $orderRepo;

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
        $this->orderRepo = $em->getRepository('App\Entity\Commerce\Order');
        $this->common = new Common;
    }


    /**
    * Returns the index view for orders
    * @author Gladys
    * @return view
    */
    public function index()
    {
        $isAdmin = false;
    	if($this->common->checkIfAdmin()){
            $isAdmin = true;
            $orderData = $this->orderRepo->getAllOrders();    
        } else if($this->common->checkIfSupplierAdmin()) {
            $isAdmin = true;
            $orderData = $this->orderRepo->getSupplierOrderBySupplierId(session('company_id'));
        } else {
            $orderData = $this->orderRepo->getSupplierOrderBySupplierUserId(session('user_id'));

            if(!empty($orderData)){
                foreach ($orderData as $key => $value) {
                    $orderData[$key]['link'] = $this->common->getUrl($value['step'], $value['productId'], $value['opId']);
                }
            }
        }
    	

    	return view('pages.orders.index')->with('data',array('orderData' => $orderData, 'isAdmin' => $isAdmin));
    }

    /**
    * Returns the index view for order details
    * @author Gladys
    * @param integer id
    * @return view
    */
    public function orderDetails($id)
    {
        $orderProductRepo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
        $order = $this->orderRepo->getOrderById($id);
        $orderProduct = $orderProductRepo->getOrderProductByOrderId($id);

        return view('pages.orders.order-details')->with('data', array('order' => $order, 'oproduct' => $orderProduct));
    }


}
