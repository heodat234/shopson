
@if(Session::has('cart'))
<table class='table'> <!--Start table that will holds all data in the shopping cart --> 
@foreach($items as $item)
    <tr class='itemInCardRow'>            
        <td class='itemInCartDisplay'>
            <img class='img-responsive item_disp_image' style='width:80px; height: 100px; float:left;' src="images/products/{{$item['item']->image}}">
        </td>

        <td class='itemInCartDisplay'>
            <b>{{$item['item']->name}}</b>
            <br>
            Mã màu: #{{ $item['color'] }} <br> 
            Size: {{ $item['size'] }}           
        </td>

        <td class='itemInCartDisplay'>
            <a href='javascript:void(0)' class='subtruct_itm_qty quantity_change' item_id="{{$item['item']->id}}">-</a>  
                <span class='quantity'>Qty {{$item['qty']}}</span>"   
            <a href='javascript:void(0)' class='add_itm_qty quantity_change' item_id="{{$item['item']->id}}">+</a>        
        </td>

        <td class='itemInCartDisplay'>
            {{$item['price']}} VNĐ
        </td>
        <td class='itemInCartDisplay'>
            <a href="#" class="remove_item_from_cart" item_id="{{$item['item']->id}}">x</a>            
        </td>            
    </tr>
    
@endforeach
    <!-- This part displays Checkout button and price total -->
    <tr>                 
        <td class='itemInCartDisplay' colspan='4'>
            <div>
                <a href="{{route('checkout')}}" title="Review Cart and Check-Out"><button type="button" class="btn checkoutButton">CHECKOUT</button></a>
<!--                        <a class="checkoutButton" href="view_cart.php" CHECKOUT</a>            -->
            </div>
        </td>                
         <td class='itemInCartDisplay' style='text-align:right;'>
            <div class="cart-products-total">                        
                <span>Total : <span style='font-size:20px; color:#008cba;'></span>
                    {{$totalPrice}} VNĐ
                </span>
            </div>
        </td>
    </tr>
</table>
@else 
<div>Giỏ hàng đang trống!</div>
@endif
<script type="text/javascript">
    $("#shopping_cart_output").on('click', 'a.remove_item_from_cart', function() {
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

    $("#shopping_cart_output").on("click", "a.add_itm_qty", function(){
        var item_id = $(this).attr("item_id");   
        var route = "{{route('rise-to-qty','id_sp')}}"; 
        route=route.replace("id_sp",item_id);    
        $.getJSON( route, function(data){ 
            $("#items_in_shopping_cart").html(data.totalQty); // get Json 
            // update specific item quantity on event
            $(".shopping_cart_info").trigger("click"); 
            $("#show-cart").load("{{route('show-cart')}}");
        });
    }); 

    /* Change item quantity - SUBTRUCT */
     $("#shopping_cart_output").on("click", "a.subtruct_itm_qty", function(){
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
</script>