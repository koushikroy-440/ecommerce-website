<?php
require_once("../../common-files/databases/database.php");
$key_word = $_POST['keyword'];
$get_data = "SELECT * FROM products WHERE title LIKE '%$key_word%' LIMIT 10";
$response = $db->query($get_data);
if($response){
    while($data = $response->fetch_assoc())
    {
        echo "<p class='mx-4 my-2 search-tag p-2' product-id='".$data['id']."'>".$data['title']."</p>";
    }
}


?>