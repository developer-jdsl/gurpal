                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <ul class="nav nav-pills nav-stacked nav-arrow">
                            <li class="active"><a href="<?=base_url('my-account')?>">Settings</a>
                            </li>
                            <li><a href="<?=base_url('my-addresses')?>">Address Book</a>
                            </li>
                            <li><a href="<?=base_url('my-orders')?>">Orders History</a>
                            </li>
                            <li><a href="<?=base_url('my-wishlist')?>">Wishlist</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
				<div class="row">
				<div class="col-md-12">

					<?php if(@$msg){?>
						 
						 <p> <?=$msg?> </p>
					
					<?php } ?>
					
					      <?php echo '<p>'.validation_errors().'</p>';?>
				
				
				</div>
				</div>
                    <div class="row">
						<?php echo form_open_multipart('my-account'); ?>
                        <div class="col-md-6">
                        
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" name="user_firstname" value="<?=$profile['user_firstname']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" name="user_lastname" value="<?=$profile['user_lastname']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="email" name="user_email" value="<?=$profile['user_email']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="tel"  name="user_phone" value="<?=$profile['user_phone']?>" class="form-control">
                                </div>
                                <input type="submit" value="Save Changes" class="btn btn-primary">
                           
                        </div>
						 <div class="col-md-6">
						  <div class="form-group">
						  <?php if($profile['user_image']){ ?>
						  <img src="<?=base_url('uploads/users/'.$profile['user_image'])?>" width="100%">
						  <?php } ?>
                                    <label for="">Profile Photo</label>
                                    <input type="file" name="user_image" aceept="image/*" class="form-control">
                                </div>
						 </div>
						  </form>
                    </div>
			
                    <div class="gap"></div>
                </div>
				</div>
				</div>