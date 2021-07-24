<?php
require_once("../../common-files/php/database.php");

?>
<?php echo '
<div class="row">
<div class="col-md-6">
  <div class="jumbotron bg-white py-3">
    <h4>KEYWORD PLANNER FOR CATEGORY</h4>
    <form class="keyword-form">
        <div class="form-group">
          <label for="p-keyword" >Primary Keyword</label>
          <select class="form-control p-keyword" id="p-keyword" name="p-keyword" name="p-keyword">
            <option value="">CHOOSE PRIMARY KEYWORD</option>';?>
            <?php
              $get_data = "SELECT * FROM category";
              $response = $db->query($get_data);
              if($response)
              {
                while($data = $response->fetch_assoc())
                {
                    echo "<option>".$data['category_name']."</option>";
                }
              }
            ?>
            <?php echo'
          </select>
        </div>

        <div class="form-group">
          <label for="s-keyword" >Secondary keyword</label>
          <textarea class="form-control s-keyword" required name="s-keyword" id="s-keyword" rows="5" ></textarea>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">submit</button>
        </div>

    </form>
  </div>
</div>
<div class="col-md-6">
  <div class="jumbotron bg-white py-3">
    <div class="d-flex">
    <h4>FAILED KEYWORD : &nbsp</h4>
    <h5 class="text-white bg-danger px-2 rounded-sm">';?>
      <?php
          $get_data = "SELECT * FROM failed_keyword";
          $count = 0;
          $all_data = [];
          $response = $db->query($get_data);
          if($response)
          {
              while($data = $response->fetch_assoc()){
                array_push($all_data, $data['keyword']);
                $count++;
              }
              echo $count;
          }
          else{
            echo "0";
          }
      ?>
      <?php echo'
    </h5>
    </div>
    <div class="form-control my-3 d-flex flex-wrap h-auto failed-keyword">';?>
          <?php
            for($i=0;$i<count($all_data);$i++)
            {
              echo "<div class='alert alert-danger tags'>".$all_data[$i]."&nbsp; <i class='fa fa-times-circle' data-dismiss='alert'></i></div>";
            }
          ?>
          <?php echo'
    </div>
    <div class="btn-vertical">
    <button class="btn btn-primary copy-btn mb-3 w-100">COPY TO CATEGORY CLIP BOARD</button>
    <button class="btn btn-primary copy-btn-brands mb-3 w-100">COPY TO BRANDS CLIP BOARD</button>
    <button class="btn btn-danger delete-keyword w-100">DELETE UPDATED KEYWORD</button>

    </div>
  </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
  <div class="jumbotron bg-white py-3">
    <h4>KEYWORD PLANNER FOR BRANDS</h4>
    <form class="brand-form">
      <div class="form-group">
        <label>category</label>
        <select class="form-control brands-category" id>
          <option>Choose</option>';?>
          <?php
              $get_data = "SELECT * FROM category";
              $response = $db->query($get_data);
              if($response)
              {
                while($data = $response->fetch_assoc())
                {
                    echo "<option>".$data['category_name']."</option>";
                }
              }
            ?>
            <?php echo '
        </select>
      </div>

      <div class="form-group">
        <label for="brands-p-keyword">Primary key</label>
        <select class="form-control" id="brands-p-keyword" name="p-keyword">
          <option>Choose primary key</option>
        </select>
      </div>
      
        <div class="form-group">
          <label for="brands-s-keyword" >Secondary keyword</label>
          <textarea class="form-control brands-s-keyword" required name="s-keyword" id="brands-s-keyword" rows="5" ></textarea>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">submit</button>
        </div>


    </form>
  </div>
</div>
</div>';?>

