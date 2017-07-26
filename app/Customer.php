<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Customer extends Model
{
    protected $table='customer';

    //lấy tất cả loại sản phẩm
    public static function ViewAllCustomer(){
		$customer=DB::table('customer')->select();
		return $customer;
	}
}
