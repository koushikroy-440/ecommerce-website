<?php
require_once("../../common-files/databases/database.php");
if (empty($_COOKIE['_au_'])) {
    header("Location:../../signin.php");
    exit;
}
$keyword = $_GET['search'];
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

<body style="background-color: #F8F9FC">

    <?php
    include_once("../../asset/nav.php");
    ?>
    <div class="container-fluid" style="margin-top: 80px; margin-bottom:40px;">
        <div class="row">
            <div class="col-md-12 p-4 d-flex justify-content-center flex-wrap">
                <?php
                $get_data = "SELECT * FROM products WHERE title LIKE '%$keyword%' LIMIT 10";
                $response = $db->query($get_data);
                if ($response->num_rows != 0) {
                    while ($data = $response->fetch_assoc()) {
                        $id = $data['id'];
                        echo "<div class='col-md-3 py-5' align='center'>";
                        echo "<img src='../../" . $data['thumb_pic'] . "' width='250' height='316'><br>";
                        echo "<span class='font-weight-bold text-uppercase'>" . $data['brands'] . "</span><br> ";
                        //display start of 
                        $one = [];
                        $two = [];
                        $three = [];
                        $four = [];
                        $five = [];
                        $get_data = "SELECT * FROM purchase WHERE product_id = '$id' AND ratings <> 0";
                        $star_response = $db->query($get_data);
                        if ($star_response) {
                            while ($rating_data = $star_response->fetch_assoc()) {
                                if ($rating_data['ratings'] == 1) {
                                    array_push($one, 1);
                                } else if ($rating_data['ratings'] == 2) {
                                    array_push($two, 2);
                                } else if ($rating_data['ratings'] == 3) {
                                    array_push($three, 3);
                                } else if ($rating_data['ratings'] == 4) {
                                    array_push($four, 4);
                                } else if ($rating_data['ratings'] == 5) {
                                    array_push($five, 5);
                                }
                            }
                        }
                        $count_one = count($one);
                        $count_two = count($two);
                        $count_three = count($three);
                        $count_four = count($four);
                        $count_five = count($five);

                        $all_length = [$count_one, $count_two, $count_three, $count_four, $count_five];
                        $max = "0";
                        for ($i = 0; $i < count($all_length); $i++) {
                            if ($all_length[$i] > $max) {
                                $max = $all_length[$i];
                            }
                        }
                        if ($max == $count_one) {
                            for ($i = 0; $i < 1; $i++) {
                                echo "<i class='fa fa-star text-warning'></i>";
                            }
                            $rest_star = 5 - 1;
                            for ($i = 0; $i < $rest_star; $i++) {
                                echo "<i class='fa fa-star-0 text-warning'></i>";
                            }
                        } else if ($max == $count_two) {
                            for ($i = 0; $i < 2; $i++) {
                                echo "<i class='fa fa-star text-warning'></i>";
                            }
                            $rest_star = 5 - 2;
                            for ($i = 0; $i < $rest_star; $i++) {
                                echo "<i class='fa fa-star-0 text-warning'></i>";
                            }
                        } else if ($max == $count_three) {
                            for ($i = 0; $i < 3; $i++) {
                                echo "<i class='fa fa-star text-warning'></i>";
                            }
                            $rest_star = 5 - 3;
                            for ($i = 0; $i < $rest_star; $i++) {
                                echo "<i class='fa fa-star-0 text-warning'></i>";
                            }
                        } else if ($max == $count_four) {
                            for ($i = 0; $i < 4; $i++) {
                                echo "<i class='fa fa-star text-warning'></i>";
                            }
                            $rest_star = 5 - 4;
                            for ($i = 0; $i < $rest_star; $i++) {
                                echo "<i class='fa fa-star-0 text-warning'></i>";
                            }
                        } else if ($max == $count_five) {
                            for ($i = 0; $i < 5; $i++) {
                                echo "<i class='fa fa-star text-warning'></i>";
                            }
                        }

                        echo "<br><span>" . $data['title'] . "</span> <br>";
                        echo "<span><i class='fa fa-rupee'> </i>" . $data['price'] . "</span>";
                        echo "<br><button class='btn btn-success cart-btn' product-id='" . $data['id'] . "' product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-cart'></i> ADD TO CART</button> 
                                <button class='btn btn-primary buy-btn' product-id='" . $data['id'] . "'  product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-bag'></i> SHOP NOW</button>";
                        echo "</div>";
                    }
                } else {
                    $get_data = "SELECT * FROM products WHERE category_name LIKE '%$keyword%' LIMIT 10";
                    $response = $db->query($get_data);
                    if ($response->num_rows != 0) {
                        while ($data = $response->fetch_assoc()) {
                            $id = $data['id'];
                            echo "<div class='col-md-3 py-5' align='center'>";
                            echo "<img src='../../" . $data['thumb_pic'] . "' width='250' height='316'><br>";
                            echo "<span class='font-weight-bold text-uppercase'>" . $data['brands'] . "</span><br> ";
                            //display start of 
                            $one = [];
                            $two = [];
                            $three = [];
                            $four = [];
                            $five = [];
                            $get_data = "SELECT * FROM purchase WHERE product_id = '$id' AND ratings <> 0";
                            $star_response = $db->query($get_data);
                            if ($star_response) {
                                while ($rating_data = $star_response->fetch_assoc()) {
                                    if ($rating_data['ratings'] == 1) {
                                        array_push($one, 1);
                                    } else if ($rating_data['ratings'] == 2) {
                                        array_push($two, 2);
                                    } else if ($rating_data['ratings'] == 3) {
                                        array_push($three, 3);
                                    } else if ($rating_data['ratings'] == 4) {
                                        array_push($four, 4);
                                    } else if ($rating_data['ratings'] == 5) {
                                        array_push($five, 5);
                                    }
                                }
                            }
                            $count_one = count($one);
                            $count_two = count($two);
                            $count_three = count($three);
                            $count_four = count($four);
                            $count_five = count($five);

                            $all_length = [$count_one, $count_two, $count_three, $count_four, $count_five];
                            $max = "0";
                            for ($i = 0; $i < count($all_length); $i++) {
                                if ($all_length[$i] > $max) {
                                    $max = $all_length[$i];
                                }
                            }
                            if ($max == $count_one) {
                                for ($i = 0; $i < 1; $i++) {
                                    echo "<i class='fa fa-star text-warning'></i>";
                                }
                                $rest_star = 5 - 1;
                                for ($i = 0; $i < $rest_star; $i++) {
                                    echo "<i class='fa fa-star-0 text-warning'></i>";
                                }
                            } else if ($max == $count_two) {
                                for ($i = 0; $i < 2; $i++) {
                                    echo "<i class='fa fa-star text-warning'></i>";
                                }
                                $rest_star = 5 - 2;
                                for ($i = 0; $i < $rest_star; $i++) {
                                    echo "<i class='fa fa-star-0 text-warning'></i>";
                                }
                            } else if ($max == $count_three) {
                                for ($i = 0; $i < 3; $i++) {
                                    echo "<i class='fa fa-star text-warning'></i>";
                                }
                                $rest_star = 5 - 3;
                                for ($i = 0; $i < $rest_star; $i++) {
                                    echo "<i class='fa fa-star-0 text-warning'></i>";
                                }
                            } else if ($max == $count_four) {
                                for ($i = 0; $i < 4; $i++) {
                                    echo "<i class='fa fa-star text-warning'></i>";
                                }
                                $rest_star = 5 - 4;
                                for ($i = 0; $i < $rest_star; $i++) {
                                    echo "<i class='fa fa-star-0 text-warning'></i>";
                                }
                            } else if ($max == $count_five) {
                                for ($i = 0; $i < 5; $i++) {
                                    echo "<i class='fa fa-star text-warning'></i>";
                                }
                            }

                            echo "<br><span>" . $data['title'] . "</span> <br>";
                            echo "<span><i class='fa fa-rupee'> </i>" . $data['price'] . "</span>";
                            echo "<br><button class='btn btn-success cart-btn' product-id='" . $data['id'] . "' product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-cart'></i> ADD TO CART</button> 
                                <button class='btn btn-primary buy-btn' product-id='" . $data['id'] . "'  product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-bag'></i> SHOP NOW</button>";
                            echo "</div>";
                        }
                    } else {
                        $get_data = "SELECT * FROM products WHERE brands LIKE '%$keyword%' LIMIT 10";
                        $response = $db->query($get_data);
                        if ($response->num_rows != 0) {
                            while ($data = $response->fetch_assoc()) {
                                $id = $data['id'];
                                echo "<div class='col-md-3 py-5' align='center'>";
                                echo "<img src='../../" . $data['thumb_pic'] . "' width='250' height='316'><br>";
                                echo "<span class='font-weight-bold text-uppercase'>" . $data['brands'] . "</span><br> ";
                                //display start of 
                                $one = [];
                                $two = [];
                                $three = [];
                                $four = [];
                                $five = [];
                                $get_data = "SELECT * FROM purchase WHERE product_id = '$id' AND ratings <> 0";
                                $star_response = $db->query($get_data);
                                if ($star_response) {
                                    while ($rating_data = $star_response->fetch_assoc()) {
                                        if ($rating_data['ratings'] == 1) {
                                            array_push($one, 1);
                                        } else if ($rating_data['ratings'] == 2) {
                                            array_push($two, 2);
                                        } else if ($rating_data['ratings'] == 3) {
                                            array_push($three, 3);
                                        } else if ($rating_data['ratings'] == 4) {
                                            array_push($four, 4);
                                        } else if ($rating_data['ratings'] == 5) {
                                            array_push($five, 5);
                                        }
                                    }
                                }
                                $count_one = count($one);
                                $count_two = count($two);
                                $count_three = count($three);
                                $count_four = count($four);
                                $count_five = count($five);

                                $all_length = [$count_one, $count_two, $count_three, $count_four, $count_five];
                                $max = "0";
                                for ($i = 0; $i < count($all_length); $i++) {
                                    if ($all_length[$i] > $max) {
                                        $max = $all_length[$i];
                                    }
                                }
                                if ($max == $count_one) {
                                    for ($i = 0; $i < 1; $i++) {
                                        echo "<i class='fa fa-star text-warning'></i>";
                                    }
                                    $rest_star = 5 - 1;
                                    for ($i = 0; $i < $rest_star; $i++) {
                                        echo "<i class='fa fa-star-0 text-warning'></i>";
                                    }
                                } else if ($max == $count_two) {
                                    for ($i = 0; $i < 2; $i++) {
                                        echo "<i class='fa fa-star text-warning'></i>";
                                    }
                                    $rest_star = 5 - 2;
                                    for ($i = 0; $i < $rest_star; $i++) {
                                        echo "<i class='fa fa-star-0 text-warning'></i>";
                                    }
                                } else if ($max == $count_three) {
                                    for ($i = 0; $i < 3; $i++) {
                                        echo "<i class='fa fa-star text-warning'></i>";
                                    }
                                    $rest_star = 5 - 3;
                                    for ($i = 0; $i < $rest_star; $i++) {
                                        echo "<i class='fa fa-star-0 text-warning'></i>";
                                    }
                                } else if ($max == $count_four) {
                                    for ($i = 0; $i < 4; $i++) {
                                        echo "<i class='fa fa-star text-warning'></i>";
                                    }
                                    $rest_star = 5 - 4;
                                    for ($i = 0; $i < $rest_star; $i++) {
                                        echo "<i class='fa fa-star-0 text-warning'></i>";
                                    }
                                } else if ($max == $count_five) {
                                    for ($i = 0; $i < 5; $i++) {
                                        echo "<i class='fa fa-star text-warning'></i>";
                                    }
                                }

                                echo "<br><span>" . $data['title'] . "</span> <br>";
                                echo "<span><i class='fa fa-rupee'> </i>" . $data['price'] . "</span>";
                                echo "<br><button class='btn btn-success cart-btn' product-id='" . $data['id'] . "' product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-cart'></i> ADD TO CART</button> 
                                    <button class='btn btn-primary buy-btn' product-id='" . $data['id'] . "'  product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-bag'></i> SHOP NOW</button>";
                                echo "</div>";
                            }
                        } else {
                            //search from secondary key
                            $get_data = "SELECT * FROM keyword WHERE s_key LIKE '%$keyword%' ";
                            $response = $db->query($get_data);
                            if ($response->num_rows != 0) {
                                $data = $response->fetch_assoc();
                                $p_key = $data['p_key'];
                                $get_data = "SELECT * FROM products WHERE category_name LIKE '%$p_key%' LIMIT 10";
                                $response = $db->query($get_data);
                                if ($response->num_rows != 0) {
                                    while ($data = $response->fetch_assoc()) {
                                        $id = $data['id'];
                                        echo "<div class='col-md-3 py-5' align='center'>";
                                        echo "<img src='../../" . $data['thumb_pic'] . "' width='250' height='316'><br>";
                                        echo "<span class='font-weight-bold text-uppercase'>" . $data['brands'] . "</span><br> ";
                                        //display start of 
                                        $one = [];
                                        $two = [];
                                        $three = [];
                                        $four = [];
                                        $five = [];
                                        $get_data = "SELECT * FROM purchase WHERE product_id = '$id' AND ratings <> 0";
                                        $star_response = $db->query($get_data);
                                        if ($star_response) {
                                            while ($rating_data = $star_response->fetch_assoc()) {
                                                if ($rating_data['ratings'] == 1) {
                                                    array_push($one, 1);
                                                } else if ($rating_data['ratings'] == 2) {
                                                    array_push($two, 2);
                                                } else if ($rating_data['ratings'] == 3) {
                                                    array_push($three, 3);
                                                } else if ($rating_data['ratings'] == 4) {
                                                    array_push($four, 4);
                                                } else if ($rating_data['ratings'] == 5) {
                                                    array_push($five, 5);
                                                }
                                            }
                                        }
                                        $count_one = count($one);
                                        $count_two = count($two);
                                        $count_three = count($three);
                                        $count_four = count($four);
                                        $count_five = count($five);

                                        $all_length = [$count_one, $count_two, $count_three, $count_four, $count_five];
                                        $max = "0";
                                        for ($i = 0; $i < count($all_length); $i++) {
                                            if ($all_length[$i] > $max) {
                                                $max = $all_length[$i];
                                            }
                                        }
                                        if ($max == $count_one) {
                                            for ($i = 0; $i < 1; $i++) {
                                                echo "<i class='fa fa-star text-warning'></i>";
                                            }
                                            $rest_star = 5 - 1;
                                            for ($i = 0; $i < $rest_star; $i++) {
                                                echo "<i class='fa fa-star-0 text-warning'></i>";
                                            }
                                        } else if ($max == $count_two) {
                                            for ($i = 0; $i < 2; $i++) {
                                                echo "<i class='fa fa-star text-warning'></i>";
                                            }
                                            $rest_star = 5 - 2;
                                            for ($i = 0; $i < $rest_star; $i++) {
                                                echo "<i class='fa fa-star-0 text-warning'></i>";
                                            }
                                        } else if ($max == $count_three) {
                                            for ($i = 0; $i < 3; $i++) {
                                                echo "<i class='fa fa-star text-warning'></i>";
                                            }
                                            $rest_star = 5 - 3;
                                            for ($i = 0; $i < $rest_star; $i++) {
                                                echo "<i class='fa fa-star-0 text-warning'></i>";
                                            }
                                        } else if ($max == $count_four) {
                                            for ($i = 0; $i < 4; $i++) {
                                                echo "<i class='fa fa-star text-warning'></i>";
                                            }
                                            $rest_star = 5 - 4;
                                            for ($i = 0; $i < $rest_star; $i++) {
                                                echo "<i class='fa fa-star-0 text-warning'></i>";
                                            }
                                        } else if ($max == $count_five) {
                                            for ($i = 0; $i < 5; $i++) {
                                                echo "<i class='fa fa-star text-warning'></i>";
                                            }
                                        }

                                        echo "<br><span>" . $data['title'] . "</span> <br>";
                                        echo "<span><i class='fa fa-rupee'> </i>" . $data['price'] . "</span>";
                                        echo "<br><button class='btn btn-success cart-btn' product-id='" . $data['id'] . "' product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-cart'></i> ADD TO CART</button> 
                                            <button class='btn btn-primary buy-btn' product-id='" . $data['id'] . "'  product-title='" . $data['title'] . "' product-brand='" . $data['brands'] . "' product-price='" . $data['price'] . "' product-pic='" . $data['thumb_pic'] . "'><i class='fa fa-shopping-bag'></i> SHOP NOW</button>";
                                        echo "</div>";
                                    }
                                }
                            } else {
                                //store failed keywords
                                $get_data = "SELECT * FROM failed_keyword";
                                $response = $db->query($get_data);
                                if ($response) {
                                    $insert_data = "INSERT INTO failed_keyword(keyword) VALUES('$keyword')";
                                        $response = $db->query($insert_data);
                                        if ($response) {
                                            echo "product not found!";
                                        } else {
                                            echo "something went wrong please tryagain later";
                                        }
                                } else {
                                    $create_table = "CREATE TABLE failed_keyword(
                                        id INT(11) NOT NULL AUTO_INCREMENT,
                                        keyword MEDIUMTEXT,
                                        status VARCHAR(50) DEFAULT 'pending',
                                        PRIMARY KEY (id)
                                    )";
                                    $response = $db->query($create_table);
                                    if ($response) {
                                        $insert_data = "INSERT INTO failed_keyword(keyword) VALUES('$keyword')";
                                        $response = $db->query($insert_data);
                                        if ($response) {
                                            echo "product not found!";
                                        } else {
                                            echo "something went wrong please tryagain later";
                                        }
                                    } else {
                                        echo "something went wrong please tryagain later";
                                    }
                                }
                            }
                        }
                    }
                }

                ?>
            </div>
        </div>
    </div>
    <?php
    include_once("../../asset/footer.php");
    ?>
</body>

</html>