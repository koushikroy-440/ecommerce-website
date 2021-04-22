<?php
    require_once("../../common-files/php/database.php");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $get_data = "SELECT * FROM users WHERE  email = '$email' ";
    $response = $db->query($get_data);
    if($response)
    {
        if($response->num_rows > 0){
            $data = $response->fetch_assoc();
            $status = $data['status'];
            $real_username = $data['email'];
            $real_password = $data['password'];
            if($status == "pending")
            {
                $mobile = $data['mobile'];
                require("sendsms.php");
            }
            else{
                if($real_username == $email && $real_password == $password)
                {
                        session_start();
                        $_SESSION['username'] = $email;
                        echo "login success";
                }
                else{
                    echo "<b>incorrect password</b>"
                }
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