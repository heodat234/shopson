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

	public static function Insert_Customer($name, $email,$address,$phone){
              $id=DB::table('bills')->insertGetId(['full_name'=>$name,'email'=>$email,'address'=>$address,'phone'=>$phone]);
              return $id;
    }
}
