<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
use Input;
use App\Export_Product;
use App\Import_Product;
use Auth;
use App\Bill;
use App\Customer;
use App\Bill_Detail;


class CartController extends Controller
{
    //
    // public function demo($id,$size)
    // {
    //     $qty_import = Import_Product::Qty_Import_Product_By_Id($id,$size);
    //     dd($qty_import);
    // }
    public function addToCart( $idsize,$quantity,$color) // add gio hang
    {       
            $product = Export_Product::FindProductByIdPro_Size($idsize)->first();
            $qty_import = Import_Product::Qty_Import_Product_By_Id($product->id,$product->size);//lấy tổng sản phẩm nhập theo size
            
            $inventory = $qty_import - $product->export_quantity;//hàng còn lại trong kho
            
            // dd($quantity);
            if ($inventory>=$quantity) {
                $export_qty =Export_Product::Add_Export_Quantity($idsize,$quantity);//thêm số lượng vao số lượng đã bán
                $oldCart = Session('cart') ? Session('cart') : null;
                $cart = new Cart($oldCart);
                $cart->add($product, $product->idsize ,$quantity,$color, $inventory-$quantity);
                Session::put('cart', $cart);
                return "0".json_encode($cart);
            }else{
                if ($inventory<=0) {
                     return "1Sản phẩm loại ".$product->size." chỉ còn lại 0 thùng. Xin quý khách thông cảm";
                }else
                    return "1Sản phẩm loại ".$product->size." chỉ còn lại ".$inventory." Thùng. Vui lòng chọn lại số lượng không quá ".$inventory;
            }
            
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
            // dd($cart);
            return view('page.cartview')->with(['items'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalQty'=>$cart->totalQty]);

         }
         else
            return view('page.cartview');

    }

    public function deleteCart()
    {
        if(Session::has('cart'))
        {   
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart); 
            foreach ($cart->items as $ca) {
                $export_qty =Export_Product::Sub_Export_Quantity($ca['item']->idsize,$ca['qty']);
                // dd($ca['item']->idsize);
            }
            Session::forget('cart');
            return json_encode($cart);
        }
    }

    public function getCheckOut()
    {
        if(Session::has('cart'))
        {   
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart); 
            
            return view('page.checkout')->with(['items'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalQty'=>$cart->totalQty]);

         }
         else
            return view('page.home');

    }
    public function postCheckOut(Request $req)
    {
        if(Session::has('cart'))
        {   
            $method="";
            $idUser="";
            $idBill="";
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart); 
            
            $email = $req->email;
            $name = $req->name;
            $address = $req->address;
            $phone = $req->phone;
            $payment = $req->payment;
            if($payment==1){
                $method =2;
            }else $method =0;   
            if (Auth::check()){
                   $idUser = Auth::User()->id;   
            }else
               $idUser = 0;
            
            $idBill = Bill::Insert_Bill($idUser,$name,$email,$phone,$address,$method,$payment);
            foreach ($cart->items as $item) {
                $price = $item['price']/$item['qty'];
                $bill_detail = Bill_Detail::Insert_Bill_Detail($idBill,$item['item']->id,$item['qty'],$item['size'],$item['color'],$price);
                
            }
            Session::forget('cart');
            return  redirect()->route('home')->with('thanhcong',"Đặt hàng thành công");
            // return view('page.checkout')->with(['items'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalQty'=>$cart->totalQty]);

         }
         else
            return view('page.home');

    }

    
}
