<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    setcookie('_au_','',time()-(60*60*24),'/');

    header("Location:http://localhost/ecommerce-project/index.php");
    exit;

?>