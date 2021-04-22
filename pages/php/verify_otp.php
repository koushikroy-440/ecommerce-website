<?php
    require_once("../../common-files/php/database.php");
    session_start();
    $otp = $_SESSION['otp'];
    $user_otp = $_POST['otp'];
    $email = $_POST['email'];
    if($otp == $user_otp)
    {
        // unset($_SESSION['otp']);
        $update_table = "UPDATE users SET status = 'active' WHERE email = '$email'";
        $response = $db->query($update_table);
        if($response)
        {
            echo  "success";
        }
        else{
            echo "update failed";
        }
    }
    else{
        echo "wrong otp";
    }

?>