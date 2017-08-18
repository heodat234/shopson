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
      return view('admin.content');
   }
   //login
   public function Login_Admin()
   {
      return view('Admin.login_Admin');
   }
   //dang xuất
   public function getLogout_Admin(){
        Auth::logout();
        return redirect()->route('Login_Admin');
    }

   public function getProfileAdmin()
   {
      return view('admin.profile');
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
    //gửi lại password mới về mail
   public function PostForgetPassword(Request $req){
      $user=User::User_All()->where('users.email',$req->email)->get();
      // dd($user[0]->email);
      if(isset($user[0])){
            $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i <8 ; $i++) {
                 $randomString .= $characters[rand(0, $charactersLength - 1)];
             }
            Mail::send('page.mailForgetPass',['matkhau'=>$randomString,'email'=>$user[0]->email], function ($message)  use ($user)
            {
              $message->from('thanhhung23495@gmail.com', "Sơn ViLa Paint");
              $message->to($user[0]->email,$user[0]->full_name);
              $message->subject('Cấp lại mật khẩu');
            });
             
             return redirect()->route('home')->with('thanhcong','Mật khẩu mới đã được gửi tới email của bạn. Vui lòng kiểm tra email để lấy mật khẩu và đăng nhập.');  
      }
      else
            return redirect()->back()->with('thatbai','Nhập Không Đúng Email hoặc Email Bạn Không Tồn Tại');
    }
    public function loginForgetPassword($email, $pass)
    {
      DB::table('users')->where('email','=',$email)->update(['password'=>Hash::make($pass)]);
      return redirect()->route('home')->with('thanhcong','Đăng nhập với mật khẩu đã gửi tới mail của bạn.');  
    }
    //gọi trang quên mật khẩu
   public function ForgetPassword() {
   return view('page.ForgetPassWord');
   }








   //User
   public function Select_User(){
      $user=User::User_All()->get();
  
      return view('Admin.User_Admin',compact('user'));
   }
   //thêm tài khoản nhân viên
   public function Insert_User(Request $req){
      $name = $req->input('new_name');
      $email = $req->input('new_email');
      $password = Hash::make($req->input('new_password'));
      $phone = $req->input('new_phone');
      $address = $req->input('new_address');
      $group = 1;
      $token=$req->input('_token');
      $mail = User::where('email',$email)->first();
        if($mail){
          $data ="0";
          return $data."Email đã tồn tại";
        }else{
          $getId=User::Insert_User($name, $email, $password, $phone, $address, $group, $token);


          return "1"."Đăng ký thành công.";
        }
   } 
   //xóa tài khoản nhân viên
   public function Delete_User(Request $req){
      $id = $req->id;
      $user=User::Delete_User($id);
   }
}