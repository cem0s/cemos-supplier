<?php

namespace App;

use SoomediaFloorplanner\SoomediaFloorplanner;
use SimpleXMLElement;


class Floorplanner 
{

	protected $fp;
	protected $host;

	public function __construct()
	{
		$this->host = "http://soomedia.floorplanner.com";
        $this->fp = SoomediaFloorplanner::connect(env('FLOORPLANNER_API_KEY'), $this->host);
		
    
	}


	public function getFloorPlanId($data, $projName = null, $email = null)
	{

		$identifier = 'ID'.$data['orderPId'].$data['objectId'].$data['companyId'];
		
		$project = $this->fp->getProject($identifier);
		if(is_array($project) && isset($project['status']) && $project['status'] == 404) {
			$fdata = array(
                'external_identifier' => $identifier,
                'project_name' => $projName
            );
            $p = $this->createNewProject($fdata);
            $_pid = $this->convertObjectToArray($p);
            $user_id = $this->getProjectUserId($p);
            if(isset($_pid) && !empty($_pid)){
                $pid = $_pid;
            }else{
                $pid = $identifier;
            }
            
		} else {
			$_pid = $this->convertObjectToArray($project);
            $user_id = $this->getProjectUserId($project);
            if(isset($_pid) && !empty($_pid)){
                $pid = $_pid;
            }else{
                $pid = $identifier;
            }
		}

		$xml = new \SimpleXMLElement("<email></email>");
        $xml[0] = $email;

        $collaborate_fp_user = $usercollaborate = $this->fp->collaborateProject($pid,$xml->asXML());
        $token = $this->fp->getUserToken($user_id);

		return array(
            'url' => $this->host . "/projects/{$pid}",
            'export_fml' => $this->host ."/projects/{$pid}/export.fml",
            "floor_id" => $pid,
            "collaborate_user" => $collaborate_fp_user,
            "token" => $token
        );
	}

	private function createNewProject($data)
    {
     	$fp = $this->fp;
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><project></project>');
        $xml->addChild('name', $data['project_name']);
        $xml->addChild('external-identifier', $data['external_identifier']);
        $project = $fp->createProject($xml->asXML());
        return $project;
    }

    private function convertObjectToArray($data)
    {
 
        $reflector = new \ReflectionClass($data);
        $classProperty = $reflector->getProperty('_attributes');
        $classProperty->setAccessible(true);
        $data = $classProperty->getValue($data);
        return $data['id'];
    }

    private function getProjectUserId($data)
    {
        $reflector = new \ReflectionClass($data);
        $classProperty = $reflector->getProperty('_attributes');
        $classProperty->setAccessible(true);
        $data = $classProperty->getValue($data);
        return $data['user-id'];
    }

    public function saveExportFloorplanImages($data)
    {
     
        $floorid = $data['projectId'];
        $companyId = $data['companyId'];
        $orderId = $data['orderId'];
        $objectId = $data['objectId'];
        $orderPId = $data['orderPId'];
        $objectSlug = $data['objectSlug'];
        $width = 2800;
        $height = 2100;

        $options = array(
            'pid' => $floorid,
            'resolution' => array('width' => $width, 'height' => $height),
            'callback' => 'http://127.0.0.1:88/cemos-supplier/save-callback/' . $objectId . '/' . $orderId . '/'. $companyId.'/'. $orderPId.'/'. $objectSlug,
            // 'send_to' => $data['email'],
            'send_to' => 'gladys@cemos.ph'
        );
    
    	// print_r('http://' . $_SERVER['HTTP_HOST'] . '/cemos-supplier/save-callback/' . $objectId . '/' . $orderId . '/'. $companyId.'/'. $orderPId.'/'. $objectSlug);exit;
       
        $result = $this->fp->exportFloorplanImages($floorid, $options);

        return true;
    }


}


?>