<?php
    session_start();
    $branding_data = "";
    $get_branding_data = "SELECT *  FROM branding";
    $branding_response = $db->query($get_branding_data);
    if($branding_response)
    {
        $branding_data = $branding_response->fetch_assoc();
    }
    $menu = '';
    $email = base64_decode($_COOKIE['_au_']);
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

        }
        $menu = '<a href="profile.php" class="dropdown-item">'.$name.'</a>
        <a href="pages/php/sign_out.php" class="dropdown-item"><i class="fa fa-sign-out"></i>Sign Out</a>'
        ;
    }
?>


<div class="container-fluid bg-white shadow-sm">
<nav class="container navbar navbar-expand-sm bg-white">
            <a href="#" class="text-capitalize navbar-brand">
                <?php
                $logo_string = base64_encode($branding_data['brand_logo']);
                $complete_string = "data:image/png;base64".$logo_string;
                echo "<image src='".$complete_string."' width='40'>";
                    echo $branding_data['brand_name'];
                ?>
            </a>
        <ul class="navbar-nav">
            <?php
                $data = "SELECT category_name from category";
                $response = $db->query($data);
                if($response)
                {
                   while($nav = $response->fetch_assoc())
                   {
                       echo "<li class='nav-item'><a href='#' class='nav-link text-dark text-uppercase'>".$nav['category_name']."</a></li>";
                   }
                }

            ?>
        </ul>
        <div class="btn-group ml-auto">
            <button class="btn border"><i class="fa fa-shopping-bag"></i></button>
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