<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Links;
use App\Models\Stats;

class redirectController extends Controller
{
	/**
     * Redirect the user to actual link / Count Click / Increment for same user.
     *
     * @return HTTP.location header
     */
    public function index($id){
    	$hash_data = Links::validCheck('hash',$id);
    	if(strlen($hash_data['link'])){
    		$ip = $this->getUserIP();
    		if(($click_id = Stats::clickExists($ip, $id)) && $click_id){
    			$stats = Stats::find($click_id);
    			$stats->click_count++;
    		}else{
	    		$stats = new Stats();
	    		$stats->click_count = 1;
    			$stats->created_at = date('Y-m-d H:i:s');
    		}
    		$stats->hash = $id;
    		$stats->ip = $ip;
    		$stats->ua = $_SERVER['HTTP_USER_AGENT'];
    		$stats->save();
    	}else{
    		$hash_data['link'] = "https://www.newsbytesapp.com";
    	}
    	return redirect($hash_data['link'],302);
    }

    /**
     * Get Users IP
     *
     * @return string
     */
    protected function getUserIP(){
    	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    		return $_SERVER['HTTP_CLIENT_IP']; //ip for shared internet
    	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    		return $_SERVER['HTTP_X_FORWARDED_FOR']; //ip pass from proxy
    	}else{
    		return $_SERVER['REMOTE_ADDR'];
    	}
    }
}