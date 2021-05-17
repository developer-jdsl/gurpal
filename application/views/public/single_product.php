
                <div class="col-md-9">
                    <div id="review-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <h3>Add a Review</h3>
                        <form>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" placeholder="e.g. John Doe" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" placeholder="e.g. jogndoe@gmail.com" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Review</label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Rating</label>
                                <ul class="icon-list icon-list-inline star-rating" id="star-rating">
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                </ul>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="1" data-thumbheight="150" data-thumbwidth="150">
							<?php 
							foreach($gallery as $row) { ?>
                                <img src="<?=base_url('uploads/product/'.$row['product_image'])?>" alt="<?=$product['product_name']?>" title="<?=$product['product_name']?>" />
                       
							<?php } ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="product-info box">
                                <ul class="icon-group icon-list-rating text-color" title="4.5/5 rating">
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star"></i>
                                    </li>
                                    <li><i class="fa fa-star-half-empty"></i>
                                    </li>
                                </ul>	<small><a href="#" class="text-muted">based on 8 reviews</a></small>
                                <h3><?=$product['product_name']?></h3>
								<?php if($product['discount_price']>0) { ?>
								 <p class="product-info-price">₹<?=$product['discount_price']?></p>
                                 <?php }  else  { ?>
									 <p class="product-info-price">₹<?=$product['original_price']?></p>
										<?php  } ?>
                                <p class="text-smaller text-muted"><?=word_limiter($product['product_description'], 150);?></p>
                                <!--
								<ul class="icon-list list-space product-info-list">
                                    <li><i class="fa fa-check"></i>Netus mus</li>
                                    <li><i class="fa fa-check"></i>Enim ultricies</li>
                                    <li><i class="fa fa-check"></i>Ridiculus metus</li>
                                    <li><i class="fa fa-check"></i>Non adipiscing</li>
                                    <li><i class="fa fa-check"></i>Natoque mus</li>
                                </ul>
								-->
								
								<?php $size_li_html=$color_li_html='';$i=0; foreach($gallery as $gal) { 
								$active="";
								$sid="";
								if($i==0)
								{
									$active="active";
									$sid=$gal['fk_size_id'];
								}
								if($gal['fk_size_id']>0)
								{
						
									$size_li_html.='<li  class="size_li '.$active.'" data-id="'.$gal['fk_size_id'].'">'.$gal['size_value'].'</li>';
								
								}
								
								if($gal['fk_color_id']>0)
								{
									$color_li_html.='<li  class="color_li '.$active.'" data-id="'.$gal['fk_color_id'].'" data-sizeid="'.$gal['fk_size_id'].'" style="background:'.$gal['color_value'].'">&nbsp;</li>';
								
								}
								
								$i++; } 
								?>
								
								
								<label>Size :
								 <ul class="list-inline variation_ul size_ul">
								 	<?=$size_li_html?>
								 </ul>
								 
								</label>
								<br>
								<label>Color :
								  <ul class="list-inline variation_ul color_ul">
								 <?=$color_li_html?>
								 </ul>
								 
							</label>
								
					
                                <ul class="list-inline">
                                    <li><a href="javascript:void(0)" data-pid="<?=$product['pk_product_id']?>" class="add_to_cart btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    </li>
                                    <li>
									<?php if(check_wishlist('product',$product['pk_product_id'])) {?> <a href="<?=base_url('my-wishlist')?>"><i class="fa fa-star"></i> My Wishlist</a><?php } else { ?>  <a href="javascript:void(0)" data-id="<?=$product['pk_product_id']?>" data-type="product" data-uid="<?=$this->session->front_user_id?>" class="btn add_to_whishlist"> <i class="fa fa-star"></i> To Wishlist </a><?php } ?>
                            
									</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="gap"></div>
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-pencil"></i>Desciption</a>
                            </li>
                            <li><a href="#tab-2" data-toggle="tab"><i class="fa fa-info"></i>Additional Information</a>
                            </li>
                           <!-- <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-truck"></i>Shipping & Payment</a>
                            </li>
							-->
                            <li><a href="#tab-4" data-toggle="tab"><i class="fa fa-comments"></i>Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-1">
                               <?=$product['product_description']?>
                            </div>
                            <div class="tab-pane fade" id="tab-2">
                                <?=$product['product_specifications']?>
                            </div>
                            <div class="tab-pane fade" id="tab-3">
                                <p>Sapien sapien eget elementum elit mollis eu vehicula suspendisse vel hac vulputate proin erat facilisis habitasse libero cursus leo magnis consequat tortor parturient id fermentum dictum enim maecenas curabitur egestas</p>
                                <p>Blandit ridiculus donec purus mattis praesent netus vitae hendrerit eu tellus nulla viverra varius cursus turpis egestas pellentesque arcu morbi justo turpis ornare ridiculus justo parturient mauris euismod nascetur hendrerit</p>
                            </div>
                            <div class="tab-pane fade" id="tab-4">
                              
								<a class="popup-text btn btn-primary" href="#review-dialog" data-effect="mfp-zoom-out"><i class="fa fa-pencil"></i> Add a review</a>
                            </div>
                        </div>
                    </div>
                    <div class="gap"></div>
                    <h3>Related Products</h3>
                    <div class="gap gap-mini"></div>
                    <div class="row row-wrap">
					
					<?php $fp=0;
					foreach($featured_products as $product) { if($fp<3) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/product/'.$product['product_image'])?>" alt="<?=$product['product_name']?>" title="<?=$product['product_name']?>" />
                                </header>
                                <div class="product-inner">
                                    <ul class="icon-group icon-list-rating icon-list-non-rated" title="not rated yet">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <h5 class="product-title"><a  href="<?=base_url('product/'.$product['product_slug'])?>"><?=$product['product_name']?></a></h5>
                                    <p class="product-desciption"><?=word_limiter($product['product_description'], 20);?></p>
                                    <div class="product-meta">
                        
                                            <ul class="product-price-list">
										<?php if($product['original_price']>0 && $product['discount_price']>0) { ?>
                                             <li><span class="product-price">₹<?=$product['discount_price']?></span>
                                            </li>
                                          
										   <li><span class="product-old-price">₹<?=$product['original_price']?></span>
                                            </li>
										<?php } else if($product['original_price']>0) {?>
										   <li><span class="product-price">₹<?=$product['original_price']?></span>
                                            </li>
										<?php  } else if($product['discount_price']>0) { ?>
										
										  <li><span class="product-price">₹<?=$product['discount_price']?></span>
                                            </li>
										<?php  } ?>
                                        </ul>
										
                                        <ul class="product-actions-list">
                                            <li><a class="btn btn-sm add_to_cart_list" href="javascript:void(0);" data-id="<?=$product['pk_price_id']?>"><i class="fa fa-shopping-cart"></i> To Cart</a>
                                            </li>
                                           <?php if($product['product_slug']) { ?>
                                            <li><a class="btn btn-sm" href="<?=base_url('product/'.$product['product_slug'])?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
											<?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php } $fp++;}?>
       
                    </div>
                    <div class="gap gap-small"></div>
                </div>
            </div>
			</div>

   