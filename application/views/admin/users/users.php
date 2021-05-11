<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('users','Users')?> </h1>
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
                                            <th><?=keyword_value('name','Name')?></th>
                                            <th><?=keyword_value('email','Email')?></th>
                                            <th><?=keyword_value('phone','Phone')?></th>
											<th><?=keyword_value('status','Status')?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?=keyword_value('name','Name')?></th>
                                            <th><?=keyword_value('email','Email')?></th>
                                            <th><?=keyword_value('phone','Phone')?></th>
											<th><?=keyword_value('status','Status')?></th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                           <?php foreach($users as $row){ ?>
										   <tr>
										   <td><?php if($row['user_image']){?>
										   <img src="<?=base_url('uploads/users/'.$row['user_image'])?>" width="50px">
										   <?php } ?>
										   <?=$row['user_firstname'].' '.$row['user_lastname']?></td>
										   <td><?=$row['user_email']?></td>
										   <td><?=$row['user_phone']?></td>
										   <td><?=($row['active']==1)?'Active':'Inactive';?></td>
										  
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
	