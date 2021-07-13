<?php
require_once "../../common-files/php/database.php";
echo '<div class="row slideInDown">
		<div class="col-md-12 py-2 bg-white rounded-lg shadow-sm">
			<h5 class="my-3">CREATE PRODUCTS</h5>
			<form class="create-product-form" action="dynamic_pages/d.php" method="post" enctype="multipart/form-data>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="product-title">PRODUCTS TITLE</label>
							<input type="text" class="form-control mb-3" name="title" placeholder="ENTER PRODUCT TITLE" required="required" id="product-title">
						</div>
					</div>
					<div class="col-md-3">

					</div>
					<div class="col-md-3 mb-3">
						<select class="form-control brands-name" name="brands" placeholder="choose brands" required="required">
							<option>Choose brands</option>';
$get_data = "SELECT * FROM brands";
$response = $db->query($get_data);
if ($response) {
    while ($data = $response->fetch_assoc()) {
        echo "<option c-name =".$data['category_name'].">" . $data['brands'] . "</option>";
    }
}
echo '</select>
					</div>
					<div class="col-md-12">
						<textarea class="form-control mb-3" rows="6" name="product-description" placeholder="product-description" required="required"></textarea>
					</div>
					<div class="col-md-5">
						<div class="from-group">
							<label for="product-price">Product Price</label>
							<input class="form-control mb-3" name="price" placeholder="500" required="required" id="product-price"></input>
						</div>
					</div>
					<div class="col-md-2"></div>
					<div class="col-md-5">
						<label for="product-quantity">Product Quantity</label>
						<input class="form-control mb-3" name="quantity" placeholder="20" required="required" id="product-quantity"></input>
					</div>

					<div class="row">
					<div class="col-md-12 d-flex justify-content-around mb-4">

						<div style="width:100px;height:100px;border:1px solid red;overflow:hidden">
							<label for="thumb">THUMB</label>
							<input type="file" accept="image/*" id="thumb" name="thumb" style="width:100%;height:100%;">
							
						</div>
						<div style="width:100px;height:100px;border:1px solid red;overflow:hidden">
							<label for="front">FRONT</label>
							<input type="file" accept="image/*" id="front" name="front" style="width:100%;height:100%;">
						</div>
						<div style="width:100px;height:100px;border:1px solid red;overflow:hidden">
							<label for="top">BACK</label>
							<input type="file" accept="image/*" id="top" name="back" style="width:100%;height:100%;">
						</div>
						
						<div style="width:100px;height:100px;border:1px solid red;overflow:hidden">
							<label for="left">LEFT</label>
							<input type="file" accept="image/*" id="left" name="left" style="width:100%;height:100%;">
						</div>
						<div style="width:100px;height:100px;border:1px solid red;overflow:hidden">
							<label for="right">RIGHT</label>
							<input type="file" accept="image/*" id="right" name="right" style="width:100%;height:100%;">
						</div>
					</div
					</div>

				</div>
				<div class="row">
						<div class="col-md-9 mt-3">
							<div class="progress create-products-progress d-none">
								<div class="progress-bar">25%</div>
					  		</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-2">
							<button type="submit" name="submit-btn" class="btn btn-lg btn-outline-primary">SUBMIT</button>
						</div>
					</div>


			</form>

		</div>

</div>'

?>
