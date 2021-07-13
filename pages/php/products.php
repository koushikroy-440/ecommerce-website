<?php
require_once("../../common-files/databases/database.php");
$cat_name = $_GET["cat_name"];
?>
<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
</head>

<body style="background-color: #ddd">

    <?php
    include_once("../../asset/nav.php");
    ?>
    <div class="container-fluid" style="margin-top: 100px; margin-bottom:40px;">
    <a href="#" class="text-capitalize">
    <?php
    echo $cat_name;
    ?>
    </a>
        <div class="row mt-2">
            <div class="col-md-3">
                <div class="bg-white w-100 p-4 border">
                    <h5>Filter</h5>
                    <div class="btn-group-vertical">
                    <?php
                        $get_data = "SELECT * FROM brands WHERE category_name='$cat_name'";
                        $response = $db->query($get_data);
                        if($response){
                            while($data = $response->fetch_assoc()){
                                echo"<button class='btn px-0 text-capitalize text-left category-btn' category_name=".$cat_name." brand_name=".$data['brands'].">".$data['brands']."</button>";
                            }
                        }
                            
                    ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="bg-white w-100 p-4 border filter-result d-flex flex-wrap justify-content-between">

                </div>
            </div>
        </div>
    </div>
    <?php
    include_once("../../asset/footer.php");
    ?>
</body>

</html>