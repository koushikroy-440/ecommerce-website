<?php
require_once("../../common-files/databases/database.php");
if (empty($_COOKIE['_au_'])) {
    header("Location:../../signin.php");
    exit;
}
$username = base64_decode($_COOKIE['_au_']);
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
    <div class="container" style="margin-top: 80px; margin-bottom:40px;">
      <div class="row">
          <div class="col-md-12">
              <ul class="nav nav-tabs">
                  <li class="nav-item">
                      <a href="#personal" class="nav-link active" data-toggle="tab">
                          PERSONAL
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#privacy" class="nav-link" data-toggle="tab">
                          PRIVACY
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#purchase" class="nav-link" data-toggle="tab">
                          PURCHASE HISTORY
                      </a>
                  </li>
              </ul>
              <div class="tab-content">
                  <div class="tab-pane active" id="personal">
                        <?php
                            $first_name = "";
                            $last_name = "";
                            $email = "";
                            $mobile = "";
                            $state = "";
                            $pin_code = "";
                            $country = "";
                            $address = "";

                            $get_data = "SELECT * FROM users WHERE  email = '$username'";
                            $response = $db->query($get_data);
                            if($response)
                            {
                                $data = $response->fetch_assoc();
                                echo $data['email'];
                                $first_name = $data['firstname'];
                                $last_name = $data['lastname'];
                                $email = $data['email'];
                                $mobile = $data['mobile'];
                                $state = $data['state'];
                                $pin_code = $data['pincode'];
                                $country = $data['country'];
                                $address = $data['address'];

                            }

                        ?>
                        <div class="jumbotron py-3 my-4 bg-white shadow-sm border-top border-bottom" style="border-left: 5px solid blue">
                            <form class="personal-form">
                                <div class="form-group">
                                    <label for="first-name">Firstname</label>
                                    <input type="text" name="firstname" id="first-name" class="form-control" value="<?php echo $first_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Lastname</label>
                                    <input type="text" name="Lastname" id="last-name" class="form-control" value="<?php echo $last_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control" value="<?php echo $mobile ?>">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" class="form-control" value="<?php echo $state ?>">
                                </div>
                                <div class="form-group">
                                    <label for="pin-code">PinCode</label>
                                    <input type="number" name="pin-code" id="pin-code" class="form-control" value="<?php echo $pin_code ?>">
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" id="country" class="form-control" value="<?php echo $country ?>">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="10">
                                    <?php echo $address ?>
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                            </form>
                        </div>
                  </div>
                  <div class="tab-pane fade" id="privacy"></div>
                  <div class="tab-pane fade" id="purchase"></div>


              </div>
          </div>
      </div>
    </div>
    <?php
    include_once("../../asset/footer.php");
    ?>
</body>

</html>