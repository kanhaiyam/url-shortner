<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Stats extends Model
{

    protected $table = 'stats' ; 
    protected $primary_key = 'id';
    /**
     * Check if the user has already clicked or not.
     * 
     * @return mixed integer||FALSE <ID of the row found.>
     * 
     */
    public function clickExists($ip, $id){
        return self::where('ip', $ip)->where('hash', $id)->first()['id'] ?? FALSE;
    }
}
