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
use App\Customer;
use PDF;    
use Hash;
use App\Bill;
use Session;
use Mail;

class Admin_Controller extends Controller
{
    public function ViewContent_Admin()
   {
      // $MostViewProduct=Product::MostViewProduct();
      // $Total_view= $MostViewProduct[1];
      // $MostViewProduct=$MostViewProduct[0];
      // $FindSumQuantity=Bill_Detail::FindSum_Quantity();
      return view('admin.content');
   }
//login
   public function Login_Admin()
   {
      return view('Admin.login_Admin');
   }
//Loại sản phẫm 
   public function PostLogin_Admin(Request $req){
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
            if(Auth::User()->group>=1){
               Session::put('group',Auth::User()->group);
               // $_SESSION['group']=;
               return redirect()->route('ViewContentAdmin');}
             else
               return redirect()->back()->with('thatbai','Bạn không có quyền truy cập vào trang này');
        }
        else{
            return redirect()->back()->with('thatbai','Sai thông tin đăng nhập');
        }
    }
   public function PostForgetPassword(Request $req){
      $user=User::User_All()->where('email',$req->email)->get();
      // dd($user[0]->email);
      if(isset($user[0])){
            $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i <6 ; $i++) {
                 $randomString .= $characters[rand(0, $charactersLength - 1)];
             }
            Mail::send('page.mailForgetPass',['matkhau'=>$randomString], function ($message)  use ($user)
            {
              $message->from('thanhhung23495@gmail.com', "Sơn ViLa Paint");
              $message->to($user[0]->email,$user[0]->full_name);
              $message->subject('Cấp lại mật khẩu');
            });
             DB::table('users')->where('email','=',$req->email)->update(['password'=>Hash::make($randomString)]);
             return redirect()->route('Login_Admin')->with('thanhcong','Mật khẩu mới đã được gửi tới email của bạn. Vui lòng kiểm tra email để lấy mật khẩu và đăng nhập.');  
      }
      else
            return redirect()->back()->with('thatbai','Nhập Không Đúng Email hoặc Email Bạn Không Tồn Tại');
    }
   public function ForgetPassword() {
   return view('page.ForgetPassWord');
   }




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




   //Customer
   public function ViewAllCustomer(){
      $customer=Customer::ViewAllCustomer()->get();
      return view('admin.Customer_Admin',compact('customer'));
   }



   //User
   public function Select_User(){
      $user=User::User_All()->get();
  
      return view('Admin.User_Admin',compact('user'));
   }
   public function Edit_User(Request $req){
      $id = $req->input('id');
      $name = $req->input('edit_name');
      $phone = $req->input('edit_phone');
      $address = $req->input('edit_address');
      $group = $req->input('edit_group');
      $user=User::Edit_User($id, $name, $phone, $address, $group);
   }
   public function Insert_User(Request $req){
      $name = $req->input('new_name');
      $email = $req->input('new_email');
      $password = Hash::make($req->input('new_password'));
      $phone = $req->input('new_phone');
      $address = $req->input('new_address');
      $group = $req->input('new_group');
      $token=$req->input('_token');
      $getId=User::Insert_User($name, $email, $password, $phone, $address, $group, $token);
      return $getId;
   } 
   public function Delete_User(Request $req){
      $id = $req->id;
      $user=User::Delete_User($id);
   }
}