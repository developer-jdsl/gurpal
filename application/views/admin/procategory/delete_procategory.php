<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('delete_product_cat','Delete Product Category')?></h1>
					
					<a href="<?=base_url('admin/procategory')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
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

									<?php echo form_open('admin/remove_procategory'); ?>
									
                                        <div class="form-group">
										<strong><?=keyword_value('are_you_sure','Are you sure you want to delete this record ?')?></strong><br>
										<?=@$results['category_name']?>
                                        </div>
										<input type="hidden" name="id" value="<?=@$results['pk_procategory_id']?>">
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            <?=keyword_value('delete','Yes ,Delete')?>
                                        </button>
                                    </form>
							
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
	