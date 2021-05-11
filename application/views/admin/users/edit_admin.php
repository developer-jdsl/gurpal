<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_admin','Edit Admin')?></h1>
					
					<a href="<?=base_url('admin/admins')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

								<?php echo form_open_multipart('admin/update_admin'); ?>
								
                                        <div class="form-group">
										<label><?=keyword_value('admin_name','Admin Name')?></label>
                                            <input type="text" name="admin_name" class="form-control form-control-user" value="<?=@$results['admin_name']?>" required>
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('admin_mobile','Admin Mobile')?></label>
                                            <input type="tel" name="admin_mobile" class="form-control form-control-user" value="<?=@$results['admin_mobile']?>" required>
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('admin_email','Admin Email')?></label>
                                            <input type="email" name="admin_email" class="form-control form-control-user" value="<?=@$results['admin_email']?>" required>
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('package','Packages')?></label>
										<select name="profile_package" class="form-control form-control-user">
										<?php foreach($packages as $single) { ?>
										<option value="<?=$single['pk_package_id']?>" <?php if($results['profile_package']==$single['pk_package_id']){ echo 'selected'; } ?> > <?=$single['package_name']?></option>
										<?php } ?>
										</select>
										</div>
										
										
										<?php $catarr=explode(',',@$results['profile_categories']) ?>
										<div class="form-group">
										<label><?=keyword_value('category','Category')?></label>
										<select name="profile_categories[]" class="form-control form-control-user select2" multiple>
				
										<?php foreach($cats as $row) { ?>
										<option value="<?=$row['pk_category_id']?>" <?php if(in_array($row['pk_category_id'],$catarr)) { echo 'selected';} ?> ><?=$row['category_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										<?php $cityarr=explode(',',$results['profile_cities']);?>
										<div class="form-group">
										<label><?=keyword_value('profile_cities','Visible Cities')?></label>
										<select name="profile_cities[]" class="form-control form-control-user select2" multiple>
							
										<?php foreach($cities as $row) { ?>
										<option value="<?=$row['pk_city_id']?>" <?php if(in_array($row['pk_city_id'],$cityarr)) { echo 'selected';} ?> ><?=$row['city_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										
										<?php $statearr=explode(',',$results['profile_states']);?>
										<div class="form-group">
										<label><?=keyword_value('profile_states','Visible States')?></label>
										<select name="profile_states[]" class="form-control form-control-user select2" multiple>
					
										<?php foreach($states as $row) { ?>
										<option value="<?=$row['pk_state_id']?>" <?php if(in_array($row['pk_state_id'],$statearr)) { echo 'selected';} ?> ><?=$row['state_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($results['active']==1){ echo 'selected'; } ?> >Active</option>
										<option value="0" <?php if($results['active']==0){ echo 'selected'; } ?> >Inactive</option>
										</select>
                              
                                        </div>
										<input type="hidden" name="id" value="<?=@$results['pk_admin_id']?>">
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
	