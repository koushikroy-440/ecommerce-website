//add to cart
function add_to_cart() {
    $(document).ready(function(){
        $(".cart-btn").each(function(){
            $(this).click(function(){
                var product_id = $(this).attr("product-id");
                var all_cookie = document.cookie.split(";");
                var temp_cookie = [];
                var i;
                for(i=0;i<all_cookie.length;i++){
                    var cookie = all_cookie[i].split("=");
                    if(cookie[0].trim() != "_au_")
                    {
                        temp_cookie[i] = cookie[0].trim();
                    }
                    else{
    
                        temp_cookie = "matched";
                    }
                }
                if(temp_cookie == "matched")
                {
                    var product_id = $(this).attr("product-id");
                    var product_brand = $(this).attr("product-brand");
                    var product_title = $(this).attr("product-title");
                    var product_price = $(this).attr("product-price");
                    var product_pic = $(this).attr("product-pic");
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/ecommerce-project/pages/php/cart.php",
                        data: {
                            product_id: product_id,
                            product_title: product_title,
                            product_brand: product_brand,
                            product_price: product_price,
                            product_pic: product_pic
                        },
                        success: function (response) {
                            if(response.trim() == "success")
                            {
                                if($(".cart-notification").prop("nodeName") != undefined)
                                {
                                   var no = Number($(".cart-notification").html().trim());
                                   no++;
                                   $(".cart-notification").html(no);
                                }
                                else{
                                    var div = document.createElement("div");
                                    div.style.backgroundColor = "red";
                                    div.style.color = "white";
                                    div.style.position = "absolute";
                                    div.style.top = "-10px";
                                    div.style.left = "25px";
                                    div.style.width = "25px";
                                    div.style.height = "25px";
                                    div.style.borderRadius = "50%";
                                    div.style.fontWeight = "bold";
                                    div.style.zIndex = "1000";
                                    var span = document.createElement("span");
                                    span.className = "cart-notification";
                                    span.innerHTML = "1";
                                    $(div).append(span);
                                    $(".cart-link").append(div);
                                }
                            }
                            else{
                                alert(alert);
                            }
                        }
                    });
    
                }
                else{
                    window.location = "signin.php";
                }
            });
        });
    });
}
add_to_cart();

//delete from cart
$(document).ready(function(){
    $(".delete-btn").each(function(){
        $(this).click(function(){
            var id = $(this).attr("product-id");
            var btn = this;
            $.ajax({
                type: "POST",
                url: "../php/delete_cart.php",
                data: {
                    id:id,
                },
                success: function(response){
                    if(response.trim() == "success")
                    {

                        var div = btn.parentElement.parentElement.parentElement;
                        div.remove();
                    }
                }
            });
        });
    });
});

//buy products
function buy_now(){
    $(document).ready(function (){
        $(".buy-btn").each(function () {
            $(this).click(function (){
                var product_id = $(this).attr("product-id");
                window.location = "http://localhost/ecommerce-project/pages/php/buy_product.php?product-id="+product_id;
            });
        });
    });
}

buy_now();

//purchase product
$(document).ready(function (){
    $(".purchase-btn").click(function (){
        var pay_mode = $("input[name = 'pay-mode']:checked").val();
        if(pay_mode)
        {   var id = $(this).attr("product-id");
            var price = $(this).attr("product-price");
            var brand = $(this).attr("product-brand");
            var title = $(this).attr("product-title");
            var qnt = $(".quantity").val();
            if(pay_mode == "online")
            {
                window.location = "../../pay/pay.php?id="+id+"&price="+price+"&brand="+brand+"&title="+title+"&qnt="+qnt;
                // alert();
            }
            else{
                window.location = "../../pay/purchase.php?id="+id+"&price="+price+"&brand="+brand+"&title="+title+"&qnt="+qnt+"&mode=cod";
            }
        }
        else{
            alert("please chose a payment option");
        }
    });
});
//check pinCode
$(document).ready(function(){
    $(".pincode-btn").click(function(){
        var pin = $(".pin-input").val();
        $.ajax({
            type: "POST",
            url: "check_pin.php",
            data: {
                pin: pin
            },
            success: function (response) {
                $(".pincode-message").html(response);
            }
        });
    });
});

//stocks 
$(document).ready(function (){
    $(".quantity").on("input",function () {
        var stocks = $(".stocks").html();
        if($(this).val() > stocks){
            alert("negative stocks");
            $(this).val('1');
        }
    });
});

//preview picture
$(document).ready(function (){
    $(".thumb-pic").each(function () {
        $(this).click(function (){
            var src = $(this).attr("src");
            $(".preview").attr("src",src);
            $(".preview").addClass("animated ZoomIn");

        });
    });
    // alert();
});

//show category
$(document).ready(function (){
    $(".category-btn").each(function (){
        $(this).click(function (){
            var category_name = $(this).attr("category_name");
            var brand_name = $(this).attr("brand_name");
            $.ajax({
                type: "POST",
                url: "filter_product.php",
                data:{
                        cat_name : category_name,
                        brand_name : brand_name
                },
                beforeSend: function () {
                    $(".filter-result").html("processing...");
                },
                success: function (response) {
                    $(".filter-result").html("");
                    var all_data = JSON.parse(response.trim());
                    if(all_data.length == 0) {
                        $(".filter-result").html("<h2><i class='fa fa-shopping-cart'></i>Oops! stock is empty</h2>");
                    }
                    else{
                    var i;
                    for(i=0; i<all_data.length; i++){
                        var div = document.createElement("div");
                        div.className = "text-center border shadow-sm p-3 mb-4";
                        var img = document.createElement("img");
                        img.src = "../../"+all_data[i].thumb_pic;
                        img.width = "250";
                        img.height = "316";
                        //brand
                        var brand_span = document.createElement("span");
                        brand_span.className = "text-uppercase font-weight-bold";
                        brand_span.innerHTML = "<br>"+all_data[i].brands+"<br>";
                        //title
                        var title_span = document.createElement("span");
                        title_span.className = "text-uppercase";
                        title_span.innerHTML = all_data[i].title+"<br>";
                        //price
                        var price_span = document.createElement("span");
                        price_span.className = "text-uppercase";
                        price_span.innerHTML = "<i class='fa fa-rupee'></i>"+all_data[i].price+"<br>";
                        //add to cart
                        var cart_btn = document.createElement("btn");
                        cart_btn.className = "btn btn-success mt-3 mr-3 cart-btn";
                        cart_btn.innerHTML = "ADD TO CART";
                        $(cart_btn).attr("product-title",all_data[i].title);
                        $(cart_btn).attr("product-id",all_data[i].id);
                        $(cart_btn).attr("product-price",all_data[i].price);
                        $(cart_btn).attr("product-pic",all_data[i].pic);
                        $(cart_btn).attr("product-brand",all_data[i].brands);
                        $(cart_btn).on("click",function(){
                            add_to_cart();
                        });
                        //buy btn
                        var buy_btn = document.createElement("btn");
                        buy_btn.className = "btn btn-primary mt-3 mr-3 purchase-btn";
                        buy_btn.innerHTML = "BUY NOW";
                        $(buy_btn).attr("product-title",all_data[i].title);
                        $(buy_btn).attr("product-id",all_data[i].id);
                        $(buy_btn).attr("product-price",all_data[i].price);
                        $(buy_btn).attr("product-pic",all_data[i].pic);
                        $(buy_btn).on("click",function(){
                            buy_now();

                        });

                        $(div).append(img);
                        $(div).append(brand_span);
                        $(div).append(title_span);
                        $(div).append(price_span);
                        $(div).append(cart_btn);
                        $(div).append(buy_btn);
                        $(".filter-result").append(div);
                    }
                        // addto_cart();
                        // buy_now();
                }
                }

            });
        });
    });
});