<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_brand','Edit Brand')?></h1>
					
					<a href="<?=base_url('admin/brands')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open_multipart('admin/update_brand'); ?>
									
									
									<div class="form-group">
										<label><?=keyword_value('brand_name','Brand Name')?></label>
                                            <input type="text" name="brand_name" value="<?=@$results['brand_name']?>"class="form-control form-control-user" required>
                                        </div>
										
										<div class="form-group">
										<?php if(isset($results['brand_name'])){ ?>
										<img src="<?=base_url('uploads/brands/'.$results['brand_image'])?>" width="100px" align="center">
										<?php } ?>
										<label><?=keyword_value('brand_image','Brand Image')?></label>
                                            <input type="file" accept="png,jpg,jpeg,gif" name="brand_name" class="form-control form-control-user">
                                        </div>
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($results['active']==1) {echo 'checked'; } ?> >Active</option>
										<option value="0" <?php if($results['active']==0) {echo 'checked'; } ?> >Inactive</option>
										</select>
										
											<div class="form-group">
										<label><?=keyword_value('brand_slug','Brand Slug')?></label>
                                            <input type="text" name="brand_slug" value="<?=@$results['brand_slug']?>"class="form-control form-control-user">
                                        </div>
                              
                                        </div>
										<input type="hidden" name="id" value="<?=@$results['pk_brand_id']?>">
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
	