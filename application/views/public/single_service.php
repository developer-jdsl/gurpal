
                <div class="col-md-9">
                    <div id="review-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
                        <h3>Add a Review</h3>
               
						<?php echo form_open('home/add_review');?>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="e.g. John Doe" class="form-control" <?php if(@$this->session->front_username){ echo 'value="'.$this->session->front_username.'"';}?> required />
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" placeholder="e.g. jogndoe@gmail.com" class="form-control"  <?php if(@$this->session->front_user_data->user_email){ echo 'value="'.$this->session->front_user_data->user_email.'"';}?> required />
                            </div>
                            <div class="form-group">
                                <label>Review</label>
                                <textarea name="review" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Rating</label>
                                <ul class="icon-list icon-list-inline star-rating" id="star-rating">
                                    <li data-id="1" class="selected"><i class="fa fa-star"></i>
                                    </li>
                                    <li data-id="2" class="selected"><i class="fa fa-star"></i>
                                    </li>
                                    <li data-id="3" class="selected"><i class="fa fa-star"></i>
                                    </li>
                                    <li data-id="4" class="selected"><i class="fa fa-star"></i>
                                    </li>
                                    <li data-id="5" class="selected"><i class="fa fa-star"></i>
                                    </li>
                                </ul>
                            </div>
							<input type="hidden" name="rating" id="rstars" value="5">
							<input type="hidden" name="type"  value="service">
							<input type="hidden" name="id"  value="<?=$service['pk_service_id']?>">
							<input type="hidden" name="url"  value="<?=current_url()?>">
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
                                <?=get_rating_html('service',$service['pk_service_id'])?>	<small><a  class="text-muted">based on <?=get_reviews_count('service',$service['pk_service_id'])?> review(s)</a></small>
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

                            <div class="tab-pane fade" id="tab-4">
							<?php $reviews=get_reviews('service',$service['pk_service_id']);?>
							<?php if($reviews){ ?>
								
							<ul class="comments-list">
							<?php foreach($reviews as $review){?>
                                    <li>
                                        <!-- REVIEW -->
                                        <article class="comment">
                                         
                                            <div class="comment-inner">
                                               <?=get_stars_html($review['rating'])?>
											   <span class="comment-author-name"><?=$review['name']?></span>
                                                <p class="comment-content"><?=$review['review']?></p>
                                            </div>
                                        </article>
                                    </li>
							<?php } ?>
                                    
                                </ul>
							<?php } ?>
                              
								<a class="popup-text btn btn-primary" href="#review-dialog" data-effect="mfp-zoom-out"><i class="fa fa-pencil"></i> Add a review</a>
                            </div>
                        </div>
                    </div>
                    <div class="gap"></div>
					<?php if($featured_services) { ?>
                    <h3>Related Services</h3>
                    <div class="gap gap-mini"></div>
                    <div class="row row-wrap">
					
					<?php $fp=0;
					foreach($featured_services as $service) { if($fp<3) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" style="max-width:100%"/>
                                </header>
                                <div class="product-inner">
                                    <?=get_rating_html('service',$service['pk_service_id'])?>	
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
					<?php } ?>
                    <div class="gap gap-small"></div>
                </div>
            </div>
			</div>

   