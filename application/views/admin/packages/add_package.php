<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_pize','Add Package')?></h1>
					<a href="<?=base_url('admin/packages')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open('admin/add_package'); ?>
									
                                        <div class="form-group">
										<label><?=keyword_value('package_name','Package Name')?></label>
                                            <input type="text" name="package_name" class="form-control form-control-user" required>
                                        </div>
										  <div class="form-group">
										<label><?=keyword_value('package_description','Package Description')?></label>
                                            <textarea name="package_description" class="form-control form-control-user"></textarea>
                                        </div>
										   <div class="form-group">
										<label><?=keyword_value('package_validity','Package Validity')?></label>
										<select name="package_validity" class="form-control form-control-user">
										<option value="1">1 day</option>
										<option value="3">3 days</option>
										<option value="5">5 days</option>
										<option value="7">1 Week</option>
										<option value="15">15 days</option>
										<option value="30">1 month</option>
										<option value="90">3 months</option>
										<option value="180">6 months</option>
										<option value="365">1 year</option>
										<option value="730">2 years</option>
										<option value="1095">3 years</option>
										</select>
                              
                                        </div>
										
										
										  <div class="form-group">
                                        <label><?=keyword_value('package_category','Category Limit(-1 for unlimited)')?></label>
                                            <input type="number" name="package_category" class="form-control form-control-user" required>
                                        </div>
										  <div class="form-group">
                                        <label><?=keyword_value('package_category','Product Limit(-1 for unlimited)')?></label>
                                            <input type="number" name="package_products" class="form-control form-control-user" required>
                                        </div>
										
										  <div class="form-group">
                                        <label><?=keyword_value('package_services','Service Limit (-1 for unlimited)')?></label>
                                            <input type="number" name="package_services" class="form-control form-control-user" required>
                                        </div>
										
                                      
										  <div class="form-group">
										<label><?=keyword_value('show_price','Enable Price display on Product/Services')?></label>
										<select name="show_price" class="form-control form-control-user">
										<option value="1">Yes</option>
										<option value="0">No</option>
										</select>
										
										  <div class="form-group">
										<label><?=keyword_value('show_features','Enable Contact Details/Features on Business Profile')?></label>
										<select name="show_features" class="form-control form-control-user">
										<option value="1">Yes</option>
										<option value="0">No</option>
										</select>
										
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
	