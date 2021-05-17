<br>
                    <div id="edit-address-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                    			<?php echo form_open_multipart('edit-address',array('id'=>'edit_address_form')); ?>
						     <div class="form-group">
                                <label>Address</label>
								<textarea name="edit_profile_address" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>State</label>
								<select name="edit_profile_state" class="form-control" required >
									<option value="">Select State</option>
								<?php foreach($states as $state) { ?>
							
								<option value="<?=$state['pk_state_id']?>"><?=$state['state_name']?></option>
								<?php } ?>
								</select>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                               <select name="edit_profile_city" class="form-control" required >
							   <option value="">Select City</option>
								<?php foreach($cities as $city) { ?>
								
								<option value="<?=$city['pk_city_id']?>" class="city_sel_li sel_li_<?=$city['fk_state_id']?>" ><?=$city['city_name']?></option>
								<?php } ?>
								</select>
                            </div>
                            <div class="form-group">
                                <label>Zip/Postal</label>
                                <input type="text" name="edit_profile_zip" class="form-control" required />
                            </div>
							<input type="hidden" name="edit_id">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="edit_is_default"  />Set Primary</label>
                            </div>
							<input type="hidden" name="ref_url" class="form-control" value="<?=current_url();?>" />
                            <input type="submit" class="btn btn-primary" value="Save Changes" />
                        </form>
                    </div>
                    <div id="add-address-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                   
						<?php echo form_open_multipart('add-address'); ?>
						     <div class="form-group">
                                <label>Address</label>
								<textarea name="add_profile_address" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>State</label>
								<select name="add_profile_state" class="form-control" required >
									<option value="">Select State</option>
								<?php foreach($states as $state) { ?>
							
								<option value="<?=$state['pk_state_id']?>"><?=$state['state_name']?></option>
								<?php } ?>
								</select>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                               <select name="add_profile_city" class="form-control" required >
							   <option value="">Select City</option>
								<?php foreach($cities as $city) { ?>
								
								<option value="<?=$city['pk_city_id']?>" class="city_sel_li sel_li_<?=$city['fk_state_id']?>" ><?=$city['city_name']?></option>
								<?php } ?>
								</select>
                            </div>
                            <div class="form-group">
                                <label>Zip/Postal</label>
                                <input type="text" name="add_profile_zip" class="form-control" required />
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="add_is_default" class="i-check" />Set Primary</label>
                            </div>
							<input type="hidden" name="ref_url" class="form-control" value="<?=current_url();?>" />
                            <input type="submit" class="btn btn-primary" value="Add Address" />
                        </form>
                    </div>
                    <!--  <section class="newsletter-alert">
               <div class="container text-center">
                  <div class="col-sm-12">
                     <div class="newsletter-form">
                        <h4 class="text-white"><i class="ti-email"></i>Sign up for our weekly email newsletter with the best money-saving coupons.</h4>
                        <div class="input-group">
                           <input type="text" class="form-control input-lg" placeholder="Email"> <span class="input-group-btn">
                           <button class="btn btn-danger btn-lg" type="button">
                           Subscribe
                           </button>
                           </span> 
                        </div>
                        <p><small class="text-white">We’ll never share your email address with a third-party.</small> </p>
                     </div>
                  </div>
               </div>
            </section> -->
            <!-- end:Newsletter signup -->
			
            <!-- Footer -->
            <footer id="footer">
               <div class="btmFooter">
                  <div class="container">
                     <!-- <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 text-center">
                           <ul class="list-inline list-unstyled">
                              <li><a href="#">Australia</a> </li>
                              <li><a href="#">North America</a> </li>
                              <li><a href="#">South America</a> </li>
                              <li><a href="#">India</a> </li>
                              <li><a href="#">Africa</a> </li>
                           </ul>
                        </div>
                     </div>
					 -->
					<div class="col-sm-12 text-center m-t-20">
                        <p> <strong>
                           Copyright 2021 © All Rights Reserved
                           </strong> 
                        </p>
                        <p>V4U</p>
                     </div>
                     <div class="col-sm-12 text-center m-t-30">
                        <ul class="pay-opt list-inline list-unstyled">
                           <li>
                              <a href="#" title="#"> <img src="<?=base_url('public/frontend/assets/images/payment/amz-icon.png')?>" class="img-responsive" alt=""> </a>
                           </li>
                           <li>
                              <a href="#" title="#"> <img src="<?=base_url('public/frontend/assets/images/payment/ax-icon.png')?>" class="img-responsive" alt=""> </a>
                           </li>
                           <li>
                              <a href="#" title="#"> <img src="<?=base_url('public/frontend/assets/images/payment/mb-icon.png')?>" class="img-responsive" alt=""> </a>
                           </li>
                           <li>
                              <a href="#" title="#"> <img src="<?=base_url('public/frontend/assets/images/payment/mst-icon.png')?>" class="img-responsive" alt=""> </a>
                           </li>
                           <li>
                              <a href="#" title="#"> <img src="<?=base_url('public/frontend/assets/images/payment/mstr-icon.png')?>" class="img-responsive" alt=""> </a>
                           </li>
                           <li>
                              <a href="#" title="#"> <img src="<?=base_url('public/frontend/assets/images/payment/paypal-icon.png')?>" class="img-responsive" alt=""> </a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </footer>
	
					<div class="loading" style="display:none;">
						<div class="content"><img src="<?php echo base_url('public/front/img/loading.gif'); ?>" width="100px"/></div>
					</div>
		
        <!-- //////////////////////////////////
	//////////////END MAIN  FOOTER///////// 
	////////////////////////////////////-->



        <!-- Scripts queries -->
        <script src="<?=base_url('public/front/js/jquery.js')?>"></script>
        <script src="<?=base_url('public/front/js/boostrap.min.js')?>"></script>
        <script src="<?=base_url('public/front/js/countdown.min.js')?>"></script>
        <script src="<?=base_url('public/front/js/flexnav.min.js')?>"></script>
        <script src="<?=base_url('public/front/js/magnific.js')?>"></script>
        <script src="<?=base_url('public/front/js/tweet.min.js')?>"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="<?=base_url('public/front/js/fitvids.min.js')?>"></script>
        <script src="<?=base_url('public/front/js/mail.min.js')?>"></script>
        <script src="<?=base_url('public/front/js/ionrangeslider.js')?>"></script>
        <script src="<?=base_url('public/front/js/icheck.js')?>"></script>
        <script src="<?=base_url('public/front/js/fotorama.js')?>"></script>
        <script src="<?=base_url('public/front/js/card-payment.js')?>"></script>
        <script src="<?=base_url('public/front/js/owl-carousel.js')?>"></script>
        <script src="<?=base_url('public/front/js/masonry.js')?>"></script>
        <script src="<?=base_url('public/front/js/nicescroll.js')?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Custom scripts -->
        <script src="<?=base_url('public/front/js/custom.js')?>"></script>
    </div>
</body>

</html>
