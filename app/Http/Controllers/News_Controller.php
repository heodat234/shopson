<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use DB;
use Auth;
class News_Controller extends Controller
{	
    public function getNews()
    {
    	$news =News::NewById(1)->first();
        $id=1;
    	return view('page.newsSingle',compact('news','id'));

    }
    public function news_By_Id($id)
    {
    	$news = News::NewsById($id)->first();
    	return view('page.newsSingle',compact('news','id'));

    }

    //gọi trang chủ news admin
    public function getNews_Admin()
    {
    	$news =News::Load_News()->get();
    	return view('admin.News_Admin',compact('news'));

    }
    //gọi trang insert news
    public function ViewPageInsertNews()
    {
    	$id=0;
    	return view('admin.Modify_News',compact('id'));
    }
    //gọi trang edit news
    public function ViewPageEditNews($id)
    {
    	$new = News::NewsById($id)->first();
    	return view('admin.Modify_News',compact('new','id'));
    }

    public function Edit_News(Request $req)
    {
    	$id = $req->id;
    	$title = $req->title;
    	$content = $req->content;
    	$new = News::EditNews($id, Auth::User()->id, $title, $content);
    	return redirect()-> route('news_Admin')->with('thanhcong','Sửa tin tức thành công');
    }

    public function Insert_News(Request $req)
    {
    	$title = $req->title;
    	$content = $req->content;
    	$new = News::InsertNews( Auth::User()->id, $title, $content);
    	return redirect()-> route('news_Admin')->with('thanhcong','Thêm tin tức thành công');
    }
    public function Delete_News(Request $req)
    {
    	$id = $req->id;
    	$new = News::DeleteNews($id);
    	return redirect()-> route('news_Admin')->with('thanhcong','Xóa tin tức thành công');
    }
}
