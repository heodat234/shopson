{{-- <script type="text/javascript">
	 

    
    /* Action on add submit */
    
    
    /* Display shopping cart content when clicking on shopping_cart_info bar */
  // $(".shopping_cart_info").click(function(e) {
  //   e.preventDefault();         
  //   $(".shopping_cart_holder").fadeIn(); // how to cart displays - you can change to any event you wish.
  //       /* Ajax call for shoppingCartData.php if $_POST['load_cart_items'] */
  //   $("#shopping_cart_output" ).load( "");
  // }); 
    
  // /* Close Cart by clicking 'close' button */
  // $( ".close_shopping_cart_holder").click(function(e){
  //   e.preventDefault(); 
  //   $(".shopping_cart_holder").fadeOut(500); // close cart of fadeOut ... or any event you wish 
  // });
    
  //Remove items from cart
  $("#shopping_cart_output").on('click', 'a.remove_item_from_cart', function(e) {
    e.preventDefault(); 
    var item_id = $(this).attr("item_id"); // get item id    
    var route = "{{route('remove-to-item','id_sp')}}"; 
        route=route.replace("id_sp",item_id);        
        /* This part make sure tha the removed item disappears from shopping cart and is being removed */
        /* json gets the item_id */
    $.getJSON( route, function(data){ //get Item id
      $("#items_in_shopping_cart").html(data.totalQty); //update Item count in cart-info bar
            // update shopping cart content
      $(".shopping_cart_info").trigger( "click" ); 
      $("#show-cart").load("{{route('show-cart')}}");
    });
  });  

    /* Change item quantity - ADD */
    $("#shopping_cart_output").on("click", "a.add_itm_qty", function(e){
        e.preventDefault(); 
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
     $("#shopping_cart_output").on("click", "a.subtruct_itm_qty", function(e){
 
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
        
    /* Display image on click */
    $(".item_disp_image").click(function(e){
        e.preventDefault(); 
        var item_id = $(this).attr("item_id");
        $.post('displayItem.php',{item_id: item_id}, function(data) { // send post data to displayItem.php
            var item_display_id = $(".item_display_holder").html(data); // update the data in .item_displa_holder
        });
    }); 
    /* Close image on click */
    $(".item_display_holder").on("click",".close_image", function(e){
        e.preventDefault();
        $("#item_display").hide();
    });    
    
    /* Show image title on item hover */
    $('.item_disp_img_holder').hover( function() {
        $(this).find('.item_disp_title').css("display","block","width","inherit");
    }, function() {
        $(this).find('.item_disp_title').fadeOut(200);
    });
     
    $("#show-cart").load("{{route('show-cart')}}");   
    /*   ADDITIONAL OPTIONS YOU COULD USE    */
        
    /* Close Cart when mouse leaves shopping_cart_holder area - ADDITIONAL OPTION */
//  $( ".shopping_cart_holder").on("mouseleave",function(e){ // how to cart closes - you can change to any event you wish.
//    e.preventDefault();            
//    $(".shopping_cart_holder").fadeOut();
//  });    
    
    // Enlarge image on hoover 
//    $('.item_disp_image').hover(function() {
//    $(this).css("cursor", "pointer");  // Shows a pointer type
//    $(this).animate({
//        width: "100%",
//        height: "100%"
//    }, 'fast');

    // Go back to default image size
//    }, function() {
//        $(this).animate({
//            width: "80%"
//        }, 'fast');
//    });

</script> --}}