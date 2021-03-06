<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_service','Edit Service')?></h1>
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

									<?php echo form_open_multipart('admin/update_service'); ?>
									
										<div class="row">
											<div class="col-md-6">
											 <div class="form-group">
												<label><?=keyword_value('service_name','Service Name')?></label>
													<input type="text" name="service_name" class="form-control form-control-user" value="<?=@$results['service_name']?>" required>
												</div>
									
												
												 <div class="form-group">
												<label><?=keyword_value('service_description','Service Description')?></label>
											
													<textarea name="service_description" class="form-control form-control-user" required><?=@$results['service_description']?></textarea>
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('service_features','Service Features')?></label>
												<textarea name="service_features" class="form-control form-control-user" ><?=@$results['service_features']?></textarea>
												</div>
												
												   <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($results['active']==1) { echo 'selected';} ?> >Active</option>
										<option value="0" <?php if($results['active']==0) { echo 'selected';} ?> >Inactive</option>
										</select>
                              
                                        </div>
										
										 
								
										
												<?php if($this->session->user_type=='admin') { ?>
												<input type="hidden" name="cid" value="<?=$this->session->pk_admin_id?>">
												<?php }else { ?>
												 <div class="form-group">
										<label><?=keyword_value('admin','ADMIN')?></label>
										<select name="cid" class="form-control form-control-user">
										<?php foreach($admins as $row) { ?>
										<option value="<?=$row['pk_admin_id']?>" <?php if($results['fk_admin_id']==$row['pk_admin_id']) { echo 'selected';} ?> ><?=$row['admin_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
												
												<?php } ?> 
										 
										 
								
												   <div class="form-group">
												<?php if($results['service_banners']){ ?>
												<img src="<?=base_url('uploads/service/'.$results['service_banners'])?>" style="width:100%">
												<?php } ?>
										<label><?=keyword_value('service_banner','Service Banner[2MB max(jpg,png,gif,jpeg)]')?></label>
										<input type="file" name="service_banner" class="form-control form-control-user" >
										
                                        </div>
												
												
											</div>
											
										<div class="col-md-6">
										
										
										
										<div class="form-group">
										<label><?=keyword_value('category','Category')?></label>
										<select name="service_category" class="form-control form-control-user" required>
										<option value=""></option>
										<?php foreach($categories as $row) { ?>
										<option value="<?=$row['pk_category_id']?>" <?php if($results['service_category']==$row['pk_category_id']) { echo 'selected';} ?> ><?=$row['category_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('gst','GST')?></label>
										<select name="fk_gst_id" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($gst as $row) { ?>
										<option value="<?=$row['pk_gst_id']?>" <?php if($results['fk_gst_id']==$row['pk_gst_id']) { echo 'selected';} ?> ><?=$row['gst_slab']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										<div class="form-group">
												<label><?=keyword_value('service_slug','Service Slug')?></label>
													<input type="text" name="service_slug" class="form-control form-control-user" value="<?=@$results['service_slug']?> ">
												</div>
										
										 <div class="form-group">
												<label><?=keyword_value('meta_title','Meta Title')?></label>
													<input type="text" name="meta_title" class="form-control form-control-user"  value="<?=@$results['meta_title']?>" >
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
													<input type="text" name="meta_keyword" class="form-control form-control-user" value="<?=@$results['meta_keywords']?> ">
												</div>
												
												
												 <div class="form-group">
												<label><?=keyword_value('meta_description','Meta Description')?></label>
											
													<textarea name="meta_description" class="form-control form-control-user"><?=@$results['meta_description']?></textarea>
												</div>
												
												
												
												<div class="form-group">
												<label><?=keyword_value('ordering','Ordering')?></label>
													<input type="number" name="ordering" class="form-control form-control-user" value="<?=@$results['ordering']?>">
												</div>
												
												
												
											</div>
											
											
											<div class="col-md-12">
											<h3><?=keyword_value('service_price_variation','Service Price variation')?></h3>
											<?php if($pricing) { ?>
	 <table class="table table-bordered"  width="100%">
	  <thead>
                                        <tr>
                                            <th><?=keyword_value('variation','Variation')?></th>
                                            <th><?=keyword_value('subvariation','Sub Variation')?></th>
                                            <th><?=keyword_value('original_price','Original Price')?></th>
                                            <th><?=keyword_value('discount_price','Discount Price')?></th>
											<th><?=keyword_value('make_default','Make Default')?></th>
											<th><?=keyword_value('actions','Actions')?></th>
                                        </tr>
                                    </thead>
									
									<tbody>
									<?php foreach($pricing as $row) { ?>
										<tr data-id="<?=$row['pk_pricing_id']?>">
											<td>
											<input type="name" class="form-control form-control-user update_service_fields" data-id="<?=$row['pk_pricing_id']?>" data-table="service_pricing" data-cname="Variation" data-column="service_variation" value="<?=$row['service_variation']?>">
							
											</td>
											<td>
											<input type="name"  class="form-control form-control-user update_service_fields" data-id="<?=$row['pk_pricing_id']?>" data-table="service_pricing" data-cname="Subvariation" data-column="service_subvariation" value="<?=$row['service_subvariation']?>">
											</td>
											<td>
											<input type="number"  class="form-control form-control-user update_service_fields" value="<?=$row['original_price']?>"  data-cname="Original Price"  data-id="<?=$row['pk_pricing_id']?>" data-table="service_pricing" data-column="original_price" style="width:100px" min="0">
											</td>
											<td>
											<input type="number"  class="form-control form-control-user update_service_fields" value="<?=$row['discount_price']?>"  data-cname="Discount Price" data-id="<?=$row['pk_pricing_id']?>" data-table="service_pricing" data-column="discount_price" style="width:100px"  min="0">
											</td>
											
											<td>
											<input type="radio"  name="service_radio" class="form-control form-control-user update_default_service" value="<?=$row['pk_pricing_id']?>"  data-table="service_pricing" data-column="is_default" style="width:20px" <?php if($row['is_default']==1){ echo 'checked';} ?>>
											</td>
											<td>
											<a href="javascript:void(0);" data-id="<?=$row['pk_pricing_id']?>" data-flag="<?=$row['is_default']?>" class="btn btn-danger btn-circle btn-sm remove_pricing_ajax">
												<i class="fas fa-trash"></i>
											</a>
											</td>
										</tr>
										
									<?php } ?>
									</tbody>
                                    <tfoot>
                                          <tr>
                                            <th><?=keyword_value('variation','Variation')?></th>
                                            <th><?=keyword_value('subvariation','Sub Variation')?></th>
                                            <th><?=keyword_value('original_price','Original Price')?></th>
                                            <th><?=keyword_value('discount_price','Discount Price')?></th>
                    
											<th><?=keyword_value('make_default','Make Default')?></th>
											<th><?=keyword_value('actions','Actions')?></th>
                                        </tr>
                                    </tfoot>
	 </table>
	 <?php } ?>
	 
											
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
											
											<td><input type="name" name="service_variation[]" class="form-control form-control-user"></td>
											<td><input type="name" name="service_subvariation[]" class="form-control form-control-user"></td>
											<td><input type="number" name="original_price[]" class="form-control form-control-user" style="width:100px" min="0"></td>
											<td><input type="number" name="discount_price[]" class="form-control form-control-user" style="width:100px"  min="0"></td>
											
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
										
										
										
										<input type="hidden" name="id" value="<?=$results['pk_service_id']?>" >
                                
                                  
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
	