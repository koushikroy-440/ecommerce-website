<?php
    require_once("../../common-files/databases/database.php");
    $username = base64_decode($_COOKIE['_au_']);
    $old_password = md5($_POST['old-password']);
    $new_password = md5($_POST['new-password']);
    $get_data = "SELECT * FROM users WHERE email = '$username' AND password = '$old_password'";
    $response = $db->query($get_data);
    if($response->num_rows != 0) {
        $update_data = "UPDATE users SET password = '$new_password' WHERE email = '$username'";
        $response = $db->query($update_data);
        if($response)
        {
            echo "password change successfully";
        }
        else{
            echo "please try again some time later";
        }
    }
    else{
        echo "old password is incorrect";
        // $test = base64_decode('e10adc3949ba59abbe56e057f20f883e');
        // echo $test;
    }
?>