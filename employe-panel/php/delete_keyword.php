<?php
    require_once "../../common-files/php/database.php";
    $keyword = JSON_decode($_POST['tags']);
    for($i = 0; $i <count($keyword); $i++)
    {
        $match_keyword = "SELECT * FROM keyword WHERE s_key LIKE '%$keyword[$i]%'";
        $response = $db->query($match_keyword);
        if($response->num_rows != 0)
        {
            $delete = "DELETE FROM failed_keyword WHERE keyword = '%$keyword[$i]'";
            $response = $db->query($delete);
            if($response)
            {
                echo "delete success";
            }
            
        }
        // echo $keyword[$i];
    }
?>