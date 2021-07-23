<?php
    require_once("../../common-files/databases/database.php");
    $email = $_POST['email'];
    $date = date("Y-m-d");
    $store_data = "SELECT * FROM subscribe ";
    $response = $db->query($store_data);
    if($response)
    {
            $insert_data = "INSERT INTO subscribe (email, subscribe_date) VALUES ('$email','$date')";
            $response = $db->query($insert_data);
            if($response)
            {
                echo "success";
            }
            else{
                echo "unable to subscribe please try again later";
            }
    }
    else{
        $create_table = "CREATE TABLE subscribe(
            id INT(11) NOT NULL AUTO_INCREMENT,
            email VARCHAR(200),
            subscribe_date DATE,
            PRIMARY key(id)
        )";
        $response = $db->query($create_table);
        if($response)
        {
            $insert_data = "INSERT INTO subscribe (email, subscribe_date) VALUES ('$email','$date')";
            $response = $db->query($insert_data);
            if($response)
            {
                echo "success";
            }
            else{
                echo "unable to subscribe please try again later";
            }
        }
        else{
            echo "unable to subscribe please try again later";
        }
    }
?>