                <div class="col-md-9">
                    <div class="gap"></div>
                    <h1 class="mb20">Services in <?=$city_name?><small><a href="<?=base_url('city/'.$this->session->city.'/services/all')?>">View All</a></small></h1>
                    <div class="row row-wrap">
					
					<?php //var_dump($services);?>
					<?php if($services)
					{foreach($services as $service) { ?>
					
					                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" />
                                    <div class="product-quick-view">
                                        <a class="fa fa-eye popup-text" href="#product-quick-view-dialog" data-effect="mfp-move-from-top" data-toggle="tooltip" data-placement="top" title="Quick View"></a>
                                    </div>
                                    <div class="product-secondary-image">
                                        <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" />
                                    </div>
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
                                    <h5 class="product-title"><?=$service['service_name']?></h5>
                                    <p class="product-desciption"><?=word_limiter($service['service_description'], 20);?></p>
                                    <div class="product-meta">
                                        <ul class="product-price-list">
                                          	<?php if($service['original_price']>0 && $service['discount_price']>0) { ?>
                                             <li><span class="product-price">₹<?=$service['discount_price']?></span>
                                            </li>
                                          
										   <li><span class="product-old-price">₹<?=$service['original_price']?></span>
                                            </li>
										<?php } else if($service['original_price']>0) {?>
										   <li><span class="product-price">₹<?=$service['original_price']?></span>
                                            </li>
										<?php  } else if($service['discount_price']>0) { ?>
										
										  <li><span class="product-price">₹<?=$service['discount_price']?></span>
                                            </li>
										<?php  } ?>
                       
                                        </ul>
                                        <ul class="product-actions-list">
                                            <li><a class="btn btn-sm add_service_list" data-id="<?=$service['pk_pricing_id']?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> To Cart</a>
                                            </li>
                                            <li><a class="btn btn-sm" href="<?=base_url('city/'.$this->session->city.'/service/'.$service['service_slug'])?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
					
					<?php } } else {?>
					
					<p align="center">No services found in <?=$city_name?>.</p>
					<?php }?>

                 </div>
 
        
           
                    <div class="gap gap-small"></div>
                    <h1 class="mb20">Products in <?=$city_name?><small><a href="<?=base_url('products/all')?>">View All</a></small></h1>
                    <div class="row row-wrap">
					<?php //var_dump($products) ;?>
					
					<?php foreach($products as $product) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
							<a  href="<?=base_url('product/'.$product['product_slug'])?>">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/product/'.$product['product_image'])?>" alt="<?=$product['product_name']?>" title="<?=$product['product_name']?>" />
                                    
									<div class="product-quick-view">
                                       <!-- <a class="fa fa-eye popup-text" href="#product-quick-view-dialog" data-effect="mfp-move-from-top" data-toggle="tooltip" data-placement="top" title="Quick View"></a> -->
                                    </div>
									
                                    <div class="product-secondary-image">
                                        <img src="<?=base_url('uploads/product/'.$product['product_image'])?>" alt="<?=$product['product_name']?>" title="<?=$product['product_name']?>" />
                                    </div>
                                </header>
								</a>
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
                                            <li><a class="btn btn-sm add_to_cart_list" href="javascript:void(0);" data-id="<?=$product['pk_price_id']?>" ><i class="fa fa-shopping-cart"></i> To Cart</a>
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
					<?php } ?>
						
                    </div>
                    <div class="gap gap-small"></div>
			
                </div>
            </div>

        </div>