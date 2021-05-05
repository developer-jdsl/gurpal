                <div class="col-md-9">
                    <div id="product-quick-view-dialog" class="mfp-with-anim mfp-hide mfp-dialog mfp-dialog-big clearfix">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="fotorama" data-nav="thumbs" data-allowfullscreen="1" data-thumbheight="100" data-thumbwidth="100">
                                    <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="Gamer Chick" />
                                    <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="AMaze" />
                                    <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="Urbex Esch/Lux with Laney and Laaaaag" />
                                    <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="Food is Pride" />
                                </div>
                            </div>
                            <div class="col-md-5">
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
                                </ul><small><a class="text-muted" href="#">based on 8 reviews</a></small>
                                <h3>New Glass Collection</h3>
                                <p class="product-info-price">$150</p>
                                <p class="text-smaller text-muted">Nulla quisque mi duis ultricies class eu quisque at dictumst lacus per ad nullam placerat euismod enim massa eros litora primis lacus tincidunt mi urna luctus ridiculus fusce sem erat</p>
                                <ul class="icon-list">
                                    <li><i class="fa fa-check"></i>Orci eget</li>
                                    <li><i class="fa fa-check"></i>Sollicitudin sollicitudin</li>
                                    <li><i class="fa fa-check"></i>Praesent ante</li>
                                    <li><i class="fa fa-check"></i>Ac suscipit</li>
                                    <li><i class="fa fa-check"></i>Posuere cubilia</li>
                                </ul>
                                <ul class="list-inline">
                                    <li><a class="btn btn-primary" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                    </li>
                                    <li><a class="btn" href="#"><i class="fa fa-star"></i> To Wishlist</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr/><a class="btn btn-primary" href="#">More Details</a>
                    </div>
                    <div class="owl-carousel owl-slider" id="owl-carousel-slider" data-inner-pagination="true" data-white-pagination="true" data-nav="false">
					
					<?php foreach($banners as $banner) { ?>
					
					    <div>
                            <div class="bg-holder">
                                <img src="<?=base_url('uploads/banners/'.$banner['banner_image'])?>" alt="Banner" title="Banner" />
                                <div class="bg-mask"></div>
								<div class="bg-front vert-center text-white text-center">
                               <?=$banner['banner_text']?>
							   </div>
                            </div>
                        </div>
					
					<?php } ?>
                    </div>
                    <div class="gap"></div>
                    <div class="row row-wrap">
                        <div class="col-md-4">
                            <div class="product-banner">
                                <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="Gamer Chick" />
                                <div class="product-banner-inner">
                                    <h5>Playstation Accsories</h5><a class="btn btn-sm btn-white btn-ghost">Explore Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-banner">
                                <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="Urbex Esch/Lux with Laney and Laaaaag" />
                                <div class="product-banner-inner">
                                    <h5>Canon Cameras</h5><a class="btn btn-sm btn-white btn-ghost">Explore Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-banner">
                                <img src="<?=base_url('public/front/img/800x600.png')?>" alt="Image Alternative text" title="AMaze" />
                                <div class="product-banner-inner">
                                    <h5>New Glass Collections</h5><a class="btn btn-sm btn-white btn-ghost">Explore Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="gap gap-small"></div>
                    <h1 class="mb20">Featured Services<small><a href="<?=base_url('city/'.$this->session->city.'/services/all')?>">View All</a></small></h1>
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
					
					<p align="center">No services found in your city.</p>
					<?php }?>

                 </div>
 
        
           
                    <div class="gap gap-small"></div>
                    <h1 class="mb20">Featured Products <small><a href="<?=base_url('products/all')?>">View All</a></small></h1>
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
					
					
					<h1 class="mb20">Brands <small><a href="#">View All</a></small></h1>
					<div class="row">
					<?php $cnt=0;
					foreach($brands as $brand) { 
					
					if($cnt<6){?>
					
					        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6 thumb">
                                 <div class="thumb-inside">
                                    <a class="thumbnail" href="#"> <img class="img-responsive" src="<?=base_url('uploads/brands/'.$brand['brand_image'])?>" alt=""> </a> <span class="favorite"><a href="#" data-toggle="tooltip" data-placement="left" title="" data-original-title="Save store"><i class="ti-heart"></i></a></span> 
                                 </div>
                                 <div class="store_name text-center">
                                    <h5><?=$brand['brand_name']?></h5>
                                 </div>
                              </div>
					
					<?php }  $cnt++;}?>
                             
                              <!-- /thumb -->
                           </div>
                </div>
            </div>

        </div>
		<?php if(@$this->session->flashdata('lflag')=='login') { ?>
		<script>
		function open_login()
		{
			$('#login_li').click();
		}
		open_login();
		</script>
		<?php } ?>