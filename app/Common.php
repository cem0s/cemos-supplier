<?php

namespace App;


class Common 
{

	public function checkIfAdmin()
    {
        $types = session('user_type');
        if(!empty($types)) {
            foreach ($types as $key => $value) {
                if(strtolower($value)=="admin") {
                    return true;
                }
            }
        }
        return false;
    }

    public function checkIfSupplierAdmin()
    {
        $groupId = session('group_id');
        if($groupId == 1){
            return true;
        }
        return false;
    }

    public function getUrl($step, $pId, $opId)
    {
    	
    	switch ($pId) {
    		case 1:
    		case 2:
    		case 3:
    		case 4:
    		case 5:
    		case 6:
    			$url = $this->getPhotoUrl($step);
    			break;
    		case 7:
    			$url = $this->getArchiUrl($step);
    			break;
    		case 8:
    		case 9:
    			$url = $this->getVidUrl($step);
    			break;
    		case 10:
    		case 11:
    			$url = $this->getMarketUrl($step);
    			break;

    		default:
    			$url = "";
    			break;
    	}

    	return $url."/".$opId;
    }

    public function getPhotoUrl($step)
    {
    
    	switch ($step) {
    		case 1:
    			$pUrl = "photography";
    			break;
    		case 2:
    			$pUrl = "photo-editor";
    			break;
    		case 3:
    			$pUrl = "photo-quality-checker";
    			break;
    		default:
    			$pUrl = "";
    			break;
    	}
    	return $pUrl;
    }

    public function getArchiUrl($step)
    {
   
    	switch ($step) {
    		case 1:
    			$aUrl = "floorplan-drawer";
    			break;
    		case 2:
    			$aUrl = "floorplan-checker";
    			break;
    		default:
    			$aUrl = "";
    			break;
    	}
    	return $aUrl;
    }

    public function getVidUrl($step)
    {
    
    	switch ($step) {
    		case 1:
    			$vUrl = "video";
    			break;
    		case 2:
    			$vUrl = "video-editor";
    			break;
    		case 3:
    			$vUrl = "video-quality-checker";
    			break;
    		default:
    			$vUrl = "";
    			break;
    	}
    	return $vUrl;
    }

    public function getMarketUrl($step)
    {
    
    	switch ($step) {
    		case 1:
    			$mUrl = "upload-brochure";
    			break;
    		case 2:
    			$mUrl = "brochure-checker";
    			break;
    		default:
    			$mUrl = "";
    			break;
    	}
    	return $mUrl;
    }


    public function getImages($data, $container, $productId = 0)
    {

        if($productId == 8 || $productId == 9) {
            
             $path = public_path('Dropbox/').$data['companyId'].'/'.$data['objectId'].'/'.$data['orderId'].'/'.$data['orderProductId'].'/'.$container;
            $urlPath = 'Dropbox/'.$data['companyId'].'/'.$data['objectId'].'/'.$data['orderId'].'/'.$data['orderProductId'].'/'.$container;
        } else {

            $path = public_path('Dropbox/').$data['companyId'].'/'.$data['objectId'].'/'.$data['orderId'].'/'.$data['orderProductId'].'/'.$container.'-wmark';
            $urlPath = 'Dropbox/'.$data['companyId'].'/'.$data['objectId'].'/'.$data['orderId'].'/'.$data['orderProductId'].'/'.$container.'-wmark';
   
        }
     
        $files = scandir($path);
        if(!empty($files)) {
            foreach ($files as $key => $value) {
                if($value != "." && $value != "..") {
                    // if(strpos(mime_content_type($path.'/'.$value), 'video') !== false){
                    //     $iFiles[$key]['file'] = 'public/'.$urlPath.'/'.$value;
                    // } else {
                    //     $iFiles[$key]['file'] = $urlPath.'/'.$value;
                    // }
                    $iFiles[$key]['file'] = 'public/'.$urlPath.'/'.$value; 
                    $iFiles[$key]['type'] = mime_content_type($path.'/'.$value);
                }
            }
            return $iFiles;
        }
        return array();
    }
}