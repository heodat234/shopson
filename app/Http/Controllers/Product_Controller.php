<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\News;
class Product_Controller extends Controller
{
	//lấy tất cả sản phẩm theo loại cha
	public function All_Product($id)
   {
   	$Product=Product::All_Product_ById($id);
    $typepro=0;
   	return view('page.product',compact('Product','typepro','id'));
   }
   //lấy tất cả sản phẩm theo loại con
   public function Product_Child($id)
   {
   	$Product=Product::Product_By_Id_Type($id)->get();
    $typepro=1;
   	return view('page.product',compact('Product','typepro','id'));
   }
   //lấy tất cả sản phẩm theo loại nội thất, ngoại thất
   public function Show_Product_By_Type($id, Request $req)
   {
      $type= $req->type;
   	$typepro="";
   	$type_cha= DB::table('category')->where('id',$id)->select('type_cha')->get();
   	if ($type_cha[0]->type_cha==0) {
   		$typepro=0;
   		if($type==2){
   			$Product=Product::All_Product_ById($id);
   		}else
   			$Product=Product::Show_Product_By_TypeCha($id,$type);
   	}else{
   		$typepro=1;
   		if($type==2){
   			$Product=Product::Product_By_Id_Type($id)->get();
   		}else
   		$Product=Product::Show_Product_By_Type($id,$type)->get();
   	}
   	return view('page.product',compact('Product','typepro','id'));
   }

   public function single_Product($id)
   {
   	$product =Product::Find_Product_By_Id($id)->get();
      $view1=$product[0]->view +1;
      $view =DB::table('products')->where('products.id','=',$id)->update(['view'=>$view1]);    
   	return view('page.single',compact('product'));
   }
	
}