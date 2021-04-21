<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_business_cat','Edit Business Category')?></h1>
					
					<a href="<?=base_url('admin/bizcategory')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open_multipart('admin/update_bizcategory'); ?>
									
									
									 <div class="form-group">
										<label><?=keyword_value('category_name','Category Name')?></label>
                                            <input type="text" name="category_name" class="form-control form-control-user" value="<?=@$results['category_name']?>" required>
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('category_parent','Category Parent')?></label>   
											<select name="parent_category" class="form-control form-control-user">
											<option value="0">No Parent Category</option>
											<?php foreach($procats as $cat){ 
											if($cat['pk_category_id']!=$results['pk_category_id']) { ?>
											<option value="<?=$cat['pk_category_id']?>" <?php if($results['parent_category']==$cat['pk_category_id']){ echo 'selected';}?> ><?=$cat['category_name']?></option>
											<?php } } ?>
											</select>
                                        </div>
										
										<div class="form-group">
										
										<?php if($results['category_image']){ ?>
										<img src="<?=base_url('uploads/category/'.$results['category_image'])?>" style="width:100%">
										<?php } ?>
										<label><?=keyword_value('category_image','Category Image')?></label>
                                            <input type="file" accept="png,jpg,jpeg,gif" name="category_image" class="form-control form-control-user">
                                        </div>
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($results['active']==1){ echo 'selected';}?> >Active</option>
										<option value="0" <?php if($results['active']==0){ echo 'selected';}?> >Inactive</option>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('meta_title','Meta Title')?></label>
                                            <input type="text" name="meta_title" class="form-control form-control-user" value="<?=@$results['meta_title']?>" >
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
                                            <input type="text" name="meta_keywords" class="form-control form-control-user" value="<?=@$results['meta_keywords']?>" >
                                        </div>
										
										
										 <div class="form-group">
										<label><?=keyword_value('meta_description','Meta Description')?></label>
                                            <input type="text" name="meta_description" class="form-control form-control-user" value="<?=@$results['meta_description']?>" >
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('order','Order')?></label>
                                            <input type="text" name="ordering" class="form-control form-control-user" value="<?=@$results['ordering']?>">
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('category_slug','Category Slug')?></label>
                                            <input type="text" name="category_slug" class="form-control form-control-user" value="<?=@$results['category_slug']?>">
                                        </div>
										
										<input type="hidden" name="id" value="<?=@$results['pk_category_id']?>">
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
	