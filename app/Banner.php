<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Banner extends Model
{
    protected $table='banner';

    public static function All_Banner()
    {
    	$banner = DB::table('banner')->select();
    	return $banner;
    }
    
}
