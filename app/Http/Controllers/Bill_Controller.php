<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth; 
use Illuminate\Support\Facades\Input;
use App\Bill;
use App\Bill_Detail;
use App\User;
use App\Export_Product;
use App\Import_Product;
use Session;
class Bill_Controller extends Controller
{
   public function ViewPageBill_Admin()
   {
      $id_user =0;
   	$bills=Bill::All_Bill()->get();
   	return view('admin.Bill_Admin',compact('bills','id_user'));
   }
   //xem chi tiết hóa đơn trong trang Admin
   public function ViewPageBill_Detail_Admin($id)
   {
   	$bill_details=Bill_Detail::View_All($id)->get();
   	return view('admin.BillDetail_Admin',compact('bill_details'));
   }
   //xem chi tiết hóa đơn trong trang Profile
   public function ViewBill_Detail($id_bill)
   {
      $bill_details=Bill_Detail::View_All($id_bill)->get();
      return view('page.profile',compact('bill_details','id_bill'));
   }

   public function ViewPageBill_Admin_Insert( $id)
   {
     
      $bill=Bill::View_bill_byId($id)->first();
      return view('admin.Modify_Bill',compact('bill','id'));
   }
   public function ViewModify_BillDetail(Request $req)
   {
   	$id_bill_detail=$req->id;
      $nameProduct=$req->name;
   	$Bill_Detail=DB::table('bill_detail')->where('id',$id_bill_detail)->select()->first();
   	return view('admin.Modify_BillDetail',compact('Bill_Detail','nameProduct'));
   }

   // public function sizeProduct($id)
   // {
   //    $product =Product::Find_Product_By_Id($id)->first();
   //    return $product;
   // }

   //thay đổi số lượng các sản phẩm trong bill detail
   public function Update_Bill_Detail(Request $req)
   {
   	$id=$req->id;
   	$first_quantity=$req->quantityOld;
   	$quantity=$req->quantity;
   	$id_product=$req->id_product;
   	$size=$req->size;
   	$id_bill=$req->id_bill;
   	$bill_detail=Bill_Detail::Update_Bill_Detail($id,$first_quantity,$quantity,$id_product,$size);
   	return redirect()->route('ViewPageBill_Detail_Admin',$id_bill);
   }
   //thay đổi trang thái bill
   public function Update_Bill(Request $req)
   {
      $id=$req->id;
      $method=$req->method;
      $bill=Bill::Update_Bill($id,$method);
      return redirect()->route('ViewPageBill_Admin');
   }

   //xóa 1 sản phẩm trong billDetail, nếu xóa hết thì xóa bill    
   public function Delete_One_BillDetail(Request $req)
   {
      $id = $req->id;
      $id_product = $req->id_pro;
      $qty = $req->qty;
      $size = $req->size;
      $id_bill = $req->id_bill;
      $ex_qty = Export_Product::Sub_Export_Quantity_Admin($id_product,$size,$qty);
      $pro = Bill_Detail::Delete_One_BillDetail($id,$id_bill);
      if ($pro ==0) {
         $del = DB::table('bills')->where('id',$id_bill)->delete();
         return redirect()->route('ViewPageBill_Admin');
      }else{
         return redirect()->route('ViewPageBill_Detail_Admin', $id);
      }

   }
   //kiểm tra số lượng hàng còn trong kho
   public function CheckQuantity($id_pro,$size,$quantity)
   {
     
      $ex_qty = Export_Product::Export_Quantity_By_IdProduct($id_pro,$size)->first();

      $qty_import = Import_Product::Qty_Import_Product_By_Id($id_pro,$size);
      $inventory = $qty_import - $ex_qty->export_quantity;
      if($quantity<= $inventory)
         return "Số lượng hợp lệ";
      else
         return "Số lượng nhập đã lớn hơn số lượng hàng còn trong kho. Vui lòng nhập lại";
   }


   //xem danh sách bill thuộc user
   public function Show_Bill_By_User($id_user)
   {
      $bills = Bill::Find_Bill_By_Id_User($id_user)->get();
      return view('admin.Bill_Admin',compact('bills','id_user'));
   }


   //đếm bill chưa xác nhận hiện thông báo bên admin
   public function Count_Bill()
   {
      $bill = Bill::Count_Bill();
      return $bill;
   }
}
