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
                        <div class="col-md-9">
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
								<?php if($orders) { 
								foreach($orders as $order) {  
								?>
                                    <tr>
                                        <td><?=$order['order_number']?></td>
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
                        </div>
                    </div>
                    <div class="gap"></div>
                </div>
				</div>
				</div>