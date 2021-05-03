                    <div class="row row-wrap">
					
					<?php foreach($services as $service) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" />
                                </header>
                                <div class="product-inner">
                                    <ul class="icon-group icon-list-rating" title="5/5 rating">
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
                                        <p class="product-category"><i class="fa fa-tag"></i><?=$service['category_name']?></p>
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
					<?php } ?>
                    </div>
					
					<?php echo $pagination;
					?>