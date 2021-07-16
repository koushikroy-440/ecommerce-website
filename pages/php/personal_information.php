<?php
    require_once("../../common-files/databases/database.php");
    $username = base64_decode($_COOKIE['_au_']);
    $first_name = $_POST['firstname'];
    $last_name = $_POST['Lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $state = $_POST['state'];
    $pincode = $_POST['pin-code'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $update_data = "UPDATE users SET firstname = '$first_name',lastname='$last_name',email = '$email',mobile = '$mobile',state = '$state',pincode = '$pincode',country = '$country',address = '$address' WHERE email = '$username' ";
    $response = $db->query($update_data);
    if($response)
    {
        echo "success";
    }
    else{
        echo "error";
    }

?>