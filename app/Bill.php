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

    public static function Insert_Bill($idUser,$name,$email,$phone,$address,$method, $payment){
              $id=DB::table('bills')->insertGetId(['id_user'=>$idUser,'name'=>$name,'email'=>$email,'phone'=>$phone,'address'=>$address,'method'=>$method,'payment'=>$payment]);
              return $id;
    }
    //lấy tất cả các bill
    public static function All_Bill()
    {
      $Bill=DB::table('bills')->select();
      return $Bill;
    }
    //lay bill theo id bill
    public static function View_bill_byId($id)
    {
        $Bill=DB::table('bills')->where('id',$id)->select();
        return $Bill;
    }
    //lấy tất cả các sản phẩm theo id user
    public static function Find_Bill_By_Id_User($id_user)
    {
        $Bill=DB::table('bills')->where('id_user',$id_user)->select();
        return $Bill;
    }
    
    public static function Update_Bill($id,$method)
    {
        $Bill=DB::table('bills')->where('id',$id)->update(['method'=>$method]);
    }
    //đếm các bill mới, chưa xác nhận
    public static function Count_Bill()
    {
        $count_bill = DB::table('bills')->where('method',0)->count();
        return $count_bill;
    }
    //đếm tất cả các bill
    public static function Count_All_Bill()
    {
        $bill = DB::table('bills')->count();
        return $bill;
    }
}
