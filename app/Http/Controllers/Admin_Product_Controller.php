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




   //lây tất cả sản phẩm
   public function Select_Product(){
      $product=Product::Show_Product_All()->orderBy('id','DESC')->get();
      $typepro=0;
      return view('admin.Product_Admin',compact('product','typepro'));
   }
   //hiện những sản phẩm theo loại
   public function FindProductByType($id,$typeName){
         $product=Product::Product_By_Id_Type($id)->orderBy('updated_at','DESC')->get();
         $typepro=$id;
      return view('admin.Product_Admin',compact('product','typepro','typeName'));
   }
   

   //gọi trang thêm sản phẩm mới
   public function ViewPageInsertProduct(){
       $id=0;
      return view('admin.Modify_Product',compact('id'));
   }
   //gọi trang sửa sản phẩm
   public function ViewPageEditProduct($id,$size){
         $product = Product::Product_Info_By_Id($id,$size)->first();
         $import =Import_Product::Find_Import_By_IdPro($id,$size)->first();
         return view('admin.Modify_Product',compact('id','product','import'));
   }
   //gọi trang nhập thêm kho
   public function ViewPageImportProduct($id,$idsize){
      $product = Product::Product_Info_By_Id($id,$idsize)->first();
       $id=-1;
      return view('admin.Modify_Product',compact('id','product'));
   }
   
   //thêm sản phẩm vào kho
   public function Insert_Import_Product(Request $req)
   {
      $idPro = $req->id;
      $sizeOld = $req->sizeOld;
      $size = $req->size;
      $qty = $req->quantity;
      $price = $req->import_price;
      $export_price = $req->export_price;
      if ($size==$sizeOld) {
         $pro = Import_Product::Insert_Import_Product($idPro,$size,$price,$qty);
      }else{
         $pro = Import_Product::Insert_Import_Product($idPro,$size,$price,$qty);
         $export_product=Export_product::Update_Insert_Export_Product($idPro,$size,$export_price);
      }
      
      return redirect()->route('ViewProductAdmin');
   }


   //sửa sản phẩm, size, giá nhập, bán trong 3 bảng
      public function Edit_Product(Request $req){

      $filename="";
      $id = $req->id; 
      $size = $req->size;
      $sizeOld = $req->sizeOld;
      $name = $req->name;
      $category = $req->category;
      $desc = $req->description;
      $type = $req->type;
      $export_price = $req->export_price;
      $import_price = $req->import_price;
      $import_quantity = $req->import_quantity;
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

      $import=Import_Product::Find_Import_By_IdPro($id,$sizeOld)->get();
      //kiểm tra xem kích thước mới nhập có bằng kích thước ban đầu hay không nếu bằng update lai giá không bằng thì kiểm tra xem trong bang export co cai kích thước đó chưa nếu có thì trả về là đã có
            if($sizeOld!=$size)
            {
             $pro=DB::table('export_product')
                    ->where([['id_product','=',$id],['size','LIKE','%'.$size.'%'],])->select()->first();
                if(!isset($pro))
                {
                //kiểm tra xem trong bảng import product có hơn 2 lần nhập hàng hay không nếu hơn 2 lần thì thêm kích thước vô bảng export do nếu thay đổi size sẽ gây ra mất hàng bán ra
                    
                    if(isset($import[1]))
                    {
                        $pro=DB::table('export_product')->insert(['id_product'=>$id,'size'=>$size,'export_price'=>$export_price]);
                    }
                    elseif(isset($import[0]))
                    {
                        $pro=DB::table('export_product')
                                ->where([['id_product','=',$id],['size','LIKE','%'.$sizeOld.'%'],])
                                ->update(['size'=>$size,'export_price'=>$export_price]);
                     }
                }
                else
                   {
                    //nếu như size bị  nhập kho sai mà trước khi size bị size đó đã có rồi thỉ chỉ update lại giá size mới còn nếu như size bị sai đó lúc trước mà chưa có thì phãi liên hệ thằng admin để xóa size đó đi
                    $pro=DB::table('export_product')
                            ->where([['id_product','=',$id],['size','LIKE','%'.$size.'%'],])
                            ->update(['export_price'=>$export_price]);
                   }
            }

      $im = DB::table('import_product')->where('id',$import[0]->id)->update(['size'=>$size,'import_price'=>$import_price,'import_quantity'=>$import_quantity]);

      $pro=Product::Edit_Product($id,$name,$category, $desc, $type,$filename);
      return redirect()->route('ViewProductAdmin'); 
   }




   //thêm sản phẩm mới, gồm cả thêm giá nhập, bán, kích thước
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


      if ($req->hasFile('image')) {
         $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png","JPG" => "image/JPG",);
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
      $export_product=Export_product::Update_Insert_Export_Product($getId,$size,$export_price);
      $import_product=Import_product::Insert_Import_Product($getId,$size,$import_price,$import_quantity);
      
      return redirect()->route('ViewProductAdmin');
   } 
   //xóa theo từng size, nếu xóa hết size của sản phẩm đó thì xóa sản phẩm
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




   //bỏ
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

      // $sizes = Import_Product::Select_Size_By_IdProduct($idPro)->get();
      
      $export_product=Export_product::Update_Insert_Export_Product($idPro,$size,$export_price);

      $pro = Import_Product::Insert_Import_Product($idPro,$size,$import_price,$qty);
   
      return redirect()->route('View_Kho');
   }


   //đã bỏ
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

	//xem bảng export, xem hàng lỗi
   public function View_Export()
   {
      $exports = Export_Product::Select_Export()->get();
      return view('admin.Export',compact('exports'));
   }
   public function updateErrorQuantity(Request $req)
   {
     $id = $req->id;
     $error = $req->error;
     $export = Export_Product::Update_Error_Quantity($id,$error);
     return redirect()->route('View_Export')->with('thanhcong','Sửa hàng lỗi thành công');
   }
	
}