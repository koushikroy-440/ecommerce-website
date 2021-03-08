<?php
require("../../common-files/php/database.php");
$get_category_name = "SELECT * FROM category";
$response = $db->query($get_category_name);

echo '<div class="row slideInDown">
  		<div class="col-md-4 py-2 bg-white rounded-lg shadow-sm">
  			<h5 class="my-3">CREATE BRANDS<i class="fa fa-circle-o-notch fa-spin close brand-loader d-none" style="font-size:18px"></i></h5>
  			<form class="brand-form">
        

       <select class="form-control mb-3 brand-category" style="border:none;background:#f9f9f9">
        <option>Choose category</option>';
		if($response)
		{
			while($data = $response->fetch_assoc())
			{
				echo "<option>".$data["category_name"]."</option>";
			}
		}
		
       echo '</select>

  				<input type="text" class="form-control mb-3 brand-input" placeholder="Nokia" style="border:none;background:#f9f9f9">
				  <div class="brand-field-area">
				  
				  </div>
          			<button class="btn btn-primary mb-3 add-brand-btn" type="button"><i class="fa fa-plus"></i> Add fields</button>
          
  				<button class="btn btn-danger mb-3 create-brand-btn" type="submit">CREATE</button>
				  <div class="create-brand-notice"></div>
  			</form>
  		</div>
  		<div class="col-md-2">
  			
  		</div>
  		<div class="col-md-6 bg-white rounded-lg shadow-sm">
  			<h5 class="my-3">BRANDS LIST</h5>
  			<hr>
  		</div>
  	</div>';
    ?>