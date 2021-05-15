                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <ul class="nav nav-pills nav-stacked nav-arrow">
                            <li ><a href="<?=base_url('my-account')?>">Settings</a>
                            </li>
                            <li><a href="<?=base_url('my-addresses')?>">Address Book</a>
                            </li>
                            <li class="active"><a href="<?=base_url('my-orders')?>">Orders History</a>
                            </li>
                            <li><a href="javascript:void(0);">Wishlist</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
                    <div class="row">
                  <?php if($order_id) {
					if($order_details){
					  ?>
				  <a href="<?=base_url('my-orders')?>" class="btn btn-primary">Back</a>
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
									
									foreach($order_details as $row) { ?>
									<tr>
									<td> <?=($row['order_type']=='product')?$row['product_name'].'('.$row['color_name'].' | '.$row['size_name'] .')':$row['service_name'].'('.$row['service_variation'].' | '.$row['service_subvariation'] .')'?></td>
									<td><?php echo '₹'.$row['unit_price']; $stotal+=$row['unit_price'];?></td>
									<td><?=$row['quantity']?></td>
									<td><?php $tgst+=$row['gst']; echo '₹'.$row['gst'].' ('.$row['gst_slab'].')';?></td>
									<td><?php $gtotal+=$row['grandtotal'];echo '₹'.$row['grandtotal'];?></td>
									</tr>
										
									<?php } ?>
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
					<?php } else {  redirect('my-orders'); } ?>
					
				  
				  <?php } else { ?>
                            <table class="table table-order">
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
										 <th>Status</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php if(@$orders) { 
								foreach($orders as $order) {  
								?>
                                    <tr>
                                        <td><a href="<?=base_url('my-orders/'.base64_encode($order['order_number']))?>"><?=$order['order_number']?></a></td>
										<td><?=$order['order_status']?></td>
                                        <td><?=$order['total_quantity']?></td>
                                        <td>₹<?=$order['grand_total']?></td>
                                        <td><?=date('d M,Y',$order['invoice_date'])?></td>
                                    </tr>
									
								<?php } } else {  ?>
								<tr><td colspan="4" align="center">No Order Found</td></tr>
								<?php } ?>
                                </tbody>
                            </table>
				  <?php } ?>
                    </div>
                    <div class="gap"></div>
                </div>
				</div>
				</div>