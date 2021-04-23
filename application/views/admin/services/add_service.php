<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_service','Add Service')?></h1>
					<a href="<?=base_url('admin/services')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
					<?php if($msg=$this->session->flashdata('msg')){?>
						  <div class="alert alert-primary alert-dismissible fade show" role="alert">
						  <?=$msg?>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php } ?>
  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mc col-md-11">
                       
                        <div class="card-body">
                            <?php echo validation_errors();?>

									<?php echo form_open_multipart('admin/add_service'); ?>
									
										<div class="row">
											<div class="col-md-6">
											 <div class="form-group">
												<label><?=keyword_value('service_name','Service Name')?></label>
													<input type="text" name="service_name" class="form-control form-control-user" value="<?=set_value('service_name')?>" required>
												</div>
									
												
												 <div class="form-group">
												<label><?=keyword_value('service_description','Service Description')?></label>
											
													<textarea name="service_description" class="form-control form-control-user" required><?=set_value('service_description')?></textarea>
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('service_features','Service Features')?></label>
												<textarea name="service_features" class="form-control form-control-user" required><?=set_value('service_features')?></textarea>
												</div>
												
												   <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if(set_value('fk_gst_id')==1) { echo 'selected';} ?>>Active</option>
										<option value="0" <?php if(set_value('fk_gst_id')==0) { echo 'selected';} ?>>Inactive</option>
										</select>
                              
                                        </div>
										
										 
								
										
												<?php if($this->session->user_type=='admin') { ?>
												<input type="hidden" name="cid" value="<?=$this->session->pk_admin_id?>">
												<?php }else { ?>
												 <div class="form-group">
										<label><?=keyword_value('admin','ADMIN')?></label>
										<select name="cid" class="form-control form-control-user">
										<?php foreach($admins as $row) { ?>
										<option value="<?=$row['pk_admin_id']?>" <?php if(set_value('fk_admin_id')==$row['pk_admin_id']) { echo 'selected';} ?> ><?=$row['admin_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
												
												<?php } ?> 
										 
										 
								
												   <div class="form-group">
										<label><?=keyword_value('service_banner','Service Banner[2MB max(jpg,png,gif,jpeg)]')?></label>
										<input type="file" name="service_banner" class="form-control form-control-user" >
										
                                        </div>
												
												
											</div>
											
										<div class="col-md-6">
										
										<div class="form-group">
										<label><?=keyword_value('category','Category')?></label>
										<select name="service_category" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($categories as $row) { ?>
										<option value="<?=$row['pk_category_id']?>" <?php if(set_value('service_category')==$row['pk_category_id']) { echo 'selected';} ?>  ><?=$row['category_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('gst','GST')?></label>
										<select name="fk_gst_id" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($gst as $row) { ?>
										<option value="<?=$row['pk_gst_id']?>" <?php if(set_value('fk_gst_id')==$row['pk_gst_id']) { echo 'selected';} ?> ><?=$row['gst_slab']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
												<label><?=keyword_value('meta_title','Meta Title')?></label>
													<input type="text" name="meta_title" class="form-control form-control-user" value="<?=set_value('meta_title')?>"  >
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
													<input type="text" name="meta_keyword" class="form-control form-control-user" value="<?=set_value('meta_keyword')?>"  >
												</div>
												
												
												 <div class="form-group">
												<label><?=keyword_value('meta_description','Meta Description')?></label>
											
													<textarea name="meta_description" class="form-control form-control-user"><?=set_value('meta_description')?></textarea>
												</div>
												
												<div class="form-group">
												<label><?=keyword_value('ordering','Ordering')?></label>
													<input type="number" name="ordering" class="form-control form-control-user" value="<?=set_value('ordering')?>" >
												</div>
												
												
												
											</div>
											
											<div class="col-md-12">
											
											<h3><?=keyword_value('service_price_variation','Service Price variation')?></h3>
											
											
	 
									  <table class="table table-bordered"  width="100%">
									  <thead>
                                        <tr>
                               
                                            <th><?=keyword_value('service_variation','Variation')?></th>
                                            <th><?=keyword_value('service_subvariation','Sub Variation')?></th>
                                            <th><?=keyword_value('original_price','Original Price')?></th>
                                            <th><?=keyword_value('discount_price','Discount Price')?></th>

											<th><?=keyword_value('actions','Actions')?></th>
                                        </tr>
                                    </thead>
									<tbody>
										<tr>
											
											<td><input type="name" name="service_variation[]" class="form-control form-control-user" placeholder="Ex. Per Day"></td>
											<td><input type="name" name="service_subvariation[]" class="form-control form-control-user" placeholder="Ex. 1-4 Person "></td>
											<td><input type="number" name="original_price[]" class="form-control form-control-user" style="width:100px" min="0"  placeholder="Ex.2200"></td>
											<td><input type="number" name="discount_price[]" class="form-control form-control-user" style="width:100px"  min="0"  placeholder="Ex.1500"></td>
											<td><a href="javascript:void(0);"  class="btn btn-info btn-circle btn-sm add-service">
												<i class="fas fa-plus"></i>
											</a>
										 </td>
										</tr>
									</tbody>
                                    <tfoot>
                                         <tr>
                                            <th><?=keyword_value('service_variation','Variation')?></th>
                                            <th><?=keyword_value('service_subvariation','Sub Variation')?></th>
                                            <th><?=keyword_value('original_price','Original Price')?></th>
                                            <th><?=keyword_value('discount_price','Discount Price')?></th>
                                           
											<th><?=keyword_value('actions','Actions')?></th>
                                        </tr>
                                    </tfoot>
										</table>
											
											</div>
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
	