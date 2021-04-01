<?php
    require_once("../../common-files/php/database.php");
echo '

            <div class="row">
              <div class="col-md-4 p-4 bg-white rounded-lg shadow-sm">
                <form class="header-showcase-form" enctype="form-data/multipart">
                  <div class="form-group">
                    <label for="title-image">Title image<span> 200kb (1920*978)</span></label>
                    <input type="file" accept="image/*" class="form-control" name="title-image" id="title-image" required="required">
                  </div>
                  <div class="form-group">
                    <label for="title-text">Title text <span class="title-limit">0</span><span>/40</span></label>
                    <textarea class="form-control" rows="1" id="title-text" name="title-text" maxlength="40" required="required"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="subtitle-text">subtitle text <span class="subtitle-limit">0</span><span>/100</span></label>
                    <textarea class="form-control" rows="5" id="subtitle-text" name="subtitle-text" maxlength="100"  required="required"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="create-button">Create buttons</label>
                    <i class="fa fa-trash delete-btn close d-none"></i>
                    <div class="input-group mb-2" id="create-button">
                        <input type="url" name="btn-url" class="form-control btn-url" placeholder="https://google.com">

                        <input type="text" class="form-control btn-name" name="btn-name" placeholder="button-1">

                    </div>
                    <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">BG COLOR</span>
                          </div>
                          <input type="color" name="btn-bgcolor" class="form-control btn-bgcolor">
                          <div class="input-group-prepend">
                            <span class="input-group-text">TEXT COLOR</span>
                          </div>
                          <input type="color" name="btn-textcolor" class="form-control btn-textcolor">
                    </div>
                    <div class="input-group my-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text">SIZE</span>
                          </div>
                          <select class="form-control btn-size">
                              <option value="16px">small</option>
                              <option value="20px">medium</option>
                              <option value="24px">large</option>
                          </select>

                          <div class="input-group-append">
                              <span class="input-group-text bg-danger add-btn text-light" style="cursor:pointer;">Add</span>
                          </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary py-2 add-showcase-btn" type="submit">Add showcase</button>
                    <button class="btn btn-primary py-2 real-preview-btn" type="button">Real preview</button>
                  </div>
                  <div class="form-group">
                      <label for="edit-title">Edit title</label>
                      <i class="fa fa-trash delete-edit d-none close"></i>
                      <select class="form-control" id="edit-title">
                          <option>choose title</option>';
                          
                          ?>


                          <?php
$get_data = "SELECT * FROM header_showcase";
$response = $db->query($get_data);
$count = 0;
if ($response) {

    while ($data = $response->fetch_assoc()) {
        $count += 1;
        echo "<option value=" . $data['id'] . ">" . $count . "</option>";
    }
}
?>
<?php
echo '
                      </select>

                  </div>

                </form>
              </div>
              <div class="col-md-1"></div>
              <div class="col-md-7 p-4 bg-white rounded-lg shadow-sm position-relative showcase-preview d-flex" style="height:380px;">
                  <div class="title-box">
                  <h1 class="showcase-title target">TITLE</h1>
                  <h4 class="showcase-subtitle target">SUBTITLE</h4>
                  <div class="title-buttons my-3">


                  </div>
                </div>
                <div class="showcase-formating d-flex justify-content-around align-items-center">
                  <div class="btn-group">
                      <button class="btn btn-light">color</button>
                      <button class="btn btn-light">
                      <input type="color" class="color-selector" name="color-selector">
                      </button>
                  </div>

                  <div class="btn-group">
                      <button class="btn btn-light">Font size</button>
                      <button class="btn btn-light">
                      <input type="range" min="100" max="500"class="font-size" name="font-size">
                      </button>
                  </div>


                      <button class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                      <span>Alignment</span>

                        <div class="dropdown-menu">
                          <span class="dropdown-item alignment" align-position="h" align-value="flex-start">LEFT</span>
                          <span class="dropdown-item alignment" align-position="h" align-value="flex-end">RIGHT</span>
                          <span class="dropdown-item alignment" align-position="h" align-value="center">CENTER</span>
                          <span class="dropdown-item alignment" align-position="v" align-value="flex-start">TOP</span>
                          <span class="dropdown-item alignment" align-position="v" align-value="center">V-CENTER</span>
                          <span class="dropdown-item alignment" align-position="v" align-value="flex-end">BOTTOM</span>
                        </div>
                      </button>


                </div>
              </div>

            </div>
        ';
        ?>
