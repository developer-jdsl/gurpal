      <div class="col-md-3">
                    <aside class="sidebar-left">
                        <h3 class="mb20">I am looking for</h3>
                        <ul class="nav nav-tabs nav-stacked nav-coupon-category nav-coupon-category-left">
						
						<?php 
		
						foreach($categories as $category) { ?>
						   <li><a href="<?=base_url('city/'.$this->session->city.'/services/'.$category['category_slug'])?>"><i class="fa p-2">
						<?php if($category['category_image']) { ?> <img src="<?=base_url('uploads/category/'.$category['category_image'])?>" width="20px"> <?php } ?>
						   </i><?=$category['category_name']?></a>
                            </li>
						<?php } ?>
                     
                        </ul>
						                        <div class="sidebar-box">
                            <h5>Filter By Price</h5>
                            <input type="text" id="price_slider">
                        </div>
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
                        <div class="sidebar-box">
                            <h5>Recent Viewed</h5>
                            <ul class="thumb-list">
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="Urbex Esch/Lux with Laney and Laaaaag" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="#">Best Camera</a></h5>
                                        <p class="thumb-list-item-price">$384</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="AMaze" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="#">New Glass Collection</a></h5>
                                        <p class="thumb-list-item-price">$351</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="waipio valley" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="#">Awesome Vacation</a></h5>
                                        <p class="thumb-list-item-price">$500</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-box">
                            <h5>Popular</h5>
                            <ul class="thumb-list">
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="Food is Pride" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="#">Best Pasta</a></h5>
                                        <p class="thumb-list-item-price">$312</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="Old No7" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="#">Jack Daniels Huge Pack</a></h5>
                                        <p class="thumb-list-item-price">$447</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="The Hidden Power of the Heart" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <h5 class="thumb-list-item-title"><a href="#">Beach Holidays</a></h5>
                                        <p class="thumb-list-item-price">$195</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-box">
                            <h5>Recent Reviews</h5>
                            <ul class="thumb-list">
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="Hot mixer" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <ul class="icon-group icon-list-rating" title="4/5 rating">
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star-o"></i>
                                            </li>
                                        </ul>
                                        <h5 class="thumb-list-item-title"><a href="#">Modern DJ Set</a></h5>
                                        <p class="thumb-list-item-author">by Richard Jones</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="Our Coffee miss u" />
                                    </a>
                                    <div class="thumb-list-item-caption">
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
                                        <h5 class="thumb-list-item-title"><a href="#">Coffe Shop Discount</a></h5>
                                        <p class="thumb-list-item-author">by Carol Blevins</p>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?=base_url('public/front/img/70x70.png')?>" alt="Image Alternative text" title="Food is Pride" />
                                    </a>
                                    <div class="thumb-list-item-caption">
                                        <ul class="icon-group icon-list-rating" title="3/5 rating">
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star-o"></i>
                                            </li>
                                            <li><i class="fa fa-star-o"></i>
                                            </li>
                                        </ul>
                                        <h5 class="thumb-list-item-title"><a href="#">Best Pasta</a></h5>
                                        <p class="thumb-list-item-author">by Bernadette Cornish</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
				
				<script>
				
			function filter_by_price(from,to)
			{
				var page_num = 0;
							var sortBy = $('#sort_by').val();
							  var city = $('#hid_city').val();
								var category = $('#hid_category').val();
							$.ajax({
								type: 'POST',
								url: '<?=base_url("service/ajax_list/"); ?>'+page_num,
								data:'page='+page_num+'&sortBy='+sortBy+'&city='+city+'&from='+from+'&to='+to+'&category='+category+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								beforeSend: function(){
									$('.loading').show();
								},
								success: function(html){
									$('#service_ajax_div').html(html);
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
											var newurl =  '<?=base_url();?>' + 'city/'+ city+ '/services/'+category+'?'+arr[1]; 
											
									}
									else
									{
										
										var newurl =  '<?=base_url();?>' + 'city/'+ city+ '/services/'+category;
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
							  var city = $('#hid_city').val();
								var category = $('#hid_category').val();
							$.ajax({
								type: 'POST',
								url: '<?=base_url("service/ajax_list/"); ?>'+page_num,
								data:'page='+page_num+'&sort_by='+sortBy+'&city='+city+'&category='+category+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								beforeSend: function(){
									$('.loading').show();
								},
								success: function(html){
									$('#service_ajax_div').html(html);
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
											var newurl =  '<?=base_url();?>' + 'city/'+ city+ '/services/'+category+'?'+arr[1]; 
											
									}
									else
									{
										
										var newurl =  '<?=base_url();?>' + 'city/'+ city+ '/services/'+category;
									}
									
									  window.history.pushState({path:newurl},'',newurl);
								  }
								}
							});	
				
			}
				</script>