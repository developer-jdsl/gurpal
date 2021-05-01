 <?php if($cart) {  ?><div class="col-md-8">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Name</th>
                                <th>QTY</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php 
						$subt=$gst=0;foreach($cart as $row) { ?>
                            <tr id="<?php if($row['item_type']=='product'){ echo $row['item_pid'];}else { echo 's'.$row['item_pid'];}?>">
                                <td class="cart-item-image">
                                    <a href="<?=$row['item_slug']?>">
                                        <img src="<?=$row['item_image']?>" alt="<?=$row['item_name']?>" title="<?=$row['item_name']?>" />
                                    </a>
                                </td>
                                <td><a href="<?=$row['item_slug']?>"><?=$row['item_name']?></a>
                                </td>
                                <td class="cart-item-quantity">
								<?php if($row['item_type']=='product'){ ?> <i class="fa fa-minus cart-item-minus"></i> <?php } ?>
                                    <input type="text" name="cart-quantity" id="cart-quantity" min="1" data-id="<?=$row['item_pid']?>" class="cart-quantity" value="<?=$row['item_qty']?>" <?php if($row['item_type']!='product'){ echo 'disabled';} ?> />
								<?php if($row['item_type']=='product'){ ?><i class="fa fa-plus cart-item-plus"></i> <?php } ?>
                                </td>
                                <td id="td_subt">₹<?=$row['item_price']*$row['item_qty']?></td>
                                <td class="cart-item-remove" data-id="<?=$row['item_pid']?>" data-type="<?=$row['item_type']?>">
                                    <a class="fa fa-times" href="javascript:void(0);"></a>
                                </td>
                            </tr>
							
						<?php $subt=$subt+($row['item_price']*$row['item_qty']);
							  $gst=$gst+($row['item_gstvalue']*$row['item_qty']);	

							} ?>
                        </tbody>
                    </table>	<a href="#" class="btn btn-primary">Update the cart</a>
                </div>
                <div class="col-md-3">
                    <ul class="cart-total-list">
                        <li><span>Sub Total</span><span id="cart_subtotal">₹<?=$subt?></span>
                        </li>
                        <li><span>Shipping</span><span id="cart_ship">₹0.00</span>
                        </li>
                        <li><span>GST</span><span id="cart_gst">₹<?=$gst?></span>
                        </li>
                        <li><span>Total</span><span id="cart_total">₹<?=$gst+$subt?></span>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-lg">Checkout</a>
                </div>
            </div>
			
 <?php } else { ?>
 <div class="col-md-12">
  <table class="table cart-table">
  <tr><td align="center" style="text-align:center">No items in cart</td></tr>
  </table>
 </div>
 <?php } ?>
           
        </div>