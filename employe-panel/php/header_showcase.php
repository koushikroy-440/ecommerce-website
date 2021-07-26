<?php
        require_once("../../common-files/databases/database.php");
        $file = "";
        $location = "";
        $file_binary = "";
        if($_FILES)
        {
                $file = $_FILES['file_data'];
                $location = $file['tmp_name'];
                $file_binary = addslashes(file_get_contents($location));
        }
        

        $json_data = json_encode($_POST['css_data']);
        $tmp_data = json_decode($json_data, true);
        $all_data = json_decode($tmp_data, true);
        $option = $all_data['option'];
        $title_text = addslashes($all_data['title_text']);
        $title_color = $all_data['title_color'];
        $title_size = $all_data['title_size'];

        $subtitle_text = addslashes($all_data['subtitle_text']);
        $subtitle_color = $all_data['subtitle_color'];
        $subtitle_size = $all_data['subtitle_size'];

        $h_align = $all_data['h_align'];
        $v_align = $all_data['v_align'];
        $button = addslashes($all_data['button']);

        $check_table = "SELECT count(id) AS result FROM header_showcase";
        $response = $db->query($check_table);
        if($response)
        {
                $data = $response->fetch_assoc();
                $count_rows = $data['result'];
                if($count_rows < 3)
                {
                        if($option == "choose title"){
                        
                                $store_data = "INSERT INTO header_showcase(title_image,title_text,title_color,title_size,subtitle_text,subtitle_size,subtitle_color,h_align,v_align,buttons)
                                VALUES('$file_binary','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_size','$subtitle_color','$h_align','$v_align','$button')";
                                $response = $db->query($store_data);
                                if($response)
                                {
                                echo "success"; 
                                }
                                else{
                                        echo "unable able to store data in header showcase 484848";
                                }
                        }
                        else{
                                if($file == ""){
                                        $update_data = "UPDATE header_showcase SET title_text = '$title_text',title_color = '$title_color',title_size = '$title_size',subtitle_text = '$subtitle_text',subtitle_size = '$subtitle_size',subtitle_color = '$subtitle_color',h_align = '$h_align',v_align = '$v_align',buttons = '$button' ";
                                        $response = $db->query($update_data);
                                        if($response)
                                        {
                                                echo "update success";
                                        }
                                        else{
                                                echo "update failed";
                                        }
                                }
                                else{
                                        $update_data = "UPDATE header_showcase SET title_image = '$file_binary',title_text = '$title_text',title_color = '$title_color',title_size = '$title_size',subtitle_text = '$subtitle_text',subtitle_size = '$subtitle_size',subtitle_color = '$subtitle_color',h_align = '$h_align',v_align = '$v_align',buttons = '$button' ";
                                        $response = $db->query($update_data);
                                        if($response)
                                        {
                                                echo "update success";
                                        }
                                        else{
                                                echo "update failed";
                                        }  
                                }
                        }
                        
                }
                else if($count_rows >= 3)
                {
                        if($option == "choose title")
                        {
                                echo "limit full";
                        }
                        else{
                                if($file == ""){
                                        $update_data = "UPDATE header_showcase SET title_text = '$title_text',title_color = '$title_color',title_size = '$title_size',subtitle_text = '$subtitle_text',subtitle_size = '$subtitle_size',subtitle_color = '$subtitle_color',h_align = '$h_align',v_align = '$v_align',buttons = '$button' ";
                                        $response = $db->query($update_data);
                                        if($response)
                                        {
                                                echo "update success";
                                        }
                                        else{
                                                echo "update failed";
                                        }
                                }
                                else{
                                        $update_data = "UPDATE header_showcase SET title_image = '$file_binary',title_text = '$title_text',title_color = '$title_color',title_size = '$title_size',subtitle_text = '$subtitle_text',subtitle_size = '$subtitle_size',subtitle_color = '$subtitle_color',h_align = '$h_align',v_align = '$v_align',buttons = '$button' ";
                                        $response = $db->query($update_data);
                                        if($response)
                                        {
                                                echo "update success";
                                        }
                                        else{
                                                echo "update failed";
                                        }  
                                }
                        }
                }
        }
        else{
                $create_table = "CREATE TABLE header_showcase(
                        id INT(11) NOT NULL AUTO_INCREMENT,
                        title_image MEDIUMBLOB,
                        title_text VARCHAR(225),
                        title_color VARCHAR(20),
                        title_size VARCHAR(10),
                        subtitle_text VARCHAR(225),
                        subtitle_color VARCHAR(20),
                        subtitle_size VARCHAR(10),
                        h_align VARCHAR(20),
                        v_align VARCHAR(20),
                        buttons MEDIUMTEXT,
                        PRIMARY KEY (id)

                )";
                $response = $db->query($create_table);
                if($response)
                {
                        $store_data = "INSERT INTO header_showcase(title_image,title_text,title_color,title_size,subtitle_text,subtitle_size,subtitle_color,h_align,v_align,buttons)
                        VALUES('$file_binary','$title_text','$title_color','$title_size','$subtitle_text','$subtitle_size','$subtitle_color','$h_align','$v_align','$button')";
                        $response = $db->query($store_data);
                        if($response)
                        {
                               echo "success"; 
                        }
                        else{
                                echo "unable able to store data in header showcase 484848";
                        }
                }
                else{
                        echo "unable to store data header_showcase table";
                }
        }
