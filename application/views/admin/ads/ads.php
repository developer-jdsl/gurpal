<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('ads','Advertisements')?>  <a	
                            href="<?=base_url('admin/add_ad')?>" class="btn btn-primary text-right"><?=keyword_value('add_ads','Add Advertisement')?></a></h1>
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
                                            <th><?=keyword_value('ad_media','Ad Media')?></th>
											<th><?=keyword_value('ad_user','User')?></th>
											<th><?=keyword_value('page','page')?></th>
											<th><?=keyword_value('section','Section')?></th>
                                            <th><?=keyword_value('status','Status')?></th>
                                            <th><?=keyword_value('action','Action')?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=keyword_value('ad_media','Ad Media')?></th>
											<th><?=keyword_value('ad_user','User')?></th>
											<th><?=keyword_value('page','Page')?></th>
											<th><?=keyword_value('section','Section')?></th>
                                            <th><?=keyword_value('status','Status')?></th>
                                            <th><?=keyword_value('action','Action')?></th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                           <?php foreach($results as $row){ ?>
										   <tr>
										   <td><?php if($row['display_type']=='image'){?>
										<img src="<?=base_url('uploads/adverts/'.$row['advertisement_banner'])?>" width="150" >
										<?php }?>
										
										<?php if($row['display_type']=='video'){?>
												<video width="150" height="100" controls>
												  <source src="<?=base_url('uploads/adverts/'.$row['advertisement_banner'])?>" type="video/mp4">
												  Your browser does not support the video tag.
												</video>
										<?php }?></td>
										 <td><?php foreach($admins as $admin) { 
										 if($admin['pk_admin_id']==$row['fk_admin_id']){
										 echo $admin['admin_name'];
										 }
										 }?></td>
										  <td><?=$row['display_page']?></td>
										   <td><?=$row['display_section']?></td>
									
										  
										   <td><?=($row['active']==1)?'Active':'Inactive';?></td>
										   <td>
											<?php echo form_open('admin/edit_ad',array('class'=>'d-inline')); ?>
										   <input type="hidden" name="id" value="<?=$row['pk_advertisement_id']?>"> 
										   <button  class="btn btn-primary" type="submit"><?=keyword_value('edit','Edit')?></button>
										   </form>
										   
									
										   <?php echo form_open('admin/delete_ad',array('class'=>'d-inline')); ?>
										   <input type="hidden" name="id" value="<?=$row['pk_advertisement_id']?>"> 
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
	