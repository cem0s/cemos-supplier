<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\Facades\Mail;
use SimpleXMLElement;
use App\Floorplanner;
use App\Dropbox;

class FloorPlannerController extends Controller
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

    public function index($id)
    {
    	$repo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	$orderRepo = $this->em->getRepository('App\Entity\Commerce\Order');
    	$results = $repo->getCustomOrder(array('op_id'=> $id));
    	
    	if(isset($results[0])){
    		$order = $orderRepo->getOrderById($results[0]['orderId']);

    		$data = array(
    				'companyId' => $results[0]['company']['id'],
    				'objectId' =>  $order['objectId'],
    				'orderId' => $order['id'],
    				'orderPId' => $results[0]['id']
    			);
   
 			$files = $this->getFilesFromDropbox($data, $results[0]['data']['floors']);
 			$fp = $this->getFloorPlan($data, $order['objectName'], $order['email']);
 			

    		return view('pages.floorplanner.index')->with('data',array(
	    			'orderP'=> $results[0], 
	    			'order' => $order,
	    			'files' => $files,
	    			'floorplanner' => $fp
	    			)
    			);
    	}

    	return view('pages.error.not-found');
    	
    }

    public function getFilesFromDropbox($data, $files = array())
    {
    	$dBox = new Dropbox;
    	$files = $dBox->getFiles($data,'product-images');
    	return $files;
    }

    public function getFloorPlan($data, $projName, $email)
    {
    	$fp = new Floorplanner();
    	$details = $fp->getFloorPlanId($data, $projName, $email);

    	return $details;
    }

    public function submitFloorplan(Request $request)
    {
    	$data = $request->all();
    	$repo = $this->em->getRepository('App\Entity\Commerce\OrderProduct');
    	$step = $data['step']+1;

    	//$repo->updateOrderProductStatusById(6, $data['orderPId'], $step);

    	if($step==3){
    		$this->saveExportFloorplanImages($data);
    	}

    	//return redirect()->route('dashboard');
    }

    private function saveExportFloorplanImages($data)
    {
     
        
        $fp = new Floorplanner();
        $fp->saveExportFloorplanImages($data);

        return true;
    }

    public function saveFloorplanCallback($objId, $orderId, $companyId, $orderPId, $slug, Request $request)
    {
        
        $body = $request->getContent();

       Mail::send('emails.sample', ['data' => $body], function($message)
{
    $message->to('vailoces.gladys@gmail.com', 'John Smith')->subject('Welcome!');
});

  		print_r("<pre>");print_r($request->all()); exit;
        $xlink = str_replace('xlink:', '', $body);
        $xmlns = str_replace('xmlns:', '', $xlink);
        $result = new SimpleXMLElement($xmlns);

        $url = $result->link['href'];

        $tmp_dir = public_path().'/tmp/';

        $zipFile = $tmp_dir.$slug.".zip"; // Local Zip File Path

            // Get The Zip File From Server
        $this->downloadImage($zipFile,$url);

        $dir = $tmp_dir.$objId."-".$orderId."-".$orderPId;

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        
        $zip = new ZipArchive;
        $res = $zip->open($zipFile);

        if ($res === TRUE) {

            $zip->extractTo($dir);
            $zip->close();

            $files_delivered = "";
            $files = scandir($dir);

            

            foreach ($files as $value) {
               
            }

        
            return true;
        }
        return false;
    }

    private function downloadImage($zipFile,$url) {
        $zipResource = fopen($zipFile, "w");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FILE, $zipResource);
        curl_exec($ch);
    }

   
}
