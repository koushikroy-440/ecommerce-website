<?php
require "../../common-files/php/database.php";
$category = $_POST["category"];
$json_data = json_decode($_POST["json_data"]);
$length = count($json_data);
$message = "";
$select_brands_table = "SELECT * FROM brands";
$response = $db->query($select_brands_table);
if ($response) {
    for ($i = 0; $i < $length; $i++) {
        $store_data = "INSERT INTO brands(category_name,brands)
            VALUES('$category','$json_data[$i]');
            ";
        if ($db->query($store_data)) {
            if (mkdir("../../stocks/" . $category . "/" . $json_data[$i])) {
                $message = "done";
            }
        } else {
            $message = "unable to store data in brands";
        }
    }
    echo $message;
} else {
    $create_table = "CREATE TABLE brands(
        id INT(11) NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(50),
        brands varchar(50),
        PRIMARY KEY(id)
    )";
    $response = $db->query($create_table);
    if ($response) {
        for ($i = 0; $i < $length; $i++) {
            $store_data = "INSERT INTO brands(category_name,brands)
            VALUES('$category','$json_data[$i]');
            ";
            if ($db->query($store_data)) {
                if (mkdir("../../stocks/" . $category . "/" . $json_data[$i])) {
                    $message = "done";
                }
            } else {
                $message = "unable to store data in brands";
            }
        }
        echo $message;
    } else {
        echo "unable to create brand table";
    }
}
