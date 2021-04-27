<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('email_template','Email Templates')?></h1>
					<?php if($msg=$this->session->flashdata('msg')){?>
						  <div class="alert alert-primary alert-dismissible fade show" role="alert">
						  <?=$msg?>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php } ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><?=keyword_value('template_name','Template Name')?></th>
				
                                            <th><?=keyword_value('action','Action')?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=keyword_value('template_name','Template Name')?></th>
							
                                            <th><?=keyword_value('action','Action')?></th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                           <?php foreach($results as $row){ ?>
										   <tr>
										   <td>
										   <?=$row['template_name']?></td>
										  
										  
										   <td>
											<?php echo form_open('admin/edit_email',array('class'=>'d-inline')); ?>
										   <input type="hidden" name="id" value="<?=$row['pk_template_id']?>"> 
										   <button  class="btn btn-primary" type="submit"><?=keyword_value('edit','Edit')?></button>
										   </form>
										   
									
										   <?php echo form_open('admin/delete_email',array('class'=>'d-inline')); ?>
										   <input type="hidden" name="id" value="<?=$row['pk_template_id']?>"> 
										   <button class="btn btn-primary" type="submit"><?=keyword_value('delete','Delete')?></button>
										   </form>
										 </td>
										   </tr>
										   <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
	