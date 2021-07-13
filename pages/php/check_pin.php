<?php
 require_once("../../common-files/databases/database.php");
 $pin = $_POST['pin'];
 $check_pin = "SELECT * FROM delivery_area WHERE pincode = '$pin'";
 $response = $db->query($check_pin);
 if($response->num_rows != 0)
 {
     $data = $response->fetch_assoc();
     echo $data['delivery_time'];
 }
 else {
     echo "oops! delivery not available in your area.";
 }
 
 ?>