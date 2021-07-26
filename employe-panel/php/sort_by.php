<?php
    require_once ("../../common-files/php/database.php");
    $all_data = [];
    $option = $_POST['option'];
    $date = date('y-m-d');
    if($option == "today_sales"){
        $get_data = "SELECT * FROM purchase WHERE purchase_date = '$date'";
        $response = $db->query($get_data);
        if($response -> num_rows != 0)
        {
            while($data = $response->fetch_assoc())
            {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else{
            echo "order now found";
        }
    }

    else if($option == "new_sales"){
        $get_data = "SELECT * FROM purchase ORDER BY purchase_date DESC";
        $response = $db->query($get_data);
        if($response -> num_rows != 0)
        {
            while($data = $response->fetch_assoc())
            {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else{
            echo "order now found";
        }
    }
    
    else if($option == "old_sales"){
        $get_data = "SELECT * FROM purchase ORDER BY purchase_date ASC";
        $response = $db->query($get_data);
        if($response -> num_rows != 0)
        {
            while($data = $response->fetch_assoc())
            {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else{
            echo "order now found";
        }
    }

    else if($option == "processing"){
        $get_data = "SELECT * FROM purchase WHERE status = 'processing'";
        $response = $db->query($get_data);
        if($response -> num_rows != 0)
        {
            while($data = $response->fetch_assoc())
            {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else{
            echo "order now found";
        }
    }

    else if($option == "dispatched"){
        $get_data = "SELECT * FROM purchase WHERE status = 'dispatched'";
        $response = $db->query($get_data);
        if($response -> num_rows != 0)
        {
            while($data = $response->fetch_assoc())
            {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else{
            echo "order now found";
        }
    }

    else if($option == "return"){
        $get_data = "SELECT * FROM purchase WHERE status = 'return'";
        $response = $db->query($get_data);
        if($response -> num_rows != 0)
        {
            while($data = $response->fetch_assoc())
            {
                array_push($all_data, $data);
            }
            echo json_encode($all_data);
        }
        else{
            echo "order now found";
        }
    }
