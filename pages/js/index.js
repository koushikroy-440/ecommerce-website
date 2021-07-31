//add to cart
function add_to_cart() {
    $(document).ready(function () {
        $(".cart-btn").each(function () {
            $(this).click(function () {
                var product_id = $(this).attr("product-id");
                var all_cookie = document.cookie.split(";");
                var temp_cookie = [];
                var i;
                for (i = 0; i < all_cookie.length; i++) {
                    var cookie = all_cookie[i].split("=");
                    if (cookie[0].trim() != "_au_") {
                        temp_cookie[i] = cookie[0].trim();
                    }
                    else {

                        temp_cookie = "matched";
                    }
                }
                if (temp_cookie == "matched") {
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

                            if (response.trim() == "success") {
                                if ($(".cart-notification").prop("nodeName") != undefined) {
                                    var no = Number($(".cart-notification").html().trim());
                                    no++;
                                    $(".cart-notification").html(no);
                                }
                                else {
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
                            else {
                                alert(response);
                            }
                        }
                    });

                }
                else {
                    window.location = "signin.php";
                }
            });
        });
    });
}
add_to_cart();

//delete from cart
$(document).ready(function () {
    $(".delete-btn").each(function () {
        $(this).click(function () {
            var id = $(this).attr("product-id");
            var btn = this;
            $.ajax({
                type: "POST",
                url: "../php/delete_cart.php",
                data: {
                    id: id,
                },
                success: function (response) {
                    if (response.trim() == "success") {

                        var div = btn.parentElement.parentElement.parentElement;
                        div.remove();
                    }
                }
            });
        });
    });
});

//buy products
function buy_now() {
    $(document).ready(function () {
        $(".buy-btn").each(function () {
            $(this).click(function () {
                var product_id = $(this).attr("product-id");
                window.location = "http://localhost/ecommerce-project/pages/php/buy_product.php?product-id=" + product_id;
            });
        });
    });
}


buy_now();

//purchase product

    $(document).ready(function () {
        $(".purchase-btn").click(function () {
            var pay_mode = $("input[name = 'pay-mode']:checked").val();
            if (pay_mode) {
                var id = $(this).attr("product-id");
                var price = $(this).attr("product-price");
                var brand = $(this).attr("product-brand");
                var title = $(this).attr("product-title");
                var qnt = $(".quantity").val();
                if (pay_mode == "online") {
                    window.location = "../../pay/pay.php?id=" + id + "&price=" + price + "&brand=" + brand + "&title=" + title + "&qnt=" + qnt;
                    // alert();
                }
                else {
                    window.location = "../../pay/purchase.php?id=" + id + "&price=" + price + "&brand=" + brand + "&title=" + title + "&quantity=" + qnt + "&mode=cod";
                }
                // alert();
            }
            else {
                alert("please chose a payment option");
            }
        });
    });


//check pinCode
$(document).ready(function () {
    $(".pincode-btn").click(function () {
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
$(document).ready(function () {
    $(".quantity").on("input", function () {
        var stocks = $(".stocks").html();
        if ($(this).val() > stocks) {
            alert("negative stocks");
            $(this).val('1');
        }
    });
});

//preview picture
$(document).ready(function () {
    $(".thumb-pic").each(function () {
        $(this).click(function () {
            var src = $(this).attr("src");
            $(".preview").attr("src", src);
            $(".preview").addClass("animated ZoomIn");

        });
    });
    // alert();
});

//show category
$(document).ready(function () {
    $(".category-btn").each(function () {
        $(this).click(function () {
            $(".category-btn").each(function () {
                $(this).removeClass("btn-primary px-2 rounded-sm");
            });
            $(this).addClass("btn-primary px-2 rounded-sm");
            var category_name = $(this).attr("category_name");
            var brand_name = $(this).attr("brand_name");
            $.ajax({
                type: "POST",
                url: "filter_product.php",
                data: {
                    cat_name: category_name,
                    brand_name: brand_name
                },
                beforeSend: function () {
                    $(".filter-result").html("processing...");
                },
                success: function (response) {
                    $(".filter-result").html("");
                    var all_data = JSON.parse(response.trim());
                    // console.log(all_data);
                    if (all_data.length == 0) {
                        $(".filter-result").html("<h2><i class='fa fa-shopping-cart'></i>Oops! stock is empty</h2>");
                    }
                    else {
                        var i;
                        for (i = 0; i < all_data.length; i++) {
                            var div = document.createElement("div");
                            div.className = "text-center border shadow-sm p-3 mb-4";
                            var img = document.createElement("img");
                            img.src = "../../" + all_data[i].thumb_pic;
                            img.width = "250";
                            img.height = "316";
                            //brand
                            var brand_span = document.createElement("span");
                            brand_span.className = "text-uppercase font-weight-bold";
                            brand_span.innerHTML = "<br>" + all_data[i].brands + "<br>";
                            //title
                            var title_span = document.createElement("span");
                            title_span.className = "text-uppercase";
                            title_span.innerHTML = all_data[i].title + "<br>";
                            //price
                            var price_span = document.createElement("span");
                            price_span.className = "text-uppercase";
                            price_span.innerHTML = "<i class='fa fa-rupee'></i>" + all_data[i].price + "<br>";
                            //add to cart
                            var cart_btn = document.createElement("btn");
                            cart_btn.className = "btn btn-success mt-3 mr-3 cart-btn";
                            cart_btn.innerHTML = "ADD TO CART";
                            $(cart_btn).attr("product-title", all_data[i].title);
                            $(cart_btn).attr("product-id", all_data[i].id);
                            $(cart_btn).attr("product-price", all_data[i].price);
                            $(cart_btn).attr("product-pic", all_data[i].thumb_pic);
                            $(cart_btn).attr("product-brand", all_data[i].brands);
                            $(cart_btn).click(function () {
                                add_to_cart();
                            });
                            //buy btn
                            var buy_btn = document.createElement("btn");
                            buy_btn.className = "btn btn-primary mt-3 mr-3 purchase-btn ";
                            buy_btn.innerHTML = "BUY NOW";
                            $(buy_btn).attr("product-title", all_data[i].title);
                            $(buy_btn).attr("product-id", all_data[i].id);
                            $(buy_btn).attr("product-price", all_data[i].price);
                            $(buy_btn).attr("product-pic", all_data[i].thumb_pic);
                            $(buy_btn).attr("product-brand", all_data[i].brands);
                            $(buy_btn).on("click", function () {
                                
                                purchase();
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
//purchase now
function purchase(){
    $(document).ready(function () {
        $(".purchase-btn").each(function () {
            $(this).click(function () {
                var product_id = $(this).attr("product-id");
                window.location = "http://localhost/ecommerce-project/pages/php/buy_product.php?product-id=" + product_id;
            });
        });
    });
}
//default btn
$(document).ready(function () {
    var category_btn = $(".category-btn");
    // category_btn[0].click();
});

//filter by price
$(document).ready(function () {
    $(".price-filter-btn").click(function () {
        var cat_name = $(this).attr("cat-name");
        var min = $(".min-price").val();
        var max = $(".max-price").val();
        $.ajax({
            type: "POST",
            url: "filter_by_price.php",
            data: {
                min: min,
                max: max,
                cat_name: cat_name
            },
            beforeSend: function () {
                $(".filter-result").html("processing.....");
            },
            success: function (response) {
                $(".filter-result").html("");
                var all_data = JSON.parse(response.trim());
                // console.log(all_data);
                if (all_data.length == 0) {
                    $(".filter-result").html("<h2><i class='fa fa-shopping-cart'></i>Oops! stock is empty</h2>");
                }
                else {
                    var i;
                    for (i = 0; i < all_data.length; i++) {
                        var div = document.createElement("div");
                        div.className = "text-center border shadow-sm p-3 mb-4";
                        var img = document.createElement("img");
                        img.src = "../../" + all_data[i].thumb_pic;
                        img.width = "250";
                        img.height = "316";
                        //brand
                        var brand_span = document.createElement("span");
                        brand_span.className = "text-uppercase font-weight-bold";
                        brand_span.innerHTML = "<br>" + all_data[i].brands + "<br>";
                        //title
                        var title_span = document.createElement("span");
                        title_span.className = "text-uppercase";
                        title_span.innerHTML = all_data[i].title + "<br>";
                        //price
                        var price_span = document.createElement("span");
                        price_span.className = "text-uppercase";
                        price_span.innerHTML = "<i class='fa fa-rupee'></i>" + all_data[i].price + "<br>";
                        //add to cart
                        var cart_btn = document.createElement("btn");
                        cart_btn.className = "btn btn-success mt-3 mr-3 cart-btn";
                        cart_btn.innerHTML = "ADD TO CART";
                        $(cart_btn).attr("product-title", all_data[i].title);
                        $(cart_btn).attr("product-id", all_data[i].id);
                        $(cart_btn).attr("product-price", all_data[i].price);
                        $(cart_btn).attr("product-pic", all_data[i].thumb_pic);
                        $(cart_btn).attr("product-brand", all_data[i].brands);
                        $(cart_btn).click(function () {
                            add_to_cart();
                        });
                        //buy btn
                        var buy_btn = document.createElement("btn");
                        buy_btn.className = "btn btn-primary mt-3 mr-3 purchase-btn buy-btn";
                        buy_btn.innerHTML = "BUY NOW";
                        $(buy_btn).attr("product-title", all_data[i].title);
                        $(buy_btn).attr("product-id", all_data[i].id);
                        $(buy_btn).attr("product-price", all_data[i].price);
                        $(buy_btn).attr("product-pic", all_data[i].thumb_pic);
                        $(buy_btn).attr("product-brand", all_data[i].brands);
                        $(buy_btn).on("click", function () {
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

//personal edit
$(document).ready(function () {
    $(".personal-form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "personal_information.php",
            data: new FormData(this),
            contentType: false,
            processData: false,
            catch: false,
            beforeSend: function () {
                $(".personal-form button").html("please wait...");
                // console.log(new FormData(this));
            },
            success: function (response) {
                $(".personal-form button").html("UPDATE");
                alert(response);
            }
        });
    });
});
//change Password
$(document).ready(function () {
    $(".privacy-form").on("submit", function (event) {
        event.preventDefault();
        var password = $("#new-password").val();
        var re_password = $("#re-password").val();
        if (password == re_password) {
            $.ajax({
                type: "POST",
                url: "change_password.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                catch: false,
                beforeSend: function () {
                    $(".change_password_btn").html("please wait...");
                },
                success: function (response) {
                    $(".change_password_btn").html("CHANGE PASSWORD");
                    if (response.trim() == "password change successfully") {
                        alert(response);
                        $("..privacy-form").trigger("reset");
                    }
                    else {
                        alert(response);
                    }
                }
            });
        }
        else {
            alert("password and re-password must be same")
        }
    });
});

//star rating
$(document).ready(function () {
    $(".star").each(function () {
        $(this).click(function () {
            $(".star-btn").removeClass("d-none");
            var i;
            var star = $(".star");
            var index = $(this).attr("index");
            index++;
            for (i = 0; i < 5; i++) {
                $(star[i]).removeClass("fa-star text-warning");
                $(star[i]).addClass("fa fa-star-o text-warning");
                if (i < index) {
                    $(star[i]).removeClass("fa fa-star-o");
                    $(star[i]).addClass("fa fa-star text-warning");
                    // alert();
                }
            }

            $(".star-btn").click(function () {
                var product_id = $(this).attr("product-id");
                if ($("#comment").val() != "") {
                    if ($("#picture").val() != "") {
                        var picture = document.querySelector("#picture").files[0];
                        var form = new FormData();
                        form.append("photo", picture);
                        form.append("comment", $("#comment").val());
                        form.append("product_id", product_id);
                        form.append("rating", index);

                        $.ajax({
                            type: "POST",
                            url: "star.php",
                            data: form,
                            contentType: false,
                            processData: false,
                            catch: false,
                            success: function (response) {
                                if (response.trim() == "success") {
                                    $(".star-btn").addClass("d-none");
                                    $(".comment-info").html("comment post");
                                    $(".comment-info").addClass("text-success");
                                    $(".comment-box").addClass("d-none");
                                    $(".picture-box").addClass("d-none");
                                    $(".comment-header").html("your rating");
                                    setTimeout(function () {
                                        $(".comment-info").html($("#comment").val());
                                        $("comment-info").removeClass("text-success");
                                    }, 2000);

                                }
                            }
                        });
                    }
                    else {
                        alert("please upload a picture");
                    }
                }
                else {
                    alert("comment box is empty");
                }

            });

        });
    });
});

//sort by
$(document).ready(function () {
    $(".sort-by").on("change", function () {
        var brand = "";
        var category = "";
        $(".category-btn").each(function () {

            if ($(this).attr("class").indexOf("btn-primary") != -1) {
                brand = $(this).attr("brand_name");
                category = $(this).attr("category_name");
            }
        });
        var sort_by = $(this).val();
        $.ajax({
            type: "POST",
            url: "sort_product.php",
            data: {
                brand: brand,
                category: category,
                sort_by: sort_by
            },
            beforeSend: function () {
                $(".filter-result").html("processing.....");
            },
            success: function (response) {
                $(".filter-result").html("");
                var all_data = JSON.parse(response.trim());
                // console.log(all_data);
                if (all_data.length == 0) {
                    $(".filter-result").html("<h2><i class='fa fa-shopping-cart'></i>Oops! stock is empty</h2>");
                }
                else {
                    var i;
                    for (i = 0; i < all_data.length; i++) {
                        var div = document.createElement("div");
                        div.className = "text-center border shadow-sm p-3 mb-4";
                        var img = document.createElement("img");
                        img.src = "../../" + all_data[i].thumb_pic;
                        img.width = "250";
                        img.height = "316";
                        //brand
                        var brand_span = document.createElement("span");
                        brand_span.className = "text-uppercase font-weight-bold";
                        brand_span.innerHTML = "<br>" + all_data[i].brands + "<br>";
                        //title
                        var title_span = document.createElement("span");
                        title_span.className = "text-uppercase";
                        title_span.innerHTML = all_data[i].title + "<br>";
                        //price
                        var price_span = document.createElement("span");
                        price_span.className = "text-uppercase";
                        price_span.innerHTML = "<i class='fa fa-rupee'></i>" + all_data[i].price + "<br>";
                        //add to cart
                        var cart_btn = document.createElement("btn");
                        cart_btn.className = "btn btn-success mt-3 mr-3 cart-btn";
                        cart_btn.innerHTML = "ADD TO CART";
                        $(cart_btn).attr("product-title", all_data[i].title);
                        $(cart_btn).attr("product-id", all_data[i].id);
                        $(cart_btn).attr("product-price", all_data[i].price);
                        $(cart_btn).attr("product-pic", all_data[i].thumb_pic);
                        $(cart_btn).attr("product-brand", all_data[i].brands);
                        $(cart_btn).click(function () {
                            add_to_cart();
                        });
                        //buy btn
                        var buy_btn = document.createElement("btn");
                        buy_btn.className = "btn btn-primary mt-3 mr-3 purchase-btn buy-btn";
                        buy_btn.innerHTML = "BUY NOW";
                        $(buy_btn).attr("product-title", all_data[i].title);
                        $(buy_btn).attr("product-id", all_data[i].id);
                        $(buy_btn).attr("product-price", all_data[i].price);
                        $(buy_btn).attr("product-pic", all_data[i].thumb_pic);
                        $(buy_btn).attr("product-brand", all_data[i].brands);
                        $(buy_btn).on("click", function () {
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

//subscribe email
$(document).ready(function () {
    $(".subscribe-btn").click(function (e) {
        e.preventDefault();
        var email = $(".subscribe-email").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/ecommerce-project/pages/php/subscribe_verify.php",
            data: {
                email: email
            },
            success: function (response) {
                if (response.trim() != "error") {
                    var count = 3;
                    function verification() {
                        var data = JSON.parse(response.trim());
                        var code = data[1];
                        var prompt = window.prompt("please visit your mail and enter your code");
                        if (prompt == code) {
                            $.ajax({
                                type: "POST",
                                url: "http://localhost/ecommerce-project/pages/php/subscribed_user.php",
                                data: {
                                    email: email,
                                },
                                success: function (response) {
                                    alert(response);
                                }
                            });
                        }
                        else if (prompt == null || prompt == "") {
                            verification();
                        }
                        else {
                            alert("wrong code");
                            if (--count > 0) {
                                verification();
                            }

                        }
                    }
                    verification();
                }
                else {
                    alert(response);
                }
                //    alert(response);
            }
        });
    });
});

//ajax live search
$(document).ready(function () {
    $(".search").on("input", function () {
        var keyword = $(this).val();
        $.ajax({
            type: "POST",
            url: "http://localhost/ecommerce-project/pages/php/live_search.php",
            data: {
                keyword: keyword
            },
            success: function (response) {
                $(".search-hint").html(response);
                $(".search-tag").on("mouseover", function () {
                    $(this).css({
                        backgroundColor: '#77AFE0',
                        color: 'white',
                        cursor: 'pointer'
                    });
                });
                $(".search-tag").on("mouseout", function () {
                    $(this).css({
                        backgroundColor: 'inherit',
                        color: 'black'
                    });
                });
                $(".search-tag").each(function () {
                    $(this).click(function () {
                        var product_id = $(this).attr("product-id");
                        $(".search").val($(this).html());
                        $(".search-hint").html('');
                        window.location = "http://localhost/ecommerce-project/pages/php/buy_product.php?product-id=" + product_id;
                    });
                });
            }
        });
    });
});

//search
$(document).ready(function () {
    $(".search").on("keypress", function (e) {
        if (e.keyCode == 13 && $(this).val() != "") {
            var key_word = $(this).val().trim();
            window.location = "http://localhost/ecommerce-project/pages/php/search_result.php?search=" + key_word;
        }
    });
});

$(document).ready(function () {
    $(".search-icon").on("click", function (e) {
        if ($(".search").val() != "") {
            var key_word = $(".search").val().trim();
            window.location = "http://localhost/ecommerce-project/pages/php/search_result.php?search=" + key_word;
        }
        else {
            alert("please enter something in search box");
        }
    });
});