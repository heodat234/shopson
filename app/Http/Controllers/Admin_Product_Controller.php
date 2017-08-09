<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Export_Product;
use App\Import_Product;
use App\Bill_Detail;
use App\News;
class Admin_Product_Controller extends Controller
{




//product
   public function Select_Product(){
      $product=Product::Show_Product_All()->orderBy('id','DESC')->get();
      $typepro=0;
      return view('admin.Product_Admin',compact('product','typepro'));
   }

   public function FindProductByType($id,$typeName){
         $product=Product::Product_By_Id_Type($id)->orderBy('updated_at','DESC')->get();
         $typepro=$id;
      return view('admin.Product_Admin',compact('product','typepro','typeName'));
   }
   


   public function ViewPageInsertProduct(){
       $id=0;
      return view('admin.Modify_Product',compact('id'));
   }

   public function ViewPageEditProduct($id,$idsize){
         $product = Product::Product_Info_By_Id($id,$idsize)->first();
         return view('admin.Modify_Product',compact('id','product'));
   }
   public function ViewPageImportProduct($id,$idsize){
      $product = Product::Product_Info_By_Id($id,$idsize)->first();
       $id=-1;
      return view('admin.Modify_Product',compact('id','product'));
   }
   

   public function Insert_Import_Product(Request $req)
   {
      $idPro = $req->id;
      $size = $req->size;
      $qty = $req->quantity;
      $price = $req->import_price;
      $pro = Import_Product::Insert_Import_Product($idPro,$size,$price,$qty);
      return redirect()->route('ViewProductAdmin');
   }
      public function Edit_Product(Request $req){

      $filename="";
      $id = $req->id; 
      $idsize = $req->idsize;
      $name = $req->name;
      $category = $req->category;
      $desc = $req->description;
      $type = $req->type;
      $export_price = $req->export_price;
      $imageOld = $req->imageOld;
      if ($req->hasFile('image')) {
         $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
         $typefile= $req->file('image')->getClientOriginalExtension();
         
         if(!array_key_exists($typefile, $allowed)) {
            return redirect()->back()->with('thatbai','File chọn không phải là ảnh');
         }
         $filename= $req->file('image')->getClientOriginalName();
         $req->file('image')->move('images/products',$filename);
         File::delete('images/products/'.$imageOld);
      }else{
         $filename=$imageOld;
      }
      $pro=Product::Edit_Product($id,$name,$category, $desc, $type,$filename);
      $export_price = Export_product::Updete_Export_Price($idsize,$export_price);
      return redirect()->route('ViewProductAdmin'); 
   }
   public function Insert_Product(Request $req){
      $filename="";
      $name = $req->name;
      $category = $req->category;
      $desc = $req->description;
      $size = $req->size;
      $type = $req->type;
      $export_price = $req->export_price;
      $import_price = $req->import_price;
      $import_quantity = $req->import_quantity;

      $a = explode(',', $size);
      $ex_price = explode(',', $export_price);
      $im_price = explode(',', $import_price);
      $im_qty = explode(',', $import_quantity);

      if ($req->hasFile('image')) {
         $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
         $typefile= $req->file('image')->getClientOriginalExtension();
         
         if(!array_key_exists($typefile, $allowed)) {
            return redirect()->back()->with('thatbai','File chọn không phải là ảnh');
         }
         $filename= $req->file('image')->getClientOriginalName();
         $req->file('image')->move('images/products',$filename);
      }else{
         $filename=null;
      }
      $getId=Product::Insert_Product($name, $category, $desc, $type, $filename);
      for ($i=0; $i < count($a) ; $i++) { 
         $export_product=Export_product::Update_Insert_Export_Product($getId,$a[$i],$ex_price[$i]);
         $import_product=Import_product::Insert_Import_Product($getId,$a[$i],$im_price[$i],$im_qty[$i]);
      }
      
      return redirect()->route('ViewProductAdmin');
   } 
   public function Delete_Product($id,$idsize){
      
      $flag =0;
      $ex = Export_product::Delete_Export($idsize);
      $find_ex = Export_product::Find_Export_By_Product($id)->get();
      for ($i=0; $i < count($find_ex); $i++) { 
         if ($find_ex[$i]->status == 1) {
            $flag +=1;
         }
      }
      if ($flag==count($find_ex)) {
         $pro=Product::Delete_Product($id);
      }
   }
      


   //xem kho
    public function View_Kho(){
      $import=Import_Product::Show_Import_Product_All()->get();
      $sum_import = Import_Product::Sum_Import();
      $sum_export = Bill_Detail::FindSum_Export_Product();
      return view('admin.kho',compact('import','sum_import','sum_export'));
   }
   //nhập kho
   public function ViewPage_InsertKho(){
      $id=0;
         return view('admin.Modify_Kho', compact('id'));
   }
   public function Insert_Kho(Request $req)
   {
      $idPro = $req->id;
      $size = $req->size;
      $qty = $req->quantity;
      $import_price = $req->import_price;
      $export_price = $req->export_price;

      $a = explode(',', $size);
      $im_qty = explode(',', $qty);
      $im_price = explode(',', $import_price);
      $ex_price = explode(',', $export_price);
      $sizes = Import_Product::Select_Size_By_IdProduct($idPro)->get();
      
      for ($i=0; $i < count($a) ; $i++) { 
         $flag=0;
         foreach ($sizes as $size) {
            if ($a[$i]!=$size) {
               $flag += 1;
            }
         }
         if ($flag == count($sizes)) {
            $export_product=Export_product::Update_Insert_Export_Product($getPro,$a[$i],$ex_price[$i]);
         }
         
         $pro = Import_Product::Insert_Import_Product($idPro,$a[$i],$im_price[$i],$im_qty[$i]);
      }
      return redirect()->route('View_Kho');
   }
   //edit kho
   public function ViewPage_EditKho($id)
   {
      $product = Import_Product::Find_Import_By_Id($id)->first();
      return view('admin.Modify_Kho',compact('id','product'));
   }
   public function Edit_kho(Request $req)
   {
      $id= $req->id;
      $quantity = $req->quantity;
      $price = $req->price;
      $pro= Import_Product::Edit_Import($id,$quantity,$price);
      return redirect()->route('View_Kho');
   }

	
	
}