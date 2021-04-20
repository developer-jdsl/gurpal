<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_banner','Add Banner')?></h1>
					
					<a href="<?=base_url('admin/banners')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open_multipart('admin/add_banner'); ?>
									
											<div class="form-group">
										<label><?=keyword_value('banner_image','Banner Image')?></label>
                                            <input type="file" accept="png,jpg,jpeg,gif" name="banner_image" class="form-control form-control-user" required>
                                        </div>
										
										
                                        <div class="form-group">
										<label><?=keyword_value('banner_text','Banner Text')?></label>
                       
											<textarea name="banner_text" class="form-control form-control-user" ></textarea>
                                        </div>
										
										
									
									
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
                              
                                        </div>
										 <div class="form-group">
										<label><?=keyword_value('banner_order','Banner Order')?></label>
                       
											<input type="number" name="banner_order" class="form-control form-control-user"  min="0">
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
	