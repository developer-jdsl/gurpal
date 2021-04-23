<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_admin','Add Admin')?></h1>
					
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

									<?php echo form_open_multipart('admin/add_admin'); ?>
									
										
										
                                        <div class="form-group">
										<label><?=keyword_value('admin_name','Admin Name')?></label>
                                            <input type="text" name="admin_name" class="form-control form-control-user" required>
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('admin_mobile','Admin Mobile')?></label>
                                            <input type="tel" name="admin_mobile" class="form-control form-control-user" required>
                                        </div>
										
										<div class="form-group">
										<label><?=keyword_value('admin_email','Admin Email')?></label>
                                            <input type="email" name="admin_email" class="form-control form-control-user" required>
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
	