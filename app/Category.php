<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Category extends Model
{
    protected $table ='category';
 //    public function products(){
 //    	return $this->hasMany('App\Product','id_type','id');
 //    }
 //    public static function Show_Type_product(){
	// 	$Type_product=DB::table('category')->select('id','name');
	// 	return $Type_product;
	// }	

	// public static function Edit_Category($id, $name, $desc, $image, $type){
 //        $pro=DB::table('category')->where('id','=',$id)->update(['name'=>$name, 'description'=>$desc,'image'=>$image, 'type'=>$type]);
 //        return $pro; 
 //  	}
 //  	public static function Insert_Category($name, $desc, $image, $type){
 //            $id=DB::table('category')->insertGetId(['name'=>$name,'description'=>$desc,'image'=>$image, 'type'=>$type]);
 //            return $id;
 //  	}
	// public static function Delete_Category($id){
	// 	$pro=DB::table('products')->where('id_type',$id)->delete();
	// 	$type_pro=DB::table('category')->where('id',$id)->delete();
	// }



	//lấy tất cả loại sản phẩm
    public static function Show_Type_product(){
		$Type_product=DB::table('category')->select('id','name');
		return $Type_product;
	}	
	//lấy loại sản phẩm cha
	public static function TypeParent_product(){
		$Type_parent=DB::table('category')->where('type_cha','=','0')->select();
		return $Type_parent;
	}
	//lấy loại sản phẩm con
	public static function TypeChild_product(){
		$Type=DB::table('category')->where('type_cha','!=','0')->select();
		return $Type;
	}
	public static function vi_to_en($str){
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		  $str = preg_replace("/(đ)/", 'd', $str);
		  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		  $str = preg_replace("/(Đ)/", 'D', $str);
		  $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
		  return $str;
	}
}
