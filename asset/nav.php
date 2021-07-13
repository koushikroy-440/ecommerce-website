<?php
    session_start();
    $count_cart = "";
    $branding_data = "";
    $get_branding_data = "SELECT *  FROM branding";
    $branding_response = $db->query($get_branding_data);
    if($branding_response)
    {
        $branding_data = $branding_response->fetch_assoc();
    }
    $menu = '';
    $email = '';
    if(!empty($_COOKIE['_au_']))
    {
        $email = base64_decode($_COOKIE['_au_']);
    }
    $name = '';
    if(empty($_COOKIE['_au_']))
    {
        $menu = '<a href="signup.php" class="dropdown-item"><i class="fa fa-user"></i>Sign Up</a>
        <a href="signin.php" class="dropdown-item"><i class="fa fa-sign-in"></i>Sign in</a>';
    }
    else{
        $get_data = "SELECT * FROM users WHERE email = '$email' ";
        $response = $db->query($get_data);
        if($response)
        {
            $data = $response->fetch_assoc();
            $name = $data['firstname']." ".$data['lastname'];
            $_SESSION['name'] = $name;
            $_SESSION['mobile'] = $data['mobile'];
            $_SESSION['pincode'] = $data['pincode'];

        }
        $menu = '<a href="profile.php" class="dropdown-item">'.$name.'</a>
        <a href="pages/php/sign_out.php" class="dropdown-item"><i class="fa fa-sign-out"></i>Sign Out</a>'
        ;
        $get_cart = "SELECT count(id) AS result FROM cart WHERE username =  '$email' ";
        $response = $db->query($get_cart);
        if($response->num_rows != 0)
        {
            $data = $response->fetch_assoc();
            if($data['result'] != 0)
            {
                $count_cart = '<div  style="position: absolute; width: 25px;height: 25px; background-color: red;color: white; font-weight: bold; border-radius: 50%;z-index: 100;left: 25px;top: -10px;">
                <span class="cart-notification">'.
                    $data["result"]
                    .'
                </span>
                </div>';
            }
        }
    }
?>


<div class="container-fluid bg-white fixed-top w-100 shadow-sm">
<nav class="container navbar  navbar-expand-sm bg-white w-100 ">
            <a href="#" class="text-capitalize navbar-brand">
                <?php
                $logo_string = base64_encode($branding_data['brand_logo']);
                $complete_string = "data:image/png;base64".$logo_string;
                echo "<image src='".$complete_string."' width='20'>";
                echo "&nbsp";
                    echo $branding_data['brand_name'];
                ?>
            </a>
        <div class="collapse navbar-collapse" id="menu-box">
        <ul class="navbar-nav">
            <?php
                $data = "SELECT category_name from category";
                $response = $db->query($data);
                if($response)
                {
                   while($nav = $response->fetch_assoc())
                   {
                       echo "<li class='nav-item'><a href='http://localhost/ecommerce-project/pages/php/products.php?cat_name=".$nav['category_name']."' class='nav-link text-dark text-uppercase'>".$nav['category_name']."</a></li>";
                   }
                }

            ?>
        </ul>
        </div>
        <div class="btn-group ml-auto">
            <button class="btn border navbar-toggler"  data-toggle="collapse" data-target="#menu-box"><i class="fa fa-bars"></i></button>
            <button class="btn border"><a href="http://localhost/ecommerce-project/pages/php/cart_design.php" class="cart-link">
                <i class="fa fa-shopping-bag"></i>
                <?php
                    echo $count_cart;
                ?>
                </a>
            </button>
            <button class="btn border"><i class="fa fa-search"></i></button>
            <button class="btn border dropdown">
            <i class="fa fa-user dropdown-toggle" data-toggle="dropdown"></i>
            <div class="dropdown-menu">
                <?php
                    echo $menu;
                ?>
            </div>
            </button>
        </div> 
</nav>
</div>