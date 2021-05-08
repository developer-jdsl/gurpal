<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_ad','Edit Ad')?></h1>
					
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

									<?php echo form_open_multipart('admin/update_ad'); ?>
									
										
										
                                        <div class="form-group">
										<label><?=keyword_value('ad_text','Advertisement Name')?></label>
                                            <input type="text" name="advertisement_text" class="form-control form-control-user" value="<?=$result['advertisement_text']?>" required>
                                        </div>
										
										<div class="form-group">
										<?php if($result['display_type']=='image'){?>
										<img src="<?=base_url('uploads/adverts/'.$result['advertisement_banner'])?>" width="320" >
										<?php }?>
										
										<?php if($result['display_type']=='video'){?>
												<video width="320" height="240" controls>
												  <source src="<?=base_url('uploads/adverts/'.$result['advertisement_banner'])?>" type="video/mp4">
												  Your browser does not support the video tag.
												</video>
										<?php }?>
										
										</div>
										<div class="form-group">
										<label><?=keyword_value('ad_media','Ad Media (Image or Video) 2MB MAX')?></label>
                                            <input type="file" accept="png,jpg,jpeg,gif,mp4,mkv,3gp" name="advertisement_banner" class="form-control form-control-user">
                                        </div>
										
										
											<div class="form-group">
										<label><?=keyword_value('ad_start','Ad Start Date')?></label>
                                            <input type="date"  name="start_time" class="form-control form-control-user" value="<?=date('Y-m-d',$result['start_time'])?>"required>
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('ad_end','Ad End Date')?></label>
                                            <input type="date"  name="end_time" class="form-control form-control-user" value="<?=date('Y-m-d',$result['end_time'])?>" required>
                                        </div>
											
										
										  <div class="form-group">
										<label><?=keyword_value('display_page','Display Page')?></label>
										<select name="display_page" class="form-control form-control-user">
										<option value="all" <?php if($result['display_page']=='all'){ echo 'selected';}?> >Every Page</option>
										<option value="home" <?php if($result['display_page']=='home'){ echo 'selected';}?> >Home</option>
										<option value="blog" <?php if($result['display_page']=='blog'){ echo 'selected';}?> >Blog</option>
										<option value="product_listing" <?php if($result['display_page']=='product_listing'){ echo 'selected';}?> >Product Listing</option>
										<option value="service_listing" <?php if($result['display_page']=='service_listing'){ echo 'selected';}?> >Service Listing</option>
										
										</select>
                              
                                        </div>
										
										  <div class="form-group">
										<label><?=keyword_value('display_section','Display Section')?></label>
										<select name="display_section" class="form-control form-control-user">
										<option value="all" <?php if($result['display_section']=='all'){ echo 'selected';}?> >EveryWhere</option>
										<option value="header" <?php if($result['display_section']=='header'){ echo 'selected';}?> >Header</option>
										<option value="after_header" <?php if($result['display_section']=='after_header'){ echo 'selected';}?> >After Header</option>
										<option value="left_sidebar" <?php if($result['display_section']=='left_sidebar'){ echo 'selected';}?> >Left Sidebar</option>
										<option value="right_sidebar" <?php if($result['display_section']=='right_sidebar'){ echo 'selected';}?> >Right Sidebar</option>
										<option value="before_footer" <?php if($result['display_section']=='before_footer'){ echo 'selected';}?> >Before Footer</option>
										<option value="footer" <?php if($result['display_section']=='footer'){ echo 'selected';}?> >Footer</option>
										
										</select>
                              
                                        </div>
										
										<?php  $city_arr=explode(',',$result['display_locations']);?>
										  <div class="form-group">
										<label><?=keyword_value('display_locations','Display Locations')?></label>
										<select name="display_locations[]" class="form-control select2 form-control-user" multiple>
										<option value="0">ALL</option>
										<?php foreach($cities as $city) { ?>
										<option value="<?=$city['pk_city_id']?>" <?php if(in_array($city['pk_city_id'],$city_arr)){ echo 'selected';}?> ><?=$city['city_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										
										<?php  $cat_arr=explode(',',$result['display_categories']);?>
										  <div class="form-group">
										<label><?=keyword_value('display_categories','Display Categories')?></label>
										<select name="display_categories[]" class="form-control select2 form-control-user" multiple>
										<option value="0">ALL</option>
										<?php foreach($cats as $cat) { ?>
										<option value="<?=$cat['pk_category_id']?>"  <?php if(in_array($cat['pk_category_id'],$cat_arr)){echo 'selected';}?>  ><?=$cat['category_name']?></option>
										<?php } ?>
										
										</select>
                              
                                        </div>
										
										
										 <div class="form-group">
										<label><?=keyword_value('fk_admin_id','Select Admin User')?></label>
										<select name="fk_admin_id" class="form-control select2 form-control-user" required>
										<option value="0">ALL</option>
										<?php foreach($admins as $admin) { ?>
										<option value="<?=$admin['pk_admin_id']?>" <?php if($admin['pk_admin_id']==$result['fk_admin_id']) {echo 'selected';} ?> ><?=$admin['admin_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										
										
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($result['active']==1) {echo 'checked'; } ?> >Active</option>
										<option value="0" <?php if($result['active']==0) {echo 'checked'; } ?> >Inactive</option>
										</select>
                              
                                        </div>
										
										 
                                  <input type="hidden" name="id" value="<?=$result['pk_advertisement_id']?>">
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
	