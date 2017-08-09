
@if(Session::has('cart'))
<table >
<div class="alert alert-danger khongdu" style="display: none;"></div> <!--Start table that will holds all data in the shopping cart --> 
@foreach($items as $item)
{{-- {{ dd($item['id']) }} --}}
    <tr class='itemInCardRow'>            
        <td class='itemInCartDisplay col-sm-2'>
            <img class='img-responsive item_disp_image' style='width:80px; height: 100px; float:left;' src="images/products/{{$item['item']->image}}">
        </td>

        <td class='itemInCartDisplay col-sm-4'>
            <b>{{$item['item']->name}}</b>
            <br>
            Mã màu: # @if($item['color'] != "undefined ")
                        {{ $item['color'] }}
                    @else Không
                    @endif
            <br> 
            Size: {{ $item['size'] }}           
        </td>

        <td class='itemInCartDisplay col-sm-3'>
            <a href='javascript:void(0)' class='subtruct_itm_qty quantity_change' item_id="{{$item['id']}}" >-</a>  
                <span class='quantity'>Qty {{$item['qty']}}</span>"   
            <a href='javascript:void(0)' class='add_itm_qty quantity_change' item_id="{{$item['id']}}" >+</a>        
        </td>

        <td class='itemInCartDisplay col-sm-4'>
            {{number_format($item['price'])}} VNĐ
        </td>
        <td class='itemInCartDisplay'>
            <a href="javascript:void(0)" class="remove_item_from_cart" item_id="{{$item['id']}}" >x</a>            
        </td>            
    </tr>
    
@endforeach
    <!-- This part displays Checkout button and price total -->
    <tr>                 
        <td class='itemInCartDisplay' colspan='1'>
            <div>
                <a href="{{route('checkout')}}" title="Thanh toán giỏ hàng"><button type="button" class="btn btn-success">Thanh Toán</button></a>
<!--                        <a class="checkoutButton" href="view_cart.php" CHECKOUT</a>            -->
            </div>
        </td> 
        <td class='itemInCartDisplay' colspan='1'  style="text-align: center;">
            <button type="button" class="btn btn-danger " title="Xóa tất cả sản phẩm trên giỏ hàng" onclick="deleteCart()">Xóa Giỏ Hàng</button>
        </td>               
         <td class='itemInCartDisplay col-sm-5' style='text-align:left;' colspan='3'>
            <div class="cart-products-total">                        
                <h4><b><span>Tổng tiền : <span style='font-size:20px; color:#008cba;'></span>
                    {{number_format($totalPrice)}} VNĐ
                </span></b></h4>
            </div>
        </td>
    </tr>
</table>
@else 
<div>Giỏ hàng đang trống!</div>
@endif
<script type="text/javascript">
    $("a.remove_item_from_cart").click(function() {
        var item_id = $(this).attr("item_id"); // get item id  
        var route = "{{route('remove-to-item','id_sp')}}"; 
            route=route.replace("id_sp",item_id); 
        $.getJSON( route, function(data){ //get Item id
          $("#items_in_shopping_cart").html(data.totalQty); //update Item count in cart-info bar
                // update shopping cart content
          $(".shopping_cart_info").trigger( "click" ); 
          $("#show-cart").load("{{route('show-cart')}}");
        });
    });

    $("a.add_itm_qty").click(function(){
        var item_id = $(this).attr("item_id"); 
        var route = "{{route('rise-to-qty','id_sp')}}"; 
        route=route.replace("id_sp",item_id);
        $.getJSON( route, function(data){ 
            // console.log(data.items[0]['item']);
            for(var i=0;i<data.items.length;i++)
                if (item_id == data.items[i]['id'] ) {
                    if(data.items[i]['inventory'] < 0){
                        $('div.khongdu').show();
                        $('div.khongdu').html("Số lượng hàng chỉ còn 0");
                    }else{
                        $("#items_in_shopping_cart").html(data.totalQty); // get Json 
                    // update specific item quantity on event
                        $(".shopping_cart_info").trigger("click"); 
                        $("#show-cart").load("{{route('show-cart')}}");
                    }
                }
                
        });
    }); 

    /* Change item quantity - SUBTRUCT */
     $("a.subtruct_itm_qty").click( function(){
        var item_id = $(this).attr("item_id"); 
        var route = "{{route('reduce-to-qty','id_sp')}}"; 
        route=route.replace("id_sp",item_id);  
        $.getJSON( route, function(data){ 
            $("#items_in_shopping_cart").html(data.totalQty); // get Json 
            // update specific item quantity on event
            $(".shopping_cart_info").trigger("click"); 
            $("#show-cart").load("{{route('show-cart')}}");
        });
    });
    function deleteCart() {
         var route = "{{route('deleteCart')}}"; 
        $.getJSON( route, function(data){ 
            $("#items_in_shopping_cart").html(0); // get Json 
            // update specific item quantity on event
            $(".shopping_cart_info").trigger("click"); 
            $("#show-cart").load("{{route('show-cart')}}");
        });
     } 
</script>