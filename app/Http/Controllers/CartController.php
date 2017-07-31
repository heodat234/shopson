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
            

            if ($inventory>=$quantity) {
                $export_qty =Export_Product::Add_Export_Quantity($product->id,$product->size,$quantity);//thêm số lượng vao số lượng đã bán
                $oldCart = Session('cart') ? Session('cart') : null;
                $cart = new Cart($oldCart);
                $cart->add($product, $product->idsize ,$quantity,$color, $inventory);
                Session::put('cart', $cart);
                return "0".json_encode($cart);
            }else{
                return "1Sản phẩm loại ".$product->size." chỉ còn lại ".$inventory." Thùng. Vui lòng chọn lại số lượng không quá ".$inventory;
            }
            
    }

    public function deleteItemCart($id)
    {
            $oldCart=Session('cart')?Session::get('cart'):null;
            $cart=new Cart($oldCart);
            $export_qty =Export_Product::Sub_Export_Quantity($cart->items[$id]['item']->id, $cart->items[$id]['size'],$cart->items[$id]['qty']);
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
        $export_qty =Export_Product::Sub_Export_Quantity($cart->items[$id]['item']->id,$cart->items[$id]['size'],1);

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
        $export_qty =Export_Product::Add_Export_Quantity($cart->items[$id]['item']->id,$cart->items[$id]['size'],1);

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
            $idBill="";
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart); 
            
            $email = $req->email;
            $name = $req->name;
            $address = $req->address;
            $phone = $req->phone;
            $payment = $req->payment;
            if(Auth::check()){
                $idUser = Auth::User()->id;
                $idBill = Bill::Insert_Bill_User($idUser,$payment);
            }else{
                $idCustomer = Customer::Insert_Customer($name, $email,$address,$phone);
                $idBill = Bill::Insert_Bill_Customer($idCustomer,$payment);
            }
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
