<?php
echo '<div class="row slideInDown">
		<div class="col-md-12 py-2 bg-white rounded-lg shadow-sm">
			<h5 class="my-3">CREATE PRODUCTS</h5>
			<form action="dynamic_pages/d.php" method="post" enctype="multipart/form-data>
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
						<select class="form-control" name="brands" placeholder="choose brands" required="required">
							<option>Choose brands</option>';
							
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
						<div class="col-md-9 mt-3">
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
					  		</div>
						</div>
						<div class="col-md-1"></div>
						<div class="col-md-2">
							<button type="submit" name="submit-btn" class="btn btn-lg btn-outline-primary">SUBMIT</button>
						</div>
					</div>
				</div>
				
		
			</form>
				
		</div>

</div>'

?>