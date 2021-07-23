<?php
header('Content-Type: application/xls');
header('Content-Disposition: Attachment; filename=purchase_entry.xls');
require_once "../../common-files/php/database.php";
echo '<table class="w-100 purchase-table text-center border table table-bordered">
<tr>
  <th>S/No</th>
  <th>PRODUCT_ID</th>
  <th>TITLE</th>
  <th>QUANTITY</th>
  <th>PRICE</th>
  <th>ADDRESS</th>
  <th>STATE</th>
  <th>COUNTRY</th>
  <th>PINCODE</th>
  <th>PURCHASE DATE</th>
  <th>CUSTOMER NAME</th>
  <th>USERNAME</th>
  <th>MOBILE</th>
  <th>STATUS</th>

</tr>';
$product = "SELECT * FROM purchase";
$response = $db->query($product);
if($response)
{
  while($data = $response->fetch_assoc())
  {
    echo "<tr>";
    echo "<td class='s-no'>";
    echo "$data[id]";
    echo "</td>";

    echo "<td>";
    echo "$data[product_id]";
    echo "</td>";

    echo "<td>";
    echo "$data[title]";
    echo "</td>";

    echo "<td>";
    echo "$data[quantity]";
    echo "</td>";

    echo "<td>";
    echo "$data[price]";
    echo "</td>";

    echo "<td>";
    echo "$data[address]";
    echo "</td>";

    echo "<td>";
    echo "$data[state]";
    echo "</td>";

    echo "<td>";
    echo "$data[country]";
    echo "</td>";

    echo "<td>";
    echo "$data[pincode]";
    echo "</td>";

    echo "<td>";
    echo "$data[purchase_date]";
    echo "</td>";
    

    echo "<td>";
    echo "$data[fullname]";
    echo "</td>";

    echo "<td>";
    echo "$data[email]";
    echo "</td>";

    echo "<td>";
    echo "$data[phone]";
    echo "</td>";

    echo "<td class='status'>";
    echo "$data[status]";
    echo "</td>";

    // echo "<td>";
    // if($data['status'] == 'processing') {
    // echo "<button class='btn btn-success dispatch_btn' order_id='".$data['id']."' title='".$data['title']."' quantity='".$data['quantity']."' full_name='".$data['fullname']."' email='".$data['email']."' phone='".$data['phone']."' amount='".$data['price']."' address='".$data['address']."'>dispatch</button>";
    // }
    // else if($data['status'] == 'dispatched'){
    // echo "<button class='btn btn-danger' disabled order_id='".$data['id']."' title='".$data['title']."' quantity='".$data['quantity']."' full_name='".$data['fullname']."' email='".$data['email']."' phone='".$data['phone']."' amount='".$data['price']."' address='".$data['address']."'>already dispatched on ".$data['dispatched_date']."</button>";

    // }
    // echo "</td>";

  }
}
echo "</tr>";
echo '</table>';
?>