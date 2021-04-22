<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    setcookie('_au_','',time()-(60*60*24),'/');

    header("Location:../../index.php");
    exit;

?>