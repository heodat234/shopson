<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
use Socialite;
use App\User;
use Mail;

class LoginRegister_Controller extends Controller
{
   
    public function postRegister(Request $req){
        $this->validate($req,['email'=>'required|email', 'full_name'=>'required', 'password'=>'required|between:6,20', 'phone'=>'numeric|min:10', 're_password'=>'required|same:password'
            ],['email.required'=>'Vui lòng nhập Email',
                'full_name.required'=>'Vui lòng nhập tên tài khoản',
                'email.email'=>'Email không đúng định dạng',
                'phone.numeric'=>'Điện thoại phải thuộc kiểu số',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.between'=>'Mật khẩu phải từ 6 đến 20 kí tự',
                're_password.same'=>'Mật khẩu không khớp',
                're_password.required'=>'Vui lòng nhập xác nhận mật khẩu',
                'phone.min'=>'Điện thoại chỉ được 10 hoặc 11 số'
            ]);
        $mail = User::where('email',$req->email)->first();
        if($mail){
          $data ="1";
          return $data."Email đã tồn tại";
        }else{
            $user = new User();
            $user->full_name = $req->full_name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->phone = $req->phone;
            $user->address = $req->address;
            $user->remember_token = $req->_token;
            $user->group = 0;
            $user->save();
            
            Mail::send('page.mail',['nguoidung'=>$user], function ($message) use ($user)
            {
              $message->from('thanhhung23495@gmail.com', "Sơn ViLa Paint");
              $message->to($user->email,$user->full_name);
              $message->subject('xác nhận tài khoản');
            });
            $data="0";
           return $data."Đăng ký thành công, Vui lòng kiểm tra Email";
        }
    }

   
   public function postLogin(Request $req){
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
            $data="0";
                return $data.Auth::User()->full_name;
        }
        else{
          $data="1";
            return $data."Sai thông tin đăng nhập";
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

   




    public function redirectToProvider($providers){
        return Socialite::driver($providers)->redirect();
    }
    public function handleProviderCallback($providers){
      try{
          $socialUser = Socialite::driver($providers)->user();
          // return $user->getEmail();
      }
      catch(\Exception $e){
        dd($e);
          return redirect()->route('home')->with('thatbai',"Đăng nhập không thành công");
      }
      $socialProvider = User::where('provider_id',$socialUser->getId())->first();
      if(!$socialProvider){
          //tạo mới
          $user = User::where('email',$socialUser->getEmail())->first();
          if($user){
            return redirect()->route('home')->with('thatbai',"Email đã có người sử dụng");
          }
          else{
            $user = new User();
            $user->provider_id = $socialUser->getId();
            $user->email = $socialUser->getEmail();
            $user->full_name = $socialUser->getName();
            $user->provider = $providers;
            $user->save();
          }
      }
      else{
          $user = User::where('email',$socialUser->getEmail())->first();
      }
      Auth()->login($user);
      return redirect()->route('home')->with('thanhcong',"Đăng nhập thành công");
    }

    public function activeUser(Request $req){
        $user = User::where('id',$req->id)->first();
        if($user){
            $user->active=1;
            $user->save();
            return redirect()->route('home')->with('thanhcong','Đã kích hoạt tài khoản');
        }
    }
     public function postEditProfile(Request $req)
     {
      $id = $req->id;
      $name = $req->name;
      $phone = $req->phone;
      $address = $req->address;

       $user = User::Edit_User($id,$name,$phone,$address,0);
       $group = DB::table('users')->where('id',$id)->select('group')->first();
       if($group==0)
        return redirect()->route('profile')->with('thanhcong','Sửa thông tin thành công');
        else
          return redirect()->route('profileAdmin')->with('thanhcong','Sửa thông tin thành công');
     }
    public function changePassword(Request $req)
    {
      $email = $req->email;
      $password = $req->password;
      $user =User::changePassword($email, $password);
      Auth::logout();
      return redirect()->route('home')->with('thanhcong','Đổi nhập khẩu thành công, vui lòng đăng nhập lại');
    }

    public function checkEmail(Request $req)
    {
      $mail = DB::table('users')->where('email',$req->email)->first();
      if($mail){
        return "Email đã tồn tại trong một tài khoản. Vui lòng đăng nhập hoặc điền một email khác.";
      }else{
        return "Email hợp lệ";
      }

    }
}
