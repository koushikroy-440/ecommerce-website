<?php
    require_once "../../common-files/php/database.php";
    $country = $_POST['country'];   
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $delivery_time = $_POST['delivery_time'];
    $payment_mode = $_POST['payment-mode'];
    $get_data = "SELECT * FROM delivery_area";
    $response = $db->query($get_data);
    if($response){
        $insert_data = "INSERT INTO delivery_area(country, state, city, pincode, delivery_time,payment_mode) VALUES(
            '$country','$state','$city','$pin_code','$delivery_time','$payment_mode'
        )";
        $response = $db->query($insert_data);
        if($response)
        {
            echo "success";
        }
        else{
            echo "unable to get area";
        }
    }
    else{
        $create_table = "CREATE TABLE delivery_area(
            id INT(11) NOT NULL AUTO_INCREMENT,
            country VARCHAR(100),
            state VARCHAR(100),
            city VARCHAR(100),
            pincode INT(10),
            delivery_time VARCHAR(225),
            payment_mode VARCHAR(20),
            PRIMARY KEY (id)
        )";
        $response = $db->query($create_table);
        if($response){
            $insert_data = "INSERT INTO delivery_area(country, state, city, pincode, delivery_time,payment_mode) VALUES(
                '$country','$state','$city','$pincode','$delivery_time','$payment_mode'
            )";
            $response = $db->query($insert_data);
            if($response)
            {
                echo "success";
            }
            else{
                echo "unable to get area";
            }
        }
        else{
            echo "unable to create table";
        }
    }

?>