<?php
    require_once("../../common-files/php/database.php");
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin-code'];

    $check_table = "SELECT * FROM users";
    $response = $db->query($check_table);
    if($response)
    {
        $store_data = "INSERT INTO users(firstname,lastname,email,mobile,password,address,state,pincode,country)VALUES(
            '$first_name','$last_name','$email','$mobile','$password','$address','$state','$pin_code','$country'
        )";
        $response = $db->query($store_data);
        if($response)
        {
            require("sendsms.php");
        }
        else{
            echo "unable to store data in users table";
        }
    }
    else{
        $create_table = "CREATE TABLE users(
            id INT(11) NOT NULL AUTO_INCREMENT,
            firstname VARCHAR(50),
            lastname VARCHAR(50),
            email VARCHAR(50),
            mobile VARCHAR(50),
            password VARCHAR(50),
            address VARCHAR(250),
            state VARCHAR(50),
            pincode INT(11),
            country VARCHAR(150),
            status VARCHAR(20) DEFAULT 'pendings',
            reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id) 

        )"; 
        $response = $db->query($create_table);
        if($response)
        {
            $store_data = "INSERT INTO users(firstname,lastname,email,mobile,password,address,state,pincode,country)VALUES(
                '$first_name','$last_name','$email','$mobile','$password','$address','$state','$pin_code','$country'
            )";
            $response = $db->query($store_data);
            if($response)
            {
                require("sendsms.php");
            }
            else{
                echo "unable to store data in users table";
            }
        }
        else{
            echo "unable to create table";
        }
    }
