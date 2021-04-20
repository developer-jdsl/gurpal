<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_color','Edit Color')?></h1>
					<a href="<?=base_url('admin/color')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open('admin/update_color'); ?>
									
                                        <div class="form-group">
										<label><?=keyword_value('color_name','Color Name')?></label>
                                            <input type="text" name="color_name" value="<?=@$results['color_name']?>" class="form-control form-control-user" required>
                                        </div>
                                        <div class="form-group">
                                        <label><?=keyword_value('color_value','Color Value')?></label>
                                            <input type="text" name="color_value" value="<?=@$results['color_value']?>" class="form-control form-control-user" required>
                                        </div>
                                        <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if(@$results['active']==1){ echo 'selected';}?>>Active</option>
										<option value="0" <?php if(@$results['active']==0){ echo 'selected';}?>>Inactive</option>
										</select>
                              
                                        </div>
										<input type="hidden" name="id" value="<?=@$results['pk_color_id']?>">
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
	