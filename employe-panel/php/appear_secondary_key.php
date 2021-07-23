<?php
    require_once ("../../common-files/php/database.php");
    $p_key = $_POST['p_key'];
    $get_data = "SELECT * FROM keyword WHERE p_key = '$p_key'";
    $response = $db->query($get_data);
    if($response->num_rows != 0)
    {
        
        $data = $response->fetch_assoc();
        echo $data['s_key'];
        
    }


?>