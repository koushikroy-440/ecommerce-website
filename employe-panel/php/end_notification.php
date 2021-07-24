<?php
    require_once "../../common-files/php/database.php";
    $get_data = "SELECT * FROM products ORDER BY id DESC LIMIT 1";
    $message = "";
    $response = $db->query($get_data);
    if($response)
    {
        $data = $response->fetch_assoc();
        $latest_product_id = $data['id'];
        $latest_product_title = $data['title'];
        $latest_product_description = $data['description'];
        $latest_product_price = $data['price'];
        $latest_product_brands = $data['brands'];
        $latest_product_thumb_pic = $data['thumb_pic'];

        //send notifications
        $send = "SELECT * FROM subscribe";
        $response = $db->query($send);
        if($response)
        {
            while($data = $response->fetch_assoc())
            {
                $check = mail($data['email'],"new product arrived",$latest_product_title);
                if($check){
                    $message = "success";
                }
                else{
                    $message = "unable to send notifications";
                }
                
            }
        }
    }
