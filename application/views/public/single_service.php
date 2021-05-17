
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
						
                                <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" />
                      
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
                                <h3><?=$service['service_name']?></h3>
								<?php if($service['discount_price']>0) { ?>
								 <p class="product-info-price">₹<?=$service['discount_price']?></p>
                                 <?php }  else  { ?>
									 <p class="product-info-price">₹<?=$service['original_price']?></p>
										<?php  } ?>
                                <p class="text-smaller text-muted"><?=word_limiter($service['service_description'], 150);?></p>
                                <!--
								<ul class="icon-list list-space product-info-list">
                                    <li><i class="fa fa-check"></i>Netus mus</li>
                                    <li><i class="fa fa-check"></i>Enim ultricies</li>
                                    <li><i class="fa fa-check"></i>Ridiculus metus</li>
                                    <li><i class="fa fa-check"></i>Non adipiscing</li>
                                    <li><i class="fa fa-check"></i>Natoque mus</li>
                                </ul>
								-->
								
								<label>Choose :
								 <select class="form-control service_single_select">
								 <?php foreach($gallery as $gal) {  ?>
								 <option value="<?=$gal['pk_pricing_id']?>" data-price="₹<?=$gal['discount_price']?$gal['discount_price']:$gal['original_price']?>" >₹<?=$gal['discount_price']?$gal['discount_price']:$gal['original_price']?> <?=$gal['service_variation']?> (<?=$gal['service_subvariation']?>)</option>
								 <?php } ?>
								 </select>
								 
								</label>
								
                                <ul class="list-inline">
                                    <li><a href="javascript:void(0)" data-sid="<?=$service['pk_service_id']?>" class="add_service btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    </li>
                                    <li>
									<?php if(check_wishlist('service',$service['pk_service_id'])) {?> <a href="<?=base_url('my-wishlist')?>"><i class="fa fa-star"></i> My Wishlist</a><?php } else { ?>  <a href="javascript:void(0)" data-id="<?=$service['pk_service_id']?>" data-type="service" data-uid="<?=$this->session->front_user_id?>" class="btn add_to_whishlist"> <i class="fa fa-star"></i> To Wishlist </a><?php } ?>
									
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
                               <?=$service['service_description']?>
                            </div>
                            <div class="tab-pane fade" id="tab-2">
                                <?=$service['service_features']?>
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
                    <h3>Related Services</h3>
                    <div class="gap gap-mini"></div>
                    <div class="row row-wrap">
					
					<?php $fp=0;
					foreach($featured_services as $service) { if($fp<3) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" />
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
                                    <h5 class="product-title"><a  href="<?=base_url('service/'.$service['service_slug'])?>"><?=$service['service_name']?></a></h5>
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
                                            <li><a class="btn btn-sm add_service_list" href="javascript:void(0);" data-id="<?=$service['pk_pricing_id']?>><i class="fa fa-shopping-cart"></i> To Cart</a>
                                            </li>
                                           <?php if($service['service_slug']) { ?>
                                            <li><a class="btn btn-sm" href="<?=base_url('city/'.$this->session->city.'/service/'.$service['service_slug'])?>"><i class="fa fa-bars"></i> Details</a>
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

   