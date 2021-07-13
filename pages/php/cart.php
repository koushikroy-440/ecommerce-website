<?php
    require_once("../../common-files/php/database.php");
    $id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_pic = $_POST['product_pic'];
    $username = base64_decode($_COOKIE['_au_']);
    $get_data = "SELECT * FROM cart WHERE product_id = '$id' AND username = '$username'";
    $response = $db->query($get_data);
    if($response)
    {
        if($response->num_rows == 0)
        {
            $insert_data = "INSERT INTO cart(product_id,product_title,product_price,product_brand,product_pic,username)
             VALUES('$id','$product_title','$product_price','$product_brand','$product_pic','$username')";
            $response = $db->query($insert_data);
            if($response)
            {
                echo "success";
            }
            else{
                echo"unable to store data in cart table";
            }
        }
        else{
            echo "product already in cart";
        }
    }
    else{
        $create_table = "CREATE TABLE cart(
            id INT(11) NOT NULL AUTO_INCREMENT,
            product_id INT(11),
            product_title VARCHAR(150),
            product_price FLOAT(20),
            product_brand VARCHAR(150),
            product_pic VARCHAR(250),
            username VARCHAR(250),
            PRIMARY KEY (id)
        )";
        $response = $db->query($create_table);
        if($response)
        {
            $insert_data = "INSERT INTO cart(product_id,product_title,product_price,product_brand,product_pic,username)
             VALUES('$id','$product_title','$product_price','$product_brand','$product_pic','$username')";
            $response = $db->query($insert_data);
            if($response)
            {
                echo "success";
            }
            else{
                echo"unable to store data in cart table";
            }
        }
        else{
            echo "unable to create table";
        }
    }

?>