<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('package','Package')?>  <a	
                            href="<?=base_url('admin/add_package')?>" class="btn btn-primary text-right">Add Package</a></h1>
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
                                            <th><?=keyword_value('package_name','Package Name')?></th>
											<th><?=keyword_value('validity','Validity')?></th>
											<th><?=keyword_value('products','Products')?></th>
											<th><?=keyword_value('services','Services')?></th>
											<th><?=keyword_value('price','Price')?></th>
											<th><?=keyword_value('features','Features')?></th>
                                            <th><?=keyword_value('status','Status')?></th>
                                            <th><?=keyword_value('action','Action')?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=keyword_value('package_name','Package Name')?></th>
											<th><?=keyword_value('validity','Validity')?></th>
											<th><?=keyword_value('products','Products')?></th>
											<th><?=keyword_value('services','Services')?></th>
											<th><?=keyword_value('price','Price')?></th>
											<th><?=keyword_value('features','Features')?></th>
                                            <th><?=keyword_value('status','Status')?></th>
                                            <th><?=keyword_value('action','Action')?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                           <?php $validity=array('1'=>'1 day','3'=>'3 days','5'=>'5 days','7'=>'1 week',
																'15'=>'15 days','30'=>'1 month','90'=>'3 months','180'=>'6 months',
																'365'=>'1 year','730'=>'2 year','1095'=>'3 year');
										   foreach($results as $row){ ?>
										   <tr>
										   <td><?=$row['package_name']?></td>
										    <td><?=$validity[$row['package_validity']]?></td>
											<td><?=$row['package_products']?> </td>
											<td><?=$row['package_services']?> </td>
											<td><?php if($row['show_price']==1){ echo '<i class="fas fa-fw fa-check"></i>';}else{ echo '<i class="fas fa-fw fa-times"></i>';} ?> </td>
											<td><?php if($row['show_features']==1){ echo '<i class="fas fa-fw fa-check"></i>';}else{ echo '<i class="fas fa-fw fa-times"></i>';} ?>  </td>
										   <td><?=($row['active']==1)?'Active':'Inactive';?></td>
										   <td>
											<?php echo form_open('admin/edit_package',array('class'=>'d-inline')); ?>
										   <input type="hidden" name="id" value="<?=$row['pk_package_id']?>"> 
										   <button  class="btn btn-primary" type="submit"><?=keyword_value('edit','Edit')?></button>
										   </form>
										   
									
										   <?php echo form_open('admin/delete_package',array('class'=>'d-inline')); ?>
										   <input type="hidden" name="id" value="<?=$row['pk_package_id']?>"> 
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
	