<?php
// include autoloader
require_once '../../dompdf/autoload.inc.php';
require_once("../../common-files/php/database.php");
$design = "<html>
    <body>
        <table border='1' width='100%' style='text-align:center;border-collapse:collapse'>
        <caption style='font-size:30px;font-weight:bold;margin: bottom 15px;'>SALES REPORT</caption>
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
                <th>DISPATCH DATE</th>
            </tr> ";
            $product = "SELECT * FROM purchase";
            $response = $db->query($product);
            if($response)
            {
              while($data = $response->fetch_assoc())
              {
                 $design .= "<tr>
                    <td>".$data['id']."</td>
                    <td>".$data['product_id']."</td>
                    <td>".$data['title']."</td>
                    <td>".$data['quantity']."</td>
                    <td>".$data['price']."</td>
                    <td>".$data['address']."</td>
                    <td>".$data['state']."</td>
                    <td>".$data['country']."</td>
                    <td>".$data['pincode']."</td>
                    <td>".$data['purchase_date']."</td>
                    <td>".$data['fullname']."</td>
                    <td>".$data['email']."</td>
                    <td>".$data['phone']."</td>
                    <td>".$data['phone']."</td>
                    <td>".$data['dispatch_date']."</td>
                    
                  </td>";
              }
              $design .= "</table></tr></body></html>";
            }
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A3', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
