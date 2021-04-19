<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('add_color','Add Color')?></h1>
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

                                    <?php echo form_open('admin/add_color'); ?>
                                    
                                        <div class="form-group">
                                        <label><?=keyword_value('color_name','Color Name')?></label>
                                            <input type="text" name="color_name" class="form-control form-control-user" required>
                                        </div>
                                        <div class="form-group">
                                        <label><?=keyword_value('color_value','Color Value')?></label>
                                            <input type="text" name="color_value" class="form-control form-control-user" required>
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
    