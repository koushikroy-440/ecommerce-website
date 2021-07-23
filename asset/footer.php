<div class="container-fluid bg-white border-top py-3" style="margin-top: 100px">
        <div class="container d-flex justify-content-between">
          <div class="input-group">
            <input type="email" placeholder="email@gmail.com" name="subscribe-email" class="form-control subscribe-email">
            <div class="input-group-append">
              <button class="btn btn-success subscribe-btn">SUBSCRIBE</button>
            </div>
          </div>

          <div class="btn-group">
           
            <button class="btn border px-3"><i class="fa fa-facebook"><a href="<?php echo $branding_data['facebook'] ?>"></a></i></button>
            <button class="btn border px-3"><i class="fa fa-instagram"><a href="<?php echo $branding_data['instagram'] ?>"></a></i></button>
          </div>

        </div>
      </div>
      <div class="container-fluid bg-dark">
        <div class="container py-3">
          <div class="row">
            <div class="col-md-3">
            <h5 class="text-light">CATEGORY</h5>
            <?php
                $data = "SELECT category_name from category";
                $response = $db->query($data);
                if($response)
                {
                   while($nav = $response->fetch_assoc())
                   {
                       echo "<a href='#' class='d-block py-2 text-capitalize'>".$nav['category_name']."</a>";
                   }
                }

            ?>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
            <h5 class="text-light">POLICIES</h5>
            <a href="privacy.php" class="d-block py-2">Privacy Policy</a>
            <a href="cookies.php" class="d-block py-2">Cookies Policy</a>
            <a href="terms.php" class="d-block py-2">Terms & Conditions</a>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <h5 class="text-light">CONTACTS</h5>
                <p class="text-light">VENUE : <?php echo $branding_data['address'];   ?></p>
                <p class="text-light">CALL : <?php echo $branding_data['phone'];   ?></p>
                <p class="text-light">EMAIL : <?php echo $branding_data['brand_email'];   ?></p>
                <p class="text-light">WEBSITE : <?php echo $branding_data['domain_name'];   ?></p>
            </div>
          </div>
        </div>

      </div>