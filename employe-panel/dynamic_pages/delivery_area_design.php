<?php
require_once("../../common-files/php/database.php");
echo '<div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="jumbotron bg-white py-3">
          <h4 class="mb-3">SET DELIVERY LOCATION</h4>
          <form class="set_area_form">
            <select class="form-control mb-3 country" name="country">
              <option value="">Choose country</option>';
              ?>
              <?php
              $get_data = "SELECT * FROM countries";
              $response = $db->query($get_data);
              if ($response) {
                while ($data = $response->fetch_assoc()) {
                  echo "<option country_id=" . $data['id'] . ">" . $data['name'] . "</option>";
                }
              }
              ?>
              <?php echo'
            </select>
            <select class="form-control mb-3 state" name="state">
              <option>Choose state</option>
            </select>
            <select name="city" class="form-control mb-3 city">
              <option>Choose city</option>
            </select>
            <input type="number" class="form-control mb-3 pin_code" name="pin_code" placeholder="PinCode" required>
            <input type="text" class="form-control mb-3 delivery_time" name="delivery_time" placeholder="Delivery in 5 to 10 days" required>
            <select class="form-control mb-3 payment" name="payment-mode" required>
              <option>Choose payment mode</option>
              <option value="all">all</option>
              <option value="online">Online</option>
            </select>
            <button class="btn btn-success set_area_btn">SET AREA</button>
          </form>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>';
    ?>