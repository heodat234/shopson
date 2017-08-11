<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
use App\Bill;
use Auth;
class Home_Controller extends Controller
{
   public function getIndex()
   {
   	return view('page.home');
   }
   public function getContact()
   {
      return view('page.contact');
   }
   public function getProfile()
   {
      $bills = Bill::Find_Bill_By_Id_User(Auth::User()->id)->get();
      $id_bill=0;
      return view('page.profile', compact('bills','id_bill'));
   }
   
   // public function info(){
   // 	return view('page.gioithieu');
   // }
   // public function news_All(){
   //    $news=News::Load_ALL_News()->orderBy('created_at','DESC')->paginate(5);
   //    $typeidtintuc=0;
   //    return view('page.tintuc',compact('news','newNoiBat','typeidtintuc'));
   // }
   // public function NewsById($id){
   //    $NewsById=News::Load_ALL_News()->where('Category_ID_News',$id)->orderBy('id','DESC')->paginate(5);
   //    $typeidtintuc=$id;
   //    return view('page.tintuc',compact('NewsById','typeidtintuc'));
   // }
   // public function newsdetail($id){
   //    $newDetail=News::NewById($id)->get();
   //    return view('page.ChitietTintuc',compact('newDetail'));
   // }
   //   public function contact(){
   // 	return view('page.lienhe');
   // }

   // public function getGiohang(){
   //    return view('page.giohang');
   // }
}
