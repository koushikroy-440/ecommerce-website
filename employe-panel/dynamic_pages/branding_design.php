<?php
echo '
            <div class="row">
            <div class="col-md-2"></div>
              <div class="col-md-8 bg-white rounded">
                <form class="form-horizontal branding-form p-4">
                  <div class="form-group">
                    <label for="brand-name"><b>Enter brand name</b> <i class="fa fa-edit brand_edit" style="cursor:pointer"> Edit Brand details</i></label>
                    <input type="text" class="form-control brand-name" name="brand-name" id="brand-name">
                  </div>

                  <div class="form-group">
                    <label for="brand-logo"><b>upload brand logo</b></label>
                    <input type="file" class="form-control brand-logo" name="brand-logo" id="brand-logo">
                  </div>

                  <div class="form-group">
                    <label for="domain-name"><b>enter domain name</b></label>
                    <input type="text" class="form-control domain-name" name="domain-name" id="domain-name">
                  </div>

                  <div class="form-group">
                    <label for="brand-email"><b>email</b></label>
                    <input type="text" class="form-control brand-email" name="brand-email" id="brand-email">
                  </div>

                  <div class="form-group">
                    <label for="social-handles"><b>social handles</b></label>
                    <input type="text" class="form-control facebook" name="facebook" id="facebook">
                    <br>
                    <input type="text" class="form-control instagram" name="instagram" id="instagram">

                  </div>

                  <div class="form-group">
                    <label for="address"><b>address</b></label>
                    <textarea name="address" id="address" class="form-control address" maxlength="200" name="address" cols="10" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                    <label for="phone"><b>phone</b></label>
                    <input type="text" class="form-control phone" name="phone" id="phone">
                  </div>

                  <div class="form-group">
                    <label for="about-us"><b>about us </b><small class="about-us-count"> 0</small><small>/5000</small></label>
                    <textarea name="about-us" id="about-us" class="form-control about-us" name="about-us" cols="10" rows="8" maxlength="5000"></textarea>
                    </div>

                  <div class="form-group">
                    <label for="privacy-policy"><b>privacy-policy </b><small class="privacy-policy-count"> 0</small><small>/5000</small></label>
                    <textarea name="privacy-policy" id="privacy-policy" maxlength="5000" class="form-control privacy-policy" name="privacy-policy" cols="10" rows="8"></textarea>
                    </div>

                    <div class="form-group">
                    <label for="terms-conditions"><b>terms and conditions </b><small class="terms-conditions-count"> 0</small><small>/5000</small></label>
                    <textarea name="terms-conditions" id="terms-conditions" class="form-control terms-conditions" name="terms-conditions" cols="10" rows="8" maxlength="5000"></textarea>
                    </div>

                    <div class="form-group">
                    <label for="cookies"><b>cookies terms and conditions </b><small class="cookies-count"> 0</small><small>/5000</small></label>
                    <textarea name="cookies" id="cookies" class="form-control cookies" cols="10" rows="8" name="cookies" maxlength="5000"></textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">update</button>
                </form>


              </div>
              <div class="col-md-2"></div>
              </div>
              '
?>
