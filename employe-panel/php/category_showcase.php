<?php
require_once("../../common-files/databases/database.php");
$photo;
$image;
if ($_FILES) {
    $photo = $_FILES['photo'];
    $image = addslashes(file_get_contents($photo['tmp_name']));
}

$text = $_POST['text'];
$direction = $_POST['direction'];
$get_data = "SELECT * FROM category_showcase WHERE direction = '$direction' ";
$response = $db->query($get_data);
if ($response) {
    if ($response->num_rows != 0) {
        if ($photo != "") {
            $update_data = "UPDATE category_showcase SET image = '$image', label = '$text' WHERE direction = '$direction'";
            $response = $db->query($update_data);
            if ($response) {
                echo 'success';
            } else {
                echo "unable to update data";
            }
        } else {
            $update_data = "UPDATE category_showcase SET label = '$text' WHERE direction = '$direction'";
            $response = $db->query($update_data);
            if ($response) {
                echo 'success';
            } else {
                echo "unable to update data";
            }
        }
    } else {
        $insert_data = "INSERT INTO category_showcase(image,label,direction) VALUES('$image','$text','$direction')";
        $response = $db->query($insert_data);
        if ($response) {
            echo "success";
        } else {
            echo "unable to insert data in category_showcase table";
        }
    }
} else {
    $create_table = "CREATE TABLE category_showcase(
            id INT(11) NOT NULL AUTO_INCREMENT,
            image MEDIUMBLOB,
            label VARCHAR(50),
            direction VARCHAR(50),
            PRIMARY KEY(id)
        )";
    $response = $db->query($create_table);
    if ($response) {
        $insert_data = "INSERT INTO category_showcase(image,label,direction) VALUES('$image','$text','$direction')";
        $response = $db->query($insert_data);
        if ($response) {
            echo "success";
        } else {
            echo "unable to insert data in category_showcase table";
        }
    } else {
        echo "unable to create table";
    }
}
