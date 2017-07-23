<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Auth;   
use App\Product;
use App\TypeProduct;
use App\Bill_Detail;
use Carbon\Carbon;
use App\User;
use App\News;
use PDF;    
use Hash;
use App\Bill;
use Session;
class Admin_Controller extends Controller
{


//product
public function Select_Product(){
      $product=Product::Show_Product_All()->get();
      $typepro=0;
      return view('admin.Product_Admin',compact('product','typepro'));
   }
   public function FindProductByType(Request $req){
         $product=Product::Find_Product_By_Type($req->id)->get();
         $typepro=1;
      return view('admin.Product_Admin',compact('product','typepro'));
   }
      public function Edit_Product(Request $req){

      $filename="";
      $id = $req->input('id');
      // dd($id);
      $name = $req->input('edit_name');
      $type = $req->input('edit_type');
      $desc = $req->input('edit_des');
      $unit_price = $req->input('edit_unit_price');
      if ($req->hasFile('edit_image')) {
         $filename= $req->file('edit_image')->getClientOriginalName();
      $req->file('edit_image')->move('images/products',$filename);
      }else{
         $filename=null;
      }
      $pro=Product::Edit_Product($id,$name,$type, $desc, $unit_price,$filename);
      return $pro; 
   }
   public function Insert_Product(Request $req){
      $filename="";
      $name = $req->input('new_name');
      $type = $req->input('new_type');
      $desc = $req->input('new_des');
      $unit_price = $req->input('new_unit_price');
       if ($req->hasFile('new_image')) {
         $filename= $req->file('new_image')->getClientOriginalName();
      $req->file('new_image')->move('images/products',$filename);
      }else{
         $filename=null;
      }
      $getId=Product::Insert_Product($name, $type, $desc, $unit_price,$filename);
      return $getId;
   } 
   public function Delete_Product(Request $req){
      $id = $req->id;
      $image = $req->imageFile;
      File::delete('images/product/'.$image);
      $pro=Product::Delete_Product($id);
   }
}