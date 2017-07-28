<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
class SearchController extends Controller
{
    public function autocomplete(Request $req){
		$term = $req->term;
		$results = array();
		$queries=DB::table('products')->whereRaw("match(name) against('$term')")->orWhere('name', 'LIKE', '%'.$term.'%')->get();
		// $queries = Product::where('name', 'LIKE', '%'.$term.'%')
		// 	     // ->take(5)->get();
			
		foreach ($queries as $query)
		{
		    $results[] = [ 'id' => $query->id, 'value' =>$query->name];
		}
		return response()->json($results);
	}

	public function singleProduct(Request $req)
   {
   	$id = $req->input('id');
   	$product =Product::Find_Product_By_Id($id)->get();
      $view1=$product[0]->view +1;
      $view =DB::table('products')->where('products.id','=',$id)->update(['view'=>$view1]);    
   	return view('page.single',compact('product'));
   }
}
