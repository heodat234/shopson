<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class News extends Model
{
    protected $table='news';
    public static function Load_ALL_News(){
    	$news=DB::table('news')->select();
    	return $news;
    }
    public static function NewById($id){
    	$news=DB::table('news')
                ->where('news.id',$id)
    			->join('users','news.id_user','=','users.id')->select();
    	return $news;
    }
    public static function InsertNews($id_user,$title,$image,$description,$content,$category_id_news){
        $id=DB::table('news')
                ->insertGetId(['id_user'=>$id_user,'title'=>$title,'image'=>$image,'description'=>$description,'content'=>$content,'Category_ID_News'=>$category_id_news]);
        return $id;
    }
    public static function UpdateNews($id,$id_user,$title,$image,$description,$content,$category_id_news){
           $News=DB::table('news')
                    ->where('id',$id)
                    ->update(['id_user'=>$id_user,'title'=>$title,'image'=>$image,'description'=>$description,'content'=>$content,'Category_ID_News'=>$category_id_news]);
            return $News;
    }
    public static function DeleteNews($id){
           $News=DB::table('news')
                    ->where('id',$id)
                   ->delete();
            return $News;
    }
}
