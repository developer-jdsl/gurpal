<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_product','Edit Product')?></h1>
					<a href="<?=base_url('admin/products')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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
                            <p align="center"><?php echo validation_errors();?></p>
							
							<ul class="nav nav-tabs">
  <li class="nav-item "><a class="nav-link" id="pro_basic" <?php if(@$galleryf==false){echo 'active';} ?>" data-toggle="tab" href="#details"><?=keyword_value('details','Details')?></a></li>
<li class="nav-item" ><a data-toggle="tab" id="pro_gallery" class="nav-link <?php if(@$galleryf==true){echo 'active';} ?>" href="#gallery"><?=keyword_value('gallery','Gallery')?></a></li>
</ul>
<?php echo form_open_multipart('admin/update_product'); ?>
<div class="tab-content">
  <div id="details" class="container tab-pane  <?php if(@$galleryf==true){echo 'fade';} else {echo 'active';} ?>">
  <br>
    									
										<div class="row">
											<div class="col-md-6">
											 <div class="form-group">
												<label><?=keyword_value('product_name','Product Name')?></label>
													<input type="text" name="product_name" class="form-control form-control-user" value="<?=$results['product_name']?>" required>
												</div>
												 <div class="form-group">
												<label><?=keyword_value('product_sku','Product SKU')?></label>
													<input type="text" name="product_sku" class="form-control form-control-user" value="<?=$results['product_sku']?>" required ">
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('product_description','Product Description')?></label>
											
													<textarea name="product_description" class="form-control form-control-user" required><?=$results['product_description']?></textarea>
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('product_specifications','Product Specs')?></label>
												<textarea name="product_specifications" class="form-control form-control-user" ><?=$results['product_specifications']?></textarea>
												</div>
												
												   <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($results['active']==1) { echo 'selected'; } ?> >Active</option>
										<option value="0" <?php if($results['active']==0) { echo 'selected'; } ?> >Inactive</option>
										</select>
                              
                                        </div>
										
										 
										    <div class="form-group">
										<label><?=keyword_value('cod','COD')?></label>
										<select name="is_cod" class="form-control form-control-user">
										<option value="1" <?php if($results['is_cod']==1) { echo 'selected'; } ?> >Active</option>
										<option value="0" <?php if($results['is_cod']==0) { echo 'selected'; } ?> >Inactive</option>
										</select>
                              
                                        </div>
										
										
												<?php if($this->session->user_type=='admin') { ?>
												<input type="hidden" name="cid" value="<?=$this->session->pk_admin_id?>">
												<?php }else { ?>
												 <div class="form-group">
										<label><?=keyword_value('admin','ADMIN')?></label>
										<select name="cid" class="form-control form-control-user">
										<?php if(@$admins) {
											foreach($admins as $row) { ?>
										<option value="<?=$row['pk_admin_id']?>"  <?php if($results['fk_admin_id']==$row['pk_admin_id']) { echo 'selected'; } ?> ><?=$row['admin_name']?></option>
										<?php } } ?>
										</select>
                              
                                        </div>
												
												<?php } ?> 
										 
										 
										 <?php if($this->session->user_type=='admin') { 
										 $arrr=explode(',',$results['cross_sell']);
										 
										 ?>
												 <div class="form-group">
										<label><?=keyword_value('cross_sell','Cross Sell')?></label>
										<select name="cross_sell" class="form-control form-control-user select2" multiple>
										<?php if(@$cross) { 
										foreach($cross as $row) { ?>
										<option value="<?=$row['pk_product_id']?>" <?php if(in_array($row['pk_product_id'],$arrr)) { echo 'selected'; } ?> ><?=$row['product_name']?></option>
										<?php } } ?>
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
										<option value="<?=$row['pk_category_id']?>" <?php if($results['product_category']==$row['pk_category_id']) { echo 'selected'; } ?> ><?=$row['category_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										   <div class="form-group">
										<label><?=keyword_value('brand','Brand')?></label>
										<select name="product_brand" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($brands as $row) { ?>
										<option value="<?=$row['pk_brand_id']?>" <?php if($results['product_brand']==$row['pk_brand_id']) { echo 'selected'; } ?> ><?=$row['brand_name']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('gst','GST')?></label>
										<select name="fk_gst_id" class="form-control form-control-user">
										<option value=""></option>
										<?php foreach($gst as $row) { ?>
										<option value="<?=$row['pk_gst_id']?>" <?php if($results['fk_gst_id']==$row['pk_gst_id']) { echo 'selected'; } ?> ><?=$row['gst_slab']?></option>
										<?php } ?>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
												<label><?=keyword_value('meta_title','Meta Title')?></label>
													<input type="text" name="meta_title" class="form-control form-control-user"  value="<?=$results['meta_title']?>">
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
													<input type="text" name="meta_keyword" class="form-control form-control-user" value="<?=$results['meta_keyword']?>">
												</div>
												
												
												 <div class="form-group">
												<label><?=keyword_value('meta_description','Meta Description')?></label>
											
													<textarea name="meta_description" class="form-control form-control-user"><?=$results['meta_description']?></textarea>
												</div>
												
												<div class="form-group">
												<label><?=keyword_value('ordering','Ordering')?></label>
													<input type="number" name="ordering" class="form-control form-control-user" value="<?=$results['ordering']?>">
												</div>
												
													<div class="form-group">
												<label><?=keyword_value('product_slug','Product Slug')?></label>
													<input type="text" name="product_slug" class="form-control form-control-user" value="<?=$results['product_slug']?>">
												</div>
												
												
												
											</div>
										</div>
										
  </div>
  <div id="gallery" class="container tab-pane <?php if(@$galleryf==true){echo 'active';} else {echo 'fade';} ?>">
     <br>
	 <?php if($gallery) { ?>
	 <table class="table table-bordered"  width="100%">
	  <thead>
                                        <tr>
                                            <th><?=keyword_value('image','Image')?></th>
                                            <th><?=keyword_value('size_color','Size/Color')?></th>
                           
											<th><?=keyword_value('variation','Custom Variation')?></th>
								
                                            <th><?=keyword_value('price','Price')?></th>
                                            <th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('make_default','Default')?></th>
											<th>&nbsp;</th>
                                        </tr>
                                    </thead>
									
									<tbody>
									<?php foreach($gallery as $row) { ?>
										<tr data-id="<?=$row['pk_price_id']?>">
											<td width="10%"><img src="<?=base_url('uploads/product/'.$row['product_image'])?>" id="img_<?=$row['pk_price_id']?>" width="100px">
											<input type="file" name="product_image_<?=$row['pk_price_id']?>" accept="jpg,jpeg,png,gif" class="image_update_ajax" style="width:100px" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-column="product_image">
 											</td>
											<td width="20%">
											<?=keyword_value('color','Color')?>
											<select  class="form-control form-control-user update_product_fields" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-cname="Product Color" data-column="fk_color_id">
											<option value="0"><?=keyword_value('na','NA')?></option>
											<?php if(@$colors) {
												foreach($colors as $row2) { ?>
											<option value="<?=$row2['pk_color_id']?>" <?php if($row2['pk_color_id']==$row['fk_color_id']){ echo 'selected'; } ?>> <?=$row2['color_name']?> </option>
											<?php } } ?>
											</select>
											
											<?=keyword_value('size','Size')?>
											<select  class="form-control form-control-user update_product_fields" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-cname="Product Size" data-column="fk_size_id">
											<option value="0"><?=keyword_value('na','NA')?></option>
											<?php if(@$sizes) { 
											foreach($sizes as $row2) { ?>
											<option value="<?=$row2['pk_size_id']?>" <?php if($row2['pk_size_id']==$row['fk_size_id']){ echo 'selected'; } ?>> <?=$row2['size_name']?> </option>
											<?php }  } ?>
											</select>
											
											</td>
											
											<td>
											<?=keyword_value('variation','Variation')?>
											<input type="text" class="form-control form-control-user update_product_fields" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-cname="Variation" data-column="product_variation" value="<?=$row['product_variation']?>">
											<div style="display:none">
											<?=keyword_value('subvariation','SubVariation')?>
											<input type="text"  class="form-control form-control-user update_product_fields" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-cname="Subvariation" data-column="product_subvariation" value="<?=$row['product_subvariation']?>">
											</div>
											</td>
										
											<td >
											<?=keyword_value('original_price','Original Price')?>
											<input type="number"  class="form-control form-control-user update_product_fields" value="<?=$row['original_price']?>"  data-cname="Original Price"  data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-column="original_price"  min="0">
											<?=keyword_value('discount_price','Discount Price')?>	<input type="number"  class="form-control form-control-user update_product_fields" value="<?=$row['discount_price']?>"  data-cname="Discount Price" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-column="discount_price" min="0">		
											</td>
										
											<td>
											<input type="number"  class="form-control form-control-user update_product_fields" value="<?=$row['quantity']?>"  data-cname="Quantity" data-id="<?=$row['pk_price_id']?>" data-table="product_pricing" data-column="quantity"   style="width:80px" min="1">
											</td>
											<td>
											<input type="radio"  name="pro_radio" class="form-control form-control-user update_default" value="<?=$row['pk_price_id']?>"  data-table="product_pricing" data-column="is_default" style="width:20px" <?php if($row['is_default']==1){ echo 'checked';} ?>>
											</td>
											<td>
											<a href="javascript:void(0);" data-id="<?=$row['pk_price_id']?>" data-flag="<?=$row['is_default']?>" class="btn btn-danger btn-circle btn-sm remove_gallery_ajax">
												<i class="fas fa-trash"></i>
											</a>
											</td>
										</tr>
										
									<?php } ?>
									</tbody>
                                    <tfoot>
                                         <tr>
                                            <th><?=keyword_value('image','Image')?></th>
                                             <th><?=keyword_value('size_color','Size/Color')?></th>
											<th><?=keyword_value('variation','Custom Variation')?></th>
									
                                            <th><?=keyword_value('price','Price')?></th>
                                            <th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('make_default','Default')?></th>
											<th>&nbsp;</th>
                                        </tr>
                                    </tfoot>
	 </table>
	 <?php } ?>
	 
									  <table class="table table-bordered"  width="100%">
									  <thead>
                                        <tr>
                                            <th><?=keyword_value('image','Image')?></th>
                                            <th><?=keyword_value('size_color','Size/Color')?></th>
                                            <th><?=keyword_value('variation','Custom Variation')?></th>
                                            <th><?=keyword_value('price','Price')?></th>
                                            <th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('actions','Actions')?></th>
                                        </tr>
                                    </thead>
									<tbody>
										<tr>
											<td><input type="file" accept="jpg,jpeg,png,gif" class="file" name="add_product_image[]" style="width:100px"></td>
											<td>
											<?=keyword_value('color','Color')?>
											<select  name="add_color[]" id="color_sel" class="form-control form-control-user">
											<option value="0"><?=keyword_value('not_applicable','Not Applicable')?></option>
											<?php if(@$colors){
												foreach($colors as $row2) { ?>
											<option value="<?=$row2['pk_color_id']?>" > <?=$row2['color_name']?> </option>
											<?php } } ?>
											</select>
											<?=keyword_value('size','Size')?>
											<select  name="add_size[]" id="size_sel" class="form-control form-control-user">
											<option value="0"><?=keyword_value('not_applicable','Not Applicable')?></option>
											<?php if(@$sizes){ foreach($sizes as $row2) { ?>
											<option value="<?=$row2['pk_size_id']?>"> <?=$row2['size_name']?> </option>
											<?php } } ?>
											</select>
											</td>
											<td>
											<?=keyword_value('variation','Variation')?>
											<input type="text" class="form-control form-control-user " name="add_variation[]"  value="0">
											<div style="display:none" ><?=keyword_value('subvariation','SubVariation')?>
											<input type="text"  class="form-control form-control-user"  name="add_subvariation[]" value="0">
											</div>
											</td>
											<td>
											<?=keyword_value('original_price','Original Price')?>
											<input type="number"  name="add_original_price[]" class="form-control form-control-user" min="0">
											<?=keyword_value('discount_price','Discount Price')?>
											<input type="number"  name="add_discount_price[]" class="form-control form-control-user"  min="0">
											</td>
										
											<td><input type="number"  name="add_quantity[]" class="form-control form-control-user"   min="1"></td>
											<td><a href="javascript:void(0);"  class="btn btn-info btn-circle btn-sm add-product">
												<i class="fas fa-plus"></i>
											</a>
										 </td>
										</tr>
									</tbody>
                                    <tfoot>
                                         <tr>
                                           <th><?=keyword_value('image','Image')?></th>
                                            <th><?=keyword_value('size_color','Size/Color')?></th>
                                            <th><?=keyword_value('variation','Custom Variation')?></th>
                                            <th><?=keyword_value('price','Price')?></th>
                                            <th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('actions','Actions')?></th>
                                        </tr>
                                    </tfoot>
	 </table>
	 
	 
  </div>
</div>

	
<input type="hidden" name="id" value="<?=$results['pk_product_id']?>">

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
	