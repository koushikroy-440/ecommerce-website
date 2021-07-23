<?php
    $email = $_POST['email'];
    $code = rand(42659,49969);
    $check_mail = mail($email,"verification code","Your verification code is :"+$code);
    // echo $email;
    if($check_mail)
    {
        $data = ["success",trim($code)];
        echo json_encode($data);
    }
    else{
        echo "error";
    }
    
?>