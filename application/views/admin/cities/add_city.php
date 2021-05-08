<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_city','Add City')?></h1>
					<a href="<?=base_url('admin/cities')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open_multipart('admin/add_city'); ?>
									
										<div class="form-group">
										<label><?=keyword_value('state_name','State Name')?></label>
										<select name="state_name" class="form-control form-control-user">
										<?php foreach($states as $state){ ?>
										<option value="<?=$state['pk_state_id']?>"><?=$state['state_name']?></option>
										<?php } ?>
                                         </select>
                                        </div>
										
										
                                        <div class="form-group">
										<label><?=keyword_value('city_name','City Name')?></label>
                                            <input type="text" name="city_name" class="form-control form-control-user" required>
                                        </div>
										 <div class="form-group">
							
										<label><?=keyword_value('city_img','City Image')?></label>
                                            <input type="file" name="city_img"  class="form-control form-control-user" accept="image/*">
                                        </div>
										
										
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
                              
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('meta_title','Meta Title')?></label>
                                            <input type="text" name="meta_title"  class="form-control form-control-user" >
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
                                            <input type="text" name="meta_keywords"  class="form-control form-control-user" >
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('meta_description','Meta Description')?></label>
         
											<textarea class="form-control form-control-user" name="meta_description"></textarea>
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
	