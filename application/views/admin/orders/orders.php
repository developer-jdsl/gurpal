<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('orders','Orders')?></h1>
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
											<th><?=keyword_value('order','Order')?></th>
                                            <th><?=keyword_value('txn_id','TXN ID')?></th>
											<th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('gtotal','G.Total')?></th>
											<th><?=keyword_value('dated','Dated')?></th>
											<th><?=keyword_value('user','User')?></th>
                                            <th><?=keyword_value('status','Status')?></th>
                                            <th><?=keyword_value('action','Action')?></th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th><?=keyword_value('order','Order')?></th>
                                            <th><?=keyword_value('txn_id','TXN ID')?></th>
											<th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('gtotal','G.Total')?></th>
											<th><?=keyword_value('dated','Dated')?></th>
											<th><?=keyword_value('user','User')?></th>
                                            <th><?=keyword_value('status','Status')?></th>
                                            <th><?=keyword_value('action','Action')?></
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                           
                                        
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
		<script>var table_ajax_url='<?=base_url("admin/order_list")?>';</script>
	