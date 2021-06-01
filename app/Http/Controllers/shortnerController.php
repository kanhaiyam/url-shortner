<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Links;
use Validator;

class shortnerController extends Controller{

	public $linksModel;

	public function __construct(){
		$this->linksModel = new Links();
	}

	/**
     * Generate a hash for the short URL and save it in DB
     * @param Request Parameter => $request['link']
     * @return String
     */
	public function create(Request $request){
		$request = $request->all();
		if (filter_var($request['link'], FILTER_VALIDATE_URL) !== false){
			$link_exists = $this->linksModel->validCheck('link',$request['link']);
			if(!$link_exists){
				$hash = $this->generateHash();
				$data = &$this->linksModel;
				$data->id = $hash[1];
				$data->hash = $hash[0];
				$data->link = $request['link'];
				$data->created_at = date('Y-m-d H:i:s');
			}else{
				$data = Links::find($link_exists['id']);
				$data->updated_at = date('Y-m-d H:i:s');
				$hash = [$link_exists['hash']];
			}
			$status = $data->save();
		}else{
			$status = FALSE;
		}

    	if($status){
    		$response = [
    						'success' => TRUE,
    						'ExampleLink' => env("APP_URL")."/redirect/".$hash[0],
    						'link_hash' => (string)$hash[0]
    					];
    	}else{
    		$response = [
    						'success' => FALSE,
    						'message' => "Please check the link or Contact Admin"
    					];
    	}
    	return response()->json($response);
	}

	/**
     * Generate a hash url using the next ID in `links_master` table.
     * 
     * @return array [hash, next_id]
     * 
     */
	private function generateHash(){
		$id_temp = $this->linksModel->getNextID(); //Get next ID
		$chars = [1,2,3,4,5,6,7,8,9,0,"a","b","c","d","e","f","g","h","i","j",
				  "k","l","m","n","o","p","q","r","s","t","u","v","w","x","y",
				  "z","A","B","C","D","E","F","G","H","I","J","K","L","M","N",
				  "O","P","Q","R","S","T","U","V","W","X","Y","Z"
				  ]; //character set for hash

        $id = intval($id_temp);
        $length = count($chars);
        
        $code = "";

        while ($id > $length - 1) {
        	//calculate remainder, substitute it with $chars[] and append.
            $code = $chars[fmod($id, $length)] . $code;
            $id = floor($id / $length);
        }

        //substitute for the last element left.
        $code = $chars[$id] . $code;

        return [$code,$id_temp];
	}
}
