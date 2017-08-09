<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class News extends Model
{
    protected $table='news';

    public static function Load_News()
    {
        $news=DB::table('news')->join('users','users.id','=','news.id_user')->select('users.full_name','news.id_user','news.title','news.content','news.created_at','news.id');;
        return $news;
    }
    
    public static function NewsById($id){
    	$news=DB::table('news')
                ->where('news.id',$id)
    			->join('users','news.id_user','=','users.id')
                ->select('users.full_name','news.id_user','news.title','news.content','news.created_at','news.id');
    	return $news;
    }
    public static function InsertNews($id_user,$title,$content){
        $id=DB::table('news')
                ->insertGetId(['id_user'=>$id_user,'title'=>$title,'content'=>$content]);
        return $id;
    }
    public static function EditNews($id,$id_user,$title,$content){
           $News=DB::table('news')
                    ->where('id',$id)
                    ->update(['id_user'=>$id_user,'title'=>$title,'content'=>$content]);
            return $News;
    }
    public static function DeleteNews($id){
           $News=DB::table('news')
                    ->where('id',$id)
                   ->delete();
            return $News;
    }
}
