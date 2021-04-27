<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('edit_email_template','Edit Email Template')?></h1>
					<?php if($msg=$this->session->flashdata('msg')){?>
						  <div class="alert alert-primary alert-dismissible fade show" role="alert">
						  <?=$msg?>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php } ?>
  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mt-4 mc col-md-12">
                        <div class="card-body">
                             <?php echo validation_errors(); ?>
									<?php echo form_open_multipart('admin/update_email'); ?>
								
								<div class="row">
								<div class="col-md-12">
								
                                        <div class="form-group">
										<label><?=keyword_value('template_name','Template Name')?></label>
                                            <input type="text" name="template_name" class="form-control form-control-user" value="<?=@$results['template_name']?>" required>
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('template_subject','Subject')?></label>
                                            <input type="text" name="template_subject" class="form-control form-control-user" value="<?=@$results['template_subject']?>" required>
                                        </div>
										
										 <div class="form-group">
										<label><?=keyword_value('template','Email Template')?></label>
                                      
											<textarea  name="template" class="form-control form-control-user editor" rows="10" required><?=@$results['template']?></textarea>
                                        </div>
										
										</div>
										</div>
										<input type="hidden" name="id" value="<?=$results['pk_template_id']?>">
										
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
	