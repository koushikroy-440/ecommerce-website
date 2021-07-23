<?php
    require_once "../../common-files/php/database.php";
    $p_key = $_POST['p-keyword'];
    $s_key = $_POST['s-keyword'];
    $get_data = "SELECT * FROM keyword WHERE p_key = '$p_key'";
    $response = $db->query($get_data);
    if($response)
    {
        if($response->num_rows != 0)
        {
            $update_data = "UPDATE keyword SET s_key = '$s_key' WHERE p_key = '$p_key'";
            $response = $db->query($update_data);
            if($response){
                echo "success";
            }
            else{
                echo "update failed";
            }
        }
        else{
            $insert_data = "INSERT INTO keyword(p_key, s_key) VALUES('$p_key', '$s_key')";
            $response = $db->query($insert_data);
            if($response){
                echo "success";
            }
            else{
                echo "unable to store keyword";
            }
        }
    }
    else{
        $create_table = "CREATE TABLE keyword(
            id INT NOT NULL AUTO_INCREMENT,
            p_key VARCHAR(50),
            s_key MEDIUMTEXT,
            PRIMARY KEY (id)
        )";
        $response = $db->query($create_table);
        if($response)
        {
            $insert_data = "INSERT INTO keyword(p_key, s_key) VALUES('$p_key', '$s_key')";
            $response = $db->query($insert_data);
            if($response){
                echo "success";
            }
            else{
                echo "unable to store keyword";
            }
        }
        else{
            echo "please try again later";
        }
    }

?>