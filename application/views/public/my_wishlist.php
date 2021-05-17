                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <ul class="nav nav-pills nav-stacked nav-arrow">
                            <li><a href="<?=base_url('my-account')?>">Settings</a>
                            </li>
                            <li><a href="<?=base_url('my-addresses')?>">Address Book</a>
                            </li>
                            <li><a href="<?=base_url('my-orders')?>">Orders History</a>
                            </li>
                            <li  class="active"><a href="<?=base_url('my-wishlist')?>">Wishlist</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
				<div class="row">
				<div class="col-md-12">

					<?php if(@$msg){?>
						 
						 <p> <?=$msg?> </p>
					
					<?php } ?>
					
					      <?php echo '<p>'.validation_errors().'</p>';?>
				
				
				</div>
				</div>
                  <div class="row row-wrap">
				  <?php 
				
				  if($wishlist) {
					   foreach($wishlist as $row){ ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=$row['item_image']?>" alt="<?=$row['item_name']?>" title="<?=$row['item_name']?>" />
                                </header>
                                <div class="product-inner">
                                    <h5 class="product-title"><?=$row['item_name']?></h5>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                            <li><span class="product-price">₹<?=$row['item_price']?></span>
                                            </li>
                                        </ul>
                                        <ul class="product-actions-list">
                                            <li><a class="btn btn-sm" href="<?=$row['item_url']?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="product-wishlist-remove"><a class="btn btn-ghost btn-sm"><i class="fa fa-times"></i> Remove from wishlist</a>
                            </div> -->
                        </div>
						
				  <?php }  } else {	  ?>
				  
				  <p align="center">No item found.</p>
				  <?php } ?>
                    <div class="gap"></div>
                </div>
				</div>
				</div>