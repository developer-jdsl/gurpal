<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_brand','Add Advertisement')?></h1>
					
					<a href="<?=base_url('admin/ads')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
					<?php if($msg=$this->session->flashdata('msg')){?>
						  <div class="alert alert-primary alert-dismissible fade show" role="alert">
						  <?=$msg?>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php } ?>
  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mc col-md-6">
                       
                        <div class="card-body">
                            <?php echo validation_errors();?>

									<?php echo form_open_multipart('admin/add_ad'); ?>
									
										
										
                                        <div class="form-group">
										<label><?=keyword_value('ad_text','Advertisement Name')?></label>
                                            <input type="text" name="advertisement_text" class="form-control form-control-user" required>
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('ad_media','Ad Media (Image or Video) 2MB MAX')?></label>
                                            <input type="file" accept="png,jpg,jpeg,gif,mp4,mkv,3gp" name="advertisement_banner" class="form-control form-control-user">
                                        </div>
										
										
											<div class="form-group">
										<label><?=keyword_value('ad_start','Ad Start Date')?></label>
                                            <input type="date"  name="start_time" class="form-control form-control-user">
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('ad_end','Ad End Date')?></label>
                                            <input type="date"  name="end_time" class="form-control form-control-user">
                                        </div>
											
										
										  <div class="form-group">
										<label><?=keyword_value('display_page','Display Page')?></label>
										<select name="display_page" class="form-control form-control-user">
										<option value="all">Every Page</option>
										<option value="home">Home</option>
										<option value="blog">Blog</option>
										<option value="product_listing">Product Listing</option>
										<option value="service_listing">Service Listing</option>
										
										</select>
                              
                                        </div>
										
										  <div class="form-group">
										<label><?=keyword_value('display_section','Display Section')?></label>
										<select name="display_section" class="form-control form-control-user">
										<option value="all">EveryWhere</option>
										<option value="header">Header</option>
										<option value="after_header">After Header</option>
										<option value="left_sidebar">Left Sidebar</option>
										<option value="right_sidebar">Right Sidebar</option>
										<option value="before_footer">Before Footer</option>
										<option value="footer">Footer</option>
										
										</select>
                              
                                        </div>
										
										
										  <div class="form-group">
										<label><?=keyword_value('display_locations','Display Locations')?></label>
										<select name="display_locations" class="form-control select2 form-control-user" multiple>
										<option value="0">ALL</option>
										<?php foreach($cities as $city) { ?>
										<option value="<?=$city['pk_city_id']?>" ><?=$city['city_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										
										
										  <div class="form-group">
										<label><?=keyword_value('display_categories','Display Categories')?></label>
										<select name="display_categories" class="form-control select2 form-control-user" multiple>
										<option value="0">ALL</option>
										<?php foreach($cats as $cat) { ?>
										<option value="<?=$cat['pk_category_id']?>" ><?=$cat['category_name']?></option>
										<?php } ?>
										
										</select>
                              
                                        </div>
										
										
										 <div class="form-group">
										<label><?=keyword_value('fk_admin_id','Select Admin User')?></label>
										<select name="fk_admin_id" class="form-control select2 form-control-user" required>

										<?php foreach($admins as $admin) { ?>
										<option value="<?=$admin['pk_admin_id']?>" ><?=$admin['admin_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										
										
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
                              
                                        </div>
										
										 
                                  
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            <?=keyword_value('submit','Submit')?>
                                        </button>
                                    </form>
							
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
	