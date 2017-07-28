<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use Input;
use App\Export_Product;

class CartController extends Controller
{
    //
    public function addToCart( $idsize,$quantity,$color) // add gio hang
    {       
            $product = Export_Product::FindProductByIdPro_Size($idsize)->first();

            // $product = Product::find($id);
            $oldCart = Session('cart') ? Session('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $product->id,$quantity,$color);
            Session::put('cart', $cart);
            return json_encode($cart);
    }

    public function deleteItemCart($id)
    {
            $oldCart=Session('cart')?Session::get('cart'):null;
            $cart=new Cart($oldCart);
            $cart->removeItem($id);
            if(count($cart->items)<=0)
                Session::forget('cart');
            else
                Session::put('cart',$cart);
            return json_encode($cart);
      
    }

    public function reduceByOne($id)
    {
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
        return json_encode($cart);
    }

    public function riseByOne($id)
    {
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->riseByOne($id);

        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
        return json_encode($cart);
    }



    public function showCart()
    {
        if(Session::has('cart'))
        {   
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart); 
            
            return view('page.cartview')->with(['items'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalQty'=>$cart->totalQty]);

         }
         else
            return view('page.cartview');

    }

    public function deleteCart()
    {
        Session::forget('cart');
        return "<script> alert('Bạn đã xóa giỏ hàng !'); window.location = '".url('cart_product')."';</script>";
    }

    
}
