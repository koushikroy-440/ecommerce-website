<?php
    require_once "../../common-files/php/database.php";
    $state_id = $_POST['state_id'];
    $get_data = "SELECT * FROM cities WHERE state_id = '$state_id'";
    $response = $db->query($get_data);
    $cities = [];
    if($response){
        while($data = $response->fetch_assoc())
        {
            array_push($cities, $data);
        }
        echo json_encode($cities);
    }

?>