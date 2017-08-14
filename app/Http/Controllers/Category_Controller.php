<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Category;
use App\News;
class Category_Controller extends Controller
{
   //hiện tất cả các loại
   public function View_Category()
   {
      $category = Category::Show_Type_product()->orderBy('id','DESC')->get();
      $type=0;
      return view('admin.Category_Admin',compact('category','type'));
   }
   //hiện những loại con theo loại cha
	public function View_Category_By_Parent($id_cha)
   {
      $category = Category::Show_Category_By_Id_Parent($id_cha)->get();
      $type = $id_cha;
      return view('admin.Category_Admin',compact('category','type'));
   }
   //gọi trang sửa loại
	public function ViewPage_EditCategory($id)
   {
      $category = Category::Show_Category_By_Id($id)->first();
      return view('admin.Modify_Category',compact('category','id'));
   }
   //gọi trang thêm loại 
   public function ViewPage_InsertCategory()
   {
      $id=0;
      return view('admin.Modify_Category',compact('id'));
   }

   public function Edit_Category(Request $req){

      $filename="";
      $id = $req->id; 
      $name = $req->name;
      $type_cha = $req->type_cha;
      $desc = $req->desc;
      $imageOld = $req->imageOld;
      if ($req->hasFile('image')) {
         $allowed = array("jpg" => "image/jpg", "JPG" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
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
      $category = Category::Edit_Category($id,$name,$type_cha,$desc,$filename);
      return redirect()->route('View_Category'); 
   }

   public function Insert_Category(Request $req){

      $filename="";
      $name = $req->name;
      $type_cha = $req->type_cha;
      $desc = $req->desc;
      if ($req->hasFile('image')) {
         $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
         $typefile= $req->file('image')->getClientOriginalExtension();
         
         if(!array_key_exists($typefile, $allowed)) {
            return redirect()->back()->with('thatbai','File chọn không phải là ảnh');
         }
         $filename= $req->file('image')->getClientOriginalName();
         $req->file('image')->move('images/products',$filename);
      }
      $category = Category::Insert_Category($name,$type_cha,$desc,$filename);
      return redirect()->route('View_Category'); 
   }
   
   public function Delete_Category(Request $req)
   {
      $id = $req->id;
      $category = Category::Delete_Category($id);
   }
}