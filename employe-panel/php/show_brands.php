<?php
    require_once ("../../common-files/php/database.php");
    $cat_name = $_POST["cat_name"];
    $get_data = "SELECT * FROM brands WHERE category_name = '$cat_name'";
    $response = $db->query($get_data);
    if ($response -> num_rows != 0)
    {
        while($data = $response->fetch_assoc()){
            echo "<option>".$data['brands']."</option>";
            // echo $data['brands'];
        }
    }

?>