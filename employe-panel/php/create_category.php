<?php
    require_once("../../common-files/php/database.php");
   $json_data = (json_decode($_POST['json_data']));
   $length = count($json_data);
   $message = "";
    $select_category_table = "SELECT * FROM category";
    if($db->query($select_category_table))
    {
        for($i = 0; $i < $length ; $i++)
        {
            $store_data = "INSERT INTO category(category_name) VALUES('$json_data[$i]')";
            if($db->query($store_data))
            {
                
              if(mkdir("../../stocks/".$json_data[$i]))
              {
                $message ="done";
              }
            }
            else{

                $message = "Failed to store data in table";
                
            }
        }
        echo $message;
    }
    else{
           $create_table = "CREATE TABLE category (
               id INT(11) NOT NULL AUTO_INCREMENT,
               category_name VARCHAR(50),
                PRIMARY KEY (id)       
               )";
               if($db->query($create_table))
               {
                   for($i = 0; $i < $length ; $i++)
                   {
                       $store_data = "INSERT INTO category(category_name) VALUES('$json_data[$i]')";
                       if($db->query($store_data))
                       {
                        $message = "done"; 
                       }
                       else{
                        $message = "error not inserted";
                       }
                   }
                   echo $message;
               }
               else{
                   echo "table not created";
               }
    }
?>