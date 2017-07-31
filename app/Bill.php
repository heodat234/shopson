<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Bill extends Model
{
    protected $table='bills';

    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }

    public static function Insert_Bill_User($idUser, $payment){
              $id=DB::table('bills')->insertGetId(['id_user'=>$idUser,'payment'=>$payment]);
              return $id;
    }
    public static function Insert_Bill_Customer($idCustomer, $payment){
              $id=DB::table('bills')->insertGetId(['id_customer'=>$idCustomer,'payment'=>$payment]);
              return $id;
    }
}
