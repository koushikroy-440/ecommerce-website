<?php
    require_once("../../common-files/php/database.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $get_data = "SELECT * FROM users WHERE  email = '$email' ";
    $response = $db->query($get_data);
    if($response)
    {
        if($response->num_rows() != 0){
            $data = $response->fetch_assoc();
            $status = $data['status'];
            if($status == "pendings")
            {
                $mobile = $data['mobile'];
                require("sendsms.php");
            }
            else{
                echo "active";
            }
        }

        else{
            echo "user not found";
        }
    }
    else{
        echo "can't find table";
    }

?>