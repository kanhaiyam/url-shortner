<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class linkMaster extends Model
{
    protected $table = 'link_master' ; 
    protected $primary_key = 'id';

    /**
     * Get Next Auto Increment ID
     * 
     * @return integer
     * 
     */
    public function getNextID(){
    	$db = env("DB_DATABASE");
    	$nextID = DB::select("SELECT MAX(id) as `id` FROM ".$this->table);
    	return ++$nextID[0]->id;
    }

    /**
     * check if a perticluar value exists for a column
     * @param string $column column name to be searched on
     * @param string $query  the value to be matched
     * @return mixed array||FALSE
     * 
     */
    public static function validCheck($column,$query){
    	return self::where($column, $query)->first() ?? FALSE;
    }

}
