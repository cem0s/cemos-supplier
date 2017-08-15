<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;
use Image;
use Exception;

class FileController extends Controller
{
    public function upload(Request $request)
    {
    	$image = $request->file('file');
    	$objId = $request->all()['objectId'];
    	$orderId = $request->all()['orderId'];
    	$orderPId = $request->all()['orderProductId'];
        $companyId = $request->all()['companyId'];
    	$step = $request->all()['step'];
    	$isEdited = $request->all()['isEdited'];
    	$container = "raw";
    	if($isEdited==1){
    		$container = "edited";
    	}
        if($step == 2){
            $container = "edited";
        }
        if($step == 3){
            $container = "delivered";
        }

   		$destination = public_path('Dropbox/').$companyId.'/'.$objId.'/'.$orderId.'/'.$orderPId.'/'.$container;
        $imageName = $image->getClientOriginalName();
        $fileType = $image->getMimeType();
        $image->move($destination,$imageName);
        $newD = $destination.'-wmark';

        if(strpos($fileType, 'video') === false) {
            $this->makeWaterMark($destination.'/'.$imageName, $newD, $imageName);

        }

        return response()->json(['success'=>$imageName]);
    }


    public function makeWaterMark($file, $newD, $name)
    {
        ini_set('memory_limit','1024M');
        if(!is_dir($newD)){
            mkdir($newD,0777);
        }
    
        copy($file, $newD.'/'.$name);
   
        $newF = $newD.'/'.$name;
       
        $img = Image::make($newF);

        $img->resize(2000, 1500);
        $img->insert(public_path('images/cemos_logo.png'), 'bottom-right', 10, 10); 
        $img->save($newF); //save created image
        $img->destroy();
        
        return $newF; //return value
        
    }


    public function deletePhoto(Request $request)
    {
   		$objId = $request->all()['objectId'];
    	$orderId = $request->all()['orderId'];
    	$orderPId = $request->all()['orderProductId'];
    	$companyId = $request->all()['companyId'];
    	$filename = $request->all()['filename'];
        $isEdited = $request->all()['isEdited'];
    	$pId = $request->all()['productId'];
        $step = $request->all()['step'];

    	$container = "raw";
    	if($isEdited==1){
    		$container = "edited";
    	}
        if($step == 2){
            $container = "edited";
        }
        if($step == 3){
            $container = "delivered";
        }
        if(($step == 1 && $pId ==10) || ($step == 1 && $pId ==11)) {
            $container = "edited";
        }
        if(($step == 2 && $pId ==10) || ($step == 2 && $pId ==11)) {
            $container = "delivered";
        }
        $source = public_path('Dropbox/').$companyId.'/'.$objId.'/'.$orderId.'/'.$orderPId.'/'.$container.'/'.$filename;
    	$wmark = public_path('Dropbox/').$companyId.'/'.$objId.'/'.$orderId.'/'.$orderPId.'/'.$container.'-wmark/'.$filename;
    	if(file_exists($source)) {
            unlink($source);
    		unlink($wmark);
    		return response()->json(['success'=>$filename]);
    	}
    	return response()->json(['error'=>$filename]);
   }

   public function zipFile(Request $request)
   {
        $objId = $request->all()['objId'];
        $orderId = $request->all()['oId'];
        $orderPId = $request->all()['orderPId'];
        $companyId = $request->all()['compId'];
        $zipName = $request->all()['name'];
        $step = $request->all()['step'];
        $container = "raw";
        if($step == 3) {
            $container = "edited";
        }

        $public_dir=public_path().'/Dropbox/'.$companyId.'/'.$objId.'/'.$orderId.'/'.$orderPId.'/'.$container;
        $zipFileName = $zipName.'.zip';
      
        $this->zip($public_dir, $zipFileName, $container);

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $filetopath=$public_dir.'/'.$zipFileName;
        if(file_exists($filetopath)){
            return response()->download($filetopath,$zipFileName,$headers);
        }
        return ['status'=>'file does not exist'];
    }

    public function zipBrochure(Request $request) 
    {
        $objId = $request->all()['objId'];
        $orderId = $request->all()['oId'];
        $orderPId = $request->all()['orderPId'];
        $companyId = $request->all()['compId'];
        $zipName = $request->all()['name'];
        $step = $request->all()['step'];
        $container = "edited";
        if($step == 3) {
            $container = "delivered";
        }

        $public_dir=public_path().'Dropbox/'.$companyId.'/'.$objId.'/'.$orderId.'/'.$orderPId.'/'.$container;
        $zipFileName = $zipName.'.zip';

        $this->zip($public_dir, $zipFileName, $container);

        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
        $filetopath=$public_dir.'/'.$zipFileName;
        if(file_exists($filetopath)){
            return response()->download($filetopath,$zipFileName,$headers);
        }
        return ['status'=>'file does not exist'];
    }

    public function uploadBrochure(Request $request)
    {
        $image = $request->file('file');
        $objId = $request->all()['objectId'];
        $orderId = $request->all()['orderId'];
        $orderPId = $request->all()['orderProductId'];
        $companyId = $request->all()['companyId'];
        $step = $request->all()['step'];
        $container = "edited";
        if($step == 2){
            $container = "delivered";
        }
       
        $destination = public_path('Dropbox/').$companyId.'/'.$objId.'/'.$orderId.'/'.$orderPId.'/'.$container;
        $imageName = $image->getClientOriginalName();
        $image->move($destination,$imageName);
        return response()->json(['success'=>$imageName]);
    }

    public function zip($public_dir = null, $zipFileName = null)
    {
        $zip = new ZipArchive;
        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) { 
            $files = scandir($public_dir);
            if(!empty($files)) {
                foreach ($files as $key => $value) {
                    if($value != "." && $value != "..") {
                        $zip->addFile($public_dir.'/'.$value, $value);        
                        
                    }
                }
                $zip->close();
            }
        }
    }
}
