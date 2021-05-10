<div class="col-md-4">
                    <aside class="sidebar-left">
                        <div class="box clearfix">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
						$tflag=$flag=$subt=$gst=0;foreach($cart as $row) { ?>
                                    <tr>
                                        <td><?=$row['item_name']?> <?php if($row['item_cod']==0) { echo '(COD not available)';$flag=1;}?></td>
                                        <td><?=$row['item_qty']?></td>
                                        <td>₹<?=$row['item_price']*$row['item_qty']?></td>
                                    </tr>
									
						<?php $subt=$subt+($row['item_price']*$row['item_qty']);
							  $gst=$gst+($row['item_gstvalue']*$row['item_qty']); } ?>
                                
                                </tbody>
                            </table>
                            <ul class="cart-total-list text-center mb0">
                                <li><span>Sub Total</span><span>₹<?=$subt?></span>
                                </li>
                                <li><span>Shipping</span><span>₹0.00</span>
                                </li>
                                <li><span>Taxes</span><span>₹<?=$gst?></span>
                                </li>
                                <li><span>Total</span><span>₹<?=$gst+$subt?></span>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-md-8">
				<?php if(!$this->session->front_user_id) { ?>
                    <p class="mb20"><a class="popup-text" href="#login-dialog" data-effect="mfp-move-from-top">Login</a> or <a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top">Register</a> for faster payment.</p>
                    <div class="row">
					
                        <div class="col-md-12">
                            <h3>Checkout</h3>
                            	<?php echo form_open_multipart('checkout'); ?>
                                <!-- <legend>Personal Information</legend> -->
								<div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="user_firstname" required>
                                </div>
								 <div class="col-md-6 form-group">
                                    <label for="">Last  Name</label>
                                    <input type="text" class="form-control" name="user_lastname" required>
                                </div>
								</div>
								<div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Phone Number</label>
                                    <input type="tel" class="form-control" name="user_phone" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">E-mail</label>
                                    <input type="name" class="form-control" name="user_email" required>
                                </div>
								</div>
                                <legend>Address</legend>
								  <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="profile_address" required></textarea>
                                </div>
								<div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">State</label>
                                 
								<select name="profile_state" id="profile_state" class="form-control" required >
									<option value="">Select State</option>
								<?php foreach($states as $state) { ?>
							
								<option value="<?=$state['pk_state_id']?>"><?=$state['state_name']?></option>
								<?php } ?>
								</select>
                         
									
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">City</label>
                                   <select name="profile_city" class="form-control" required >
							   <option value="">Select City</option>
								<?php foreach($cities as $city) { ?>
								
								<option value="<?=$city['pk_city_id']?>" class="city_sel_li sel_li_<?=$city['fk_state_id']?>" ><?=$city['city_name']?></option>
								<?php } ?>
								</select>
                                </div>
                              
                                <div class="col-md-4 form-group">
                                    <label for="">ZIP/Postal Code</label>
                                    <input type="text" class="form-control" name="profile_zip" required>
                                </div>
								</div>
								<?php if($payment_methods) { ?> 
								<legend>Payment</legend>
								
								<?php
								foreach($payment_methods as $method) {
									if($method['payment_id']=='cod' && $flag==0) {
									?>
								<input type="radio" name="pg" value="<?=$method['pk_payment_id']?>" required>
									  <label for=""><?=$method['payment_name']?></label>
									  <p><?=$method['payment_description']?></p>
								<?php } else {
									$tflag=1;
									echo '<label>COD not available since some item in the cart doesn\'t supports it</label>';
								}
								} if(!$tflag) {?>
								<br>
                                <input type="submit" class="btn btn-primary" value="Proceed Payment">
								<?php } } else { ?>
								<br>
								<h3>No Payment method found.Please try after sometime</h3>
								<?php } ?>
                            </form>
                        </div>
                   </div>
					<?php } else { ?>
					
					
					<?php } ?>
					
                    
                </div>
 <div class="gap"></div>
 </div>
 </div>