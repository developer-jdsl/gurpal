                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <ul class="nav nav-pills nav-stacked nav-arrow">
                            <li ><a href="<?=base_url('my-account')?>">Settings</a>
                            </li>
                            <li class="active"><a href="<?=base_url('my-addresses')?>">Address Book</a>
                            </li>
                            <li><a href="javascript:void(0);">Orders History</a>
                            </li>
                            <li><a href="javascript:void(0);">Wishlist</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
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
                                    <input type="checkbox" name="edit_is_default" class="i-check" />Set Primary</label>
                            </div>
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
                            <input type="submit" class="btn btn-primary" value="Add Address" />
                        </form>
                    </div>
                    <div class="row row-wrap">
					<?php if($addresses) { 
					foreach($addresses as $address) {
					?>
                        <div class="col-md-4">
                            <div class="address-box">
                                <a class="address-box-remove" href="javascript:void(0);" data-toggle="tooltip" data-placement="right" title="Remove"></a>
                                <a class="address-box-edit popup-text" href="#edit-address-dialog" data-effect="mfp-move-from-top" data-toggle="tooltip" data-placement="right"  data-zip="<?=$address['profile_zip']?>" data-default="<?=$address['is_default']?>" data-eid="<?=$address['pk_profile_id']?>" data-state="<?=$address['pk_state_id']?>" data-city="<?=$address['pk_city_id']?>" data-address="<?=$address['profile_address']?>" data-title="Edit"></a>
                                <ul>
                                    <li>Address: <?=$address['profile_address']?></li>
                                    <li>City: <?=$address['city_name']?></li>
                                    <li>State : <?=$address['state_name']?></li>
                                    <li>Zip/Postal: <?=$address['profile_zip']?></li>
                                </ul>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="i-radio" name="primaryAddressOption" <?php if($address['is_default']==1) { echo 'checked'; }?>/>Primary Address</label>
                                </div>
                            </div>
                        </div>

					<?php } } ?>                     
                        <div class="col-md-4">
                            <a class="address-box address-box-new popup-text" href="#add-address-dialog" data-effect="mfp-move-from-top">
                                <div class="vert-center"><i class="fa fa-plus address-box-new-icon"></i>
                                    <p>Add New Address</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="gap"></div>
                </div>