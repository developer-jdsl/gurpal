<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_product','Add Product')?></h1>
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

									<?php echo form_open_multipart('admin/add_product'); ?>
									
										<div class="row">
											<div class="col-md-6">
											 <div class="form-group">
												<label><?=keyword_value('product_name','Product Name')?></label>
													<input type="text" name="product_name" class="form-control form-control-user" required>
												</div>
												 <div class="form-group">
												<label><?=keyword_value('product_sku','Product SKU')?></label>
													<input type="text" name="product_sku" class="form-control form-control-user" required>
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('product_description','Product Description')?></label>
											
													<textarea name="product_description" class="form-control form-control-user" required></textarea>
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('product_specifications','Product Specs')?></label>
												<textarea name="product_specifications" class="form-control form-control-user" required></textarea>
												</div>
												
												   <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
                              
                                        </div>
										
										 
										    <div class="form-group">
										<label><?=keyword_value('cod','COD')?></label>
										<select name="is_cod" class="form-control form-control-user">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
                              
                                        </div>
										
										
												<?php if($this->session->user_type=='admin') { ?>
												<input type="hidden" name="cid" value="<?=$this->session->pk_admin_id?>">
												<?php }else { ?>
												 <div class="form-group">
										<label><?=keyword_value('admin','ADMIN')?></label>
										<select name="cid" class="form-control form-control-user">
										<?php foreach($admins as $row) { ?>
										<option value="<?=$row['pk_admin_id']?>"><?=$row['admin_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
												
												<?php } ?> 
										 
										 
										 <?php if($this->session->user_type=='admin') { ?>
												 <div class="form-group">
										<label><?=keyword_value('cross_sell','Cross Sell')?></label>
										<select name="cross_sell" class="form-control form-control-user" multiple>
										<?php foreach($cross as $row) { ?>
										<option value="<?=$row['pk_product_id']?>"><?=$row['product_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
												
												<?php } ?> 
												
												
											</div>
											
										<div class="col-md-6">
										<div class="form-group">
										<label><?=keyword_value('category','Category')?></label>
										<select name="product_category" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($categories as $row) { ?>
										<option value="<?=$row['pk_category_id']?>"><?=$row['category_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										   <div class="form-group">
										<label><?=keyword_value('brand','Brand')?></label>
										<select name="product_brand" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($brands as $row) { ?>
										<option value="<?=$row['pk_brand_id']?>"><?=$row['brand_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('gst','GST')?></label>
										<select name="fk_gst_id" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($gst as $row) { ?>
										<option value="<?=$row['pk_gst_id']?>"><?=$row['gst_slab']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
												<label><?=keyword_value('meta_title','Meta Title')?></label>
													<input type="text" name="meta_title" class="form-control form-control-user" >
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
													<input type="text" name="meta_keyword" class="form-control form-control-user" >
												</div>
												
												
												 <div class="form-group">
												<label><?=keyword_value('meta_description','Meta Description')?></label>
											
													<textarea name="meta_description" class="form-control form-control-user"></textarea>
												</div>
												
												<div class="form-group">
												<label><?=keyword_value('ordering','Ordering')?></label>
													<input type="number" name="ordering" class="form-control form-control-user">
												</div>
												
												
												
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
	