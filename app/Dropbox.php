<?php

namespace App;

use Illuminate\Http\Request;
use Dropbox\Client;
use Dropbox\WriteMode;

class Dropbox {

	protected $client;

	public function __construct()
	{
		$this->client = new Client(env('DROPBOX_TOKEN'), env('DROPBOX_SECRET'));
	}


	/**
     * Get files from specified path in dropbox
     * @author Gladys Vailoces <gladys@cemos.ph> 
     * @return 
     */
	public function getFiles($data, $container=null)
	{
		$dropBoxRoot = '/'.$data['companyId'].'/'.$data['objectId'].'/'.$data['orderId'].'/'.$container;

		$results = $this->client->getMetadataWithChildren($dropBoxRoot);
		$files = array();
		if((isset($results['contents'])) && (count($results['contents']) > 0)) {
			foreach ($results['contents'] as $key => $value) {	
				$getF = $this->client->createTemporaryDirectLink($value['path']);
				if(isset($getF[0])) {
					$files[]= $getF[0];
				}
			
			}
		}

		return $files;
	}

}

?>