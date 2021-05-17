      <div class="col-md-3">
                    <aside class="sidebar-left">
                        <h3 class="mb20">Top Services</h3>
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
						
						<?php 
		
						foreach($categories as $category) { ?>
						   <li><a href="<?=base_url('city/'.$this->session->city.'/services/'.$category['category_slug'])?>"><i class="fa p-2 <?php if($category['category_icon']) { echo $category['category_icon']; } ?>">
						   </i><?=$category['category_name']?></a>
                            </li>
						<?php } ?>
                     
                        </ul>

						<h3 class="mb20">Product Categories</h3>
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
						
						<?php 
		
						foreach($pro_categories as $category) { ?>
						   <li><a href="<?=base_url('products/'.$category['category_slug'])?>"><i class="fa p-2 <?php if($category['category_icon']) { echo $category['category_icon']; } ?>">						   
						   </i><?=$category['category_name']?></a>
                            </li>
						<?php } ?>
                     
                        </ul>

						                        <div class="sidebar-box">
                            <h5>Filter By Price</h5>
                            <input type="text" id="price_slider">
                        </div>
						
						<!--
                        <div class="sidebar-box">
                            <h5>Product Feature</h5>
                            <ul class="checkbox-list">
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" class="i-check">On Sale</label>
                                </li>
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" class="i-check">New</label>
                                </li>
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" class="i-check">Ending Soon</label>
                                </li>
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" class="i-check">High Rating</label>
                                </li>
                                <li class="checkbox">
                                    <label>
                                        <input type="checkbox" class="i-check">Free Shipping</label>
                                </li>
                            </ul>
                        </div>
                   -->
                       <div class="sidebar-box">
                            <h5>Popular</h5>
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
                            </ul>
                        </div>
                      
                    </aside>
                </div>
				
				<script>
				
			function filter_by_price(from,to)
			{
				var page_num = 0;
							var sortBy = $('#sort_by').val();
							
								var category = $('#hid_category').val();
							$.ajax({
								type: 'POST',
								url: '<?=base_url("product/ajax_list/"); ?>'+page_num,
								data:'page='+page_num+'&sortBy='+sortBy+'&from='+from+'&to='+to+'&category='+category+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								beforeSend: function(){
									$('.loading').show();
								},
								success: function(html){
									$('#product_ajax_div').html(html);
									$('.loading').fadeOut("slow");
											if(!category)
									{
										category='all';
									}
									
									var latest_url=updateQueryStringParameter(window.location.href,'price_from',from);
									latest_url=updateQueryStringParameter(latest_url,'price_to',to);
									
									var arr = latest_url.split("?");
								
									 if (history.pushState) {
										if(arr[1])
									{
											var newurl =  '<?=base_url();?>' + 'products/'+category+'?'+arr[1]; 
											
									}
									else
									{
										
										var newurl =  '<?=base_url();?>' + 'products/'+category;
									}
									
									  window.history.pushState({path:newurl},'',newurl);
								  }
								}
							});	
				
			}
			
			
				function sort_by()
			{
				var page_num = 0;
							var sortBy = $('#sort_by').val();
					
								var category = $('#hid_category').val();
							$.ajax({
								type: 'POST',
								url: '<?=base_url("product/ajax_list/"); ?>'+page_num,
								data:'page='+page_num+'&sort_by='+sortBy+'&category='+category+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								beforeSend: function(){
									$('.loading').show();
								},
								success: function(html){
									$('#product_ajax_div').html(html);
									$('.loading').fadeOut("slow");
											if(!category)
									{
										category='all';
									}
									
									var latest_url=updateQueryStringParameter(window.location.href,'sort_by',sortBy);
									var arr = latest_url.split("?");
								
									 if (history.pushState) {
										if(arr[1])
									{
											var newurl =  '<?=base_url();?>' + 'products/'+category+'?'+arr[1]; 
											
									}
									else
									{
										
										var newurl =  '<?=base_url();?>' + 'products/'+category;
									}
									
									  window.history.pushState({path:newurl},'',newurl);
								  }
								}
							});	
				
			}
				</script>