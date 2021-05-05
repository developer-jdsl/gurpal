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
                        <form>
                            <div class="form-group">
                                <label>Country</label>
                                <input value="USA" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input value="San Francisco, CA" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input value="1355 Market St, Suite 900" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Zip/Postal</label>
                                <input value="94103" type="text" class="form-control" />
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="i-check" />Set Primary</label>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Save Changes" />
                        </form>
                    </div>
                    <div id="add-address-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <form>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Zip/Postal</label>
                                <input type="text" class="form-control" />
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked class="i-check" />Set Primary</label>
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
                                <a class="address-box-remove" href="#" data-toggle="tooltip" data-placement="right" title="Remove"></a>
                                <a class="address-box-edit popup-text" href="#edit-address-dialog" data-effect="mfp-move-from-top" data-toggle="tooltip" data-placement="right" title="Edit"></a>
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