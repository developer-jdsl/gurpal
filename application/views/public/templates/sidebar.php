      <div class="col-md-3">
                    <aside class="sidebar-left">
                        <h3 class="mb20">Top Services</h3>
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
						
						<?php 
		
						foreach($categories as $category) { ?>
						   <li><a href="<?=base_url('city/'.$this->session->city.'/services/'.$category['category_slug'])?>"><i class="p-2 <?php if($category['category_icon']) { echo $category['category_icon']; } ?>">
						   </i><?=$category['category_name']?></a>
                            </li>
						<?php } ?>
                       
                        </ul>

                        <h3 class="mb20">Product Categories</h3>
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
						
						<?php 
		
						foreach($pro_categories as $category) { ?>
						   <li><a href="<?=base_url('products/'.$category['category_slug'])?>"><i class="p-2 <?php if($category['category_icon']) { echo $category['category_icon']; } ?>">
						   </i><?=$category['category_name']?></a>
                            </li>
						<?php } ?>
                       
                        </ul>
                     
                        <div class="sidebar-box">
                            <h5>Popular Products</h5>
                            <ul class="thumb-list">
                                <?php $popular_products=get_popular_products(3);
							foreach($popular_products as $product) {
							?>
                                <li>
                                    <a href="<?=base_url('product/'.$product['product_slug'])?>">
									<?php if($product['product_image']) { ?>
                                        <img src="<?=base_url('uploads/product/'.$product['product_image'])?>" alt="<?=$product['product_name']?>" title="<?=$product['product_name']?>" />
									<?php } ?>
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="<?=base_url('product/'.$product['product_slug'])?>"><?=$product['product_name']?></a></h5>
                                        <p class="thumb-list-item-price"><?php if($product['discount_price']){ echo $product['discount_price'];} else { echo $product['original_price'];} ?></p>
                                    </div>
                                </li>
                               
                              <?php } ?>
						</ul></div>
                        <div class="sidebar-box">
						<h5>Popular Services</h5>
                            <ul class="thumb-list">
							  <?php $popular_services=get_popular_services(3);
							foreach($popular_services as $service) {
							?>
                                <li>
                                    <a href="<?=base_url('city/'.$this->session->city.'/service/'.$service['service_slug'])?>">
									<?php if($service['service_banners']) { ?>
                                        <img src="<?=base_url('uploads/service/'.$service['service_banners'])?>" alt="<?=$service['service_name']?>" title="<?=$service['service_name']?>" />
									<?php } ?>
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="<?=base_url('city/'.$this->session->city.'/service/'.$service['service_slug'])?>"><?=$service['service_name']?></a></h5>
                                        <p class="thumb-list-item-price"><?php if($service['discount_price']){ echo $service['discount_price'];} else { echo $service['original_price'];} ?></p>
                                    </div>
                                </li>
                               
                              <?php } ?>
                            </ul>
                        </div>
                  
                    </aside>
                </div>