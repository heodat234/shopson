<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->validate($req,['email'=>'required|email', 'full_name'=>'required', 'password'=>'required|min:6|max:10', 'phone'=>'numeric', 're_password'=>'required|same:password'
            ],['email.required'=>'Vui lòng nhập Email',
                'email.email'=>'Email không đúng định dạng',
                'Phone.numeric'=>'Điện thoại phải thuộc kiểu số',
                'password.redirect'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                're_password.same'=>'Mật khẩu không khớp'
            ]);
        // DB::table('users')->insert([
        // 		'full_name'=>'lam'
        // 	]);
        $user = new User();
        $user->full_name = $req->full_name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;

        $user->save();
        
        

       return redirect()->back()->with('thongbao','Đăng ký thành công, Vui lòng kiểm tra Email');
    }

   
   public function postLogin(Request $req){
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
                return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('thatbai','Sai thông tin đăng nhập');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function getMyPage(){
      return view('page.myPage');
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
            //if($providers == 'google'){
              // $image = explode('?',$socialUser->getAvatar());
              // $user->avatar = $image[0];
           // }
           // $user->avatar = $socialUser->getAvatar();
            $user->save();
          }
          // $provider = new SocialProvider();
          // $provider->provider_id = $socialUser->getId();
          // $provider->provider = $providers;
          // $provider->email = $socialUser->getEmail();
          // $provider->save();
      }
      else{
          $user = User::where('email',$socialUser->getEmail())->first();
      }
      Auth()->login($user);
      return redirect()->route('home')->with('thanhcong',"Đăng nhập thành công");
    }

    public function activeUser(Request $req){
        $user = User::find($req->id);
        if($user){
            $user->active=1;
            $user->save();
            return redirect()->route('dangky')->with(['thanhcong','Đã kích hoạt tài khoản']);
        }
    }
}
