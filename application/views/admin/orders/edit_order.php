<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('view_order','View Order')?></h1>
					<a href="<?=base_url('admin/orders')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
					<?php if($msg=$this->session->flashdata('msg')){?>
						  <div class="alert alert-primary alert-dismissible fade show" role="alert">
						  <?=$msg?>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php } ?>
    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mc col-md-11">
                       
                        <div class="card-body">
                            <p align="center"><?php echo validation_errors();?></p>
	 <?php if($order_details) { ?>
	 <table class="table table-bordered"  width="100%">
	  <thead>
                                        <tr>
                                            <th><?=keyword_value('name','Name')?></th>
                                            <th><?=keyword_value('price','Price')?></th>
                                            <th><?=keyword_value('quantity','Qty')?></th>
											<th><?=keyword_value('gst','GST')?></th>
											<th><?=keyword_value('total','Total')?></th>
										
                                        </tr>
                                    </thead>
									
									<tbody>
									<?php
									$stotal=$tgst=$gtotal=0;
									
				
									foreach($order_details as $row) { 
									if($this->session->user_type=='superadmin') {
									?>
									<tr>
									<td> <?=($row['order_type']=='product')?$row['product_name'].'('.$row['color_name'].' | '.$row['size_name'] .')':$row['service_name'].'('.$row['service_variation'].' | '.$row['service_subvariation'] .')'?></td>
									<td><?php echo '₹'.$row['unit_price']; $stotal+=$row['unit_price'];?></td>
									<td><?=$row['quantity']?></td>
									<td><?php $tgst+=$row['gst']; echo '₹'.$row['gst'].' ('.$row['gst_slab'].')';?></td>
									<td><?php $gtotal+=$row['grandtotal'];echo '₹'.$row['grandtotal'];?></td>
									</tr>
										
									<?php } else {
										if($this->session->pk_admin_id==$row['fk_admin_id']) { ?>
										<tr>
									<td> <?=($row['order_type']=='product')?$row['product_name'].'('.$row['color_name'].' | '.$row['size_name'] .')':$row['service_name'].'('.$row['service_variation'].' | '.$row['service_subvariation'] .')'?></td>
									<td><?php echo '₹'.$row['unit_price']; $stotal+=$row['unit_price'];?></td>
									<td><?=$row['quantity']?></td>
									<td><?php $tgst+=$row['gst']; echo '₹'.$row['gst'].' ('.$row['gst_slab'].')';?></td>
									<td><?php $gtotal+=$row['grandtotal'];echo '₹'.$row['grandtotal'];?></td>
									</tr>
										<tr>
											<?php echo form_open_multipart('admin/update_order'); ?>
										   <td><input type="text" name="tracking_carrier" class="form-control" placeholder="Shipping Partner" value="<?=$row['tracking_company']?>" ></td>
										 <td> <input type="text" name="tracking_number" class="form-control" placeholder="Tracking Number" value="<?=$row['tracking_number']?>" > </td>
										 <td colspan="2"> <select name="order_status" class="form-control" required>
											<option value="processing" <?php if($row['order_status']=='processing'){ echo 'selected'; } ?> >Processing</option>
											<option value="shipped" <?php if($row['order_status']=='shipped'){ echo 'selected'; } ?> >Shipped</option>
											<option value="completed" <?php if($row['order_status']=='completed'){ echo 'selected'; } ?> >Completed</option>
											<option value="cancelled" <?php if($row['order_status']=='cancelled'){ echo 'selected'; } ?> >Cancelled</option>
											</select>
											</td>
										 <td> <input type="submit" class="btn btn-primary" value="Update Order">
										  <input type="hidden" name="id" value="<?=$row['pk_detail_id']?>">
										  <input type="hidden" name="oid" value="<?=$results['pk_order_id']?>">
										  </td>
										  </form>
										  </td></tr>
										  
										  
										<?php }
										
										}
										
										} ?>
									</tbody>
                                    <tfoot>
                                         <tr>
                                           <th colspan="3">&nbsp;</th>
                                           
											<th><?=keyword_value('subtotal','Subtotal')?></th>
											<th><?='₹'.number_format($stotal,'2','.','')?></th>
                                        </tr>
										<tr>
                                           <th colspan="3">&nbsp;</th>
                                           
											<th><?=keyword_value('gst','GST')?></th>
											<th><?='₹'.number_format($tgst,'2','.','')?></th>
                                        </tr>
										<tr>
                                           <th colspan="3">&nbsp;</th>
                                           
											<th><?=keyword_value('gtotal','Grand Total')?></th>
											<th><?='₹'.number_format($gtotal,'2','.','')?></th>
                                        </tr>
										
											<tr>
                                        </tr>
										
                                    </tfoot>
	 </table>
	 <?php } ?>
	 
						
	 
  </div>

</form>

									

										
										
									
									
									
							
                 </div>   

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
	