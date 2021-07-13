<?php
    require_once "../../common-files/php/database.php";
    $country_id = $_POST['country_id'];
    $get_data = "SELECT * FROM states WHERE country_id = '$country_id'";
    $response = $db->query($get_data);
    $states = [];
    if($response)
    {
        while($data = $response->fetch_assoc())
        {
            array_push($states, $data);
        }
        echo json_encode($states);
    }

?>