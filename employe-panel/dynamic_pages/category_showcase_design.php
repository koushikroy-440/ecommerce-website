      <?php
      require_once("../../common-files/php/database.php");
      echo ' <div class="row">';
      $dir = ['top-left', 'bottom-left', 'top-right', 'bottom-right'];
      $top_left_image = "../common-files/images/small_sample.jpg";
      $top_left_label = "";

      $bottom_left_image = "../common-files/images/small_sample.jpg";
      $bottom_left_label = "";

      $center_image = "../common-files/images/large_sample.jpg";
      $center_label = "";

      $top_right_image = "../common-files/images/small_sample.jpg";
      $top_right_label = "";

      $bottom_right_image = "../common-files/images/small_sample.jpg";
      $bottom_right_label = "";
      $i;
      for ($i = 0; $i < count($dir); $i++) {
        $get_data = "SELECT * FROM category_showcase WHERE direction = '$dir[$i]' ";
        $response = $db->query($get_data);
        if ($response) {
          $data = $response->fetch_assoc();
          if ($dir[$i] == 'top-left') {
            if($response->num_rows != 0) {
              $top_left_image = "data:image/png;base64," . base64_encode($data['image']);
              $top_left_label = $data['label'];
            }
          }
           else if ($dir[$i] == 'bottom-left') {
            if($response->num_rows != 0) {

            $bottom_left_image = "data:image/png;base64," . base64_encode($data['image']);
            $bottom_left_label = $data['label'];
            }
 
          }
           else if ($dir[$i] == 'center') {
            if($response->num_rows != 0) {

            $center_image = "data:image/png;base64," . base64_encode($data['image']);
            $center_label = $data['label'];
            }
          } 
          else if ($dir[$i] == 'top-right') {
            if($response->num_rows != 0) {

            $top_right_image = "data:image/png;base64," . base64_encode($data['image']);
            $top_right_label = $data['label'];
            }
          }
           else if ($dir[$i] == 'bottom-right') {
            if($response->num_rows != 0) {
            $bottom_right_image = "data:image/png;base64," . base64_encode($data['image']);
            $bottom_right_label = $data['label'];
            }
          }
        }
      }
      ?>
      <?php echo '
      <div class="col-md-4">
        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0" >
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="';?><?php echo $top_left_label ?> <?php echo '">
            </button>
            <button class="btn btn-dark set-btn" img_dir="top-left" disabled="disabled">
              SET
            </button>
          </div>
          <img src= " ';?><?php echo $top_left_image ?> <?php echo '" alt="small sample" class="w-100 mb-3">
        </div>


        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0" >
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="';?><?php echo $bottom_left_label ?> <?php echo ' ">
            </button>
            <button class="btn btn-dark set-btn" img_dir="bottom-left" disabled="disabled">
              SET
            </button>
          </div>
          <img src="';?><?php echo $bottom_left_image ?> <?php echo ' " alt="small sample" class="w-100 mb-3">
        </div>

      </div>
      <div class="col-md-4">
        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0">
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value="';?> <?php echo $center_label ?> <?php echo ' ">
            </button>
            <button class="btn btn-dark set-btn" img_dir="center" disabled="disabled">
              SET
            </button>
          </div>
          <img src="';?> <?php echo $center_image ?> <?php echo ' " alt="large sample" class="w-100 mb-3">
        </div>
      </div>


      <div class="col-md-4">

        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0">
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value=" ';?><?php echo $top_right_label ?> <?php echo '">
            </button>
            <button class="btn btn-dark set-btn" img_dir="top-right" disabled="disabled">
              SET
            </button>
          </div>
          <img src="';?> <?php echo $top_right_image ?> <?php echo ' " alt="small sample" class="w-100 mb-3">
        </div>

        <div class="position-relative">
          <div class="btn-group border shadow-sm position-absolute" style="width: 100%;z-index:100">
            <button class="btn btn-dark">
              <input type="file" accept="image/*" class="upload-icon position-absolute form-control" style="width: 100%;height:100%;border:1px solid red;top:0;left:0;opacity:0">
              <i class="fa fa-upload" aria-hidden="true"> </i>
            </button>
            <button class="btn">
              <input type="text" class="from-control upload-label" placeholder="Mobile" value=" ';?><?php echo $bottom_right_label ?> <?php echo '">
            </button>
            <button class="btn btn-dark set-btn" img_dir="bottom-right" disabled="disabled">
              SET
            </button>
          </div>
          <img src=" ';?><?php echo $bottom_right_image ?> <?php echo '" alt="small sample" class="w-100 mb-3">
        </div>

      </div>
    </div>';
    ?>
