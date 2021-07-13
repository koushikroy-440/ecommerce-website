<?php
require_once "../common-files/databases/database.php";
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--============= Bootstrap CSS ======= -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--============= fa fa-icon cdn ================-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--============= css pages========= -->
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/animate.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/indexs.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="sidebar">
      <button class="btn w-100 text-left collapse-item active" access-link="branding_design.php" style="font-size:20px">
        <i class="fa fa-image"></i>
        Branding details
      </button>

      <button class="btn w-100 text-left homepage-design-btn" style="font-size:20px">
        <i class="fa fa-home"></i>
        homepage design
        <i class="fa fa-angle-down close mt-2"></i>
      </button>

      <ul class="collapse homepage-design-collapse">
        <li class="border-left p-2 collapse-item" access-link="header_showcase_design.php">Header Showcase</li>
        <li class="border-left p-2 collapse-item" access-link="category_showcase_design.php">Category Showcase</li>

      </ul>

      <button class="btn w-100 text-left stock-update-btn" style="font-size:20px">
        <i class="fa fa-shopping-cart"></i>
        Stock update
        <i class="fa fa-angle-down close mt-2"></i>
      </button>
      <ul class="collapse stock-update-btn-menu">
        <li class="border-left p-2 collapse-item" access-link="create_category_design.php">Create category</li>
        <li class="border-left p-2 collapse-item" access-link="create_brands_design.php">Create brand</li>
        <li class="border-left p-2 collapse-item" access-link="create_products_design.php">Create products</li>
      </ul>
      <button class="btn w-100 text-left collapse-item active" access-link="delivery_area_design.php" style="font-size:20px">
        <i class="fa fa-map-marker"></i>
        Delivery area
      </button>
    </div>

  </div>
  <div class="page">
    <div class="row">
      <div class="col-md-12">
        <div class="btn-group border bg-white shadow">
          <button class="btn bg-white">SHORT BY</button>
          <button class="btn bg-white">
            <select>
              <option value="all-data">ALL DATA</option>
            </select>
          </button>
        </div>

        <div class="btn-group border bg-white shadow">
          <button class="btn bg-white">EXPORT TO</button>
          <button class="btn bg-white">
            <select>
              <option>Choose formate</option>
              <option>pdf</option>
              <option>xls</option>
            </select>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="table-responsive">
        <table class="w-100 purchase-table text-center border table table-bordered">
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
            <th>ACTION</th>
          </tr>
          <?php
            $product = "SELECT * FROM purchase";
            $response = $db->query($product);
            if($response)
            {
              while($data = $response->fetch_assoc())
              {
                echo "<tr>";
                echo "<td>";
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

                echo "<td>";
                echo "$data[status]";
                echo "</td>";

                echo "<td>";
                echo "<button class='btn btn-success'>dispatch</button>";
                echo "</td>";

              }
            }
          ?>
        </table>
        </div>
      </div>
    </div>
  </div>
 
</body>

</html>