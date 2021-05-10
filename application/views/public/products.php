                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-sort">
							<select class="form-control" id="sort_by" onchange="sort_by();">
							<option value="">Sort by
							<option value="name" <?php if($this->input->get('sort_by')=='name'){echo 'selected';}?> >Sort by Name</option>
							<option value="price" <?php if($this->input->get('sort_by')=='price'){echo 'selected';}?>>Sort by Price</option>
							</select>
                                
                            </div>
                        </div>
                        <div class="col-md-2 col-md-offset-7">
                            <div class="product-view pull-right">
                                <a class="fa fa-th-large active" href="#"></a>
                                <a class="fa fa-list" href="#"></a>
                            </div>
                        </div>
                    </div>
					<div id="product_ajax_div">
                    <div class="row row-wrap">
					
					<?php if($products) {
						foreach($products as $product) { ?>
                        <div class="col-md-4">
                            <div class="product-thumb">
                                <header class="product-header">
                                    <img src="<?=base_url('uploads/product/'.$product['product_image'])?>" alt="<?=$product['product_name']?>" title="<?=$product['product_name']?>" />
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
                                    <h5 class="product-title"><?=$product['product_name']?></h5>
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
                                        <p class="product-category"><i class="fa fa-tag"></i><?=$product['category_name']?></p>
                                        <ul class="product-actions-list">
                                            <li><a class="btn btn-sm add_to_cart_list" data-id="<?=$product['pk_price_id']?>" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> To Cart</a>
                                            </li>
                                            <li><a class="btn btn-sm" href="<?=base_url('product/'.$product['product_slug'])?>"><i class="fa fa-bars"></i> Details</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php } }
					
					else{?>
						<p align="center">No record Found</p>
					<?php } ?>
                    </div>					
					<?php echo $this->ajax_pagination->create_links(); ?>
					</div>
					
					
                    <div class="gap"></div>
                </div>
			</div>
			</div>
				
				<input type="hidden" id="hid_category" value="<?=$category?>">

				<script>
						function product_ajax(page_num){
							page_num = page_num?page_num:0;
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
						
									var latest_url=window.location.href;
									if(sortBy)
									{
										latest_url=updateQueryStringParameter(window.location.href,'sort_by',sortBy);
									}
									
									var arr = latest_url.split("?");
									var qstring="";
									if(arr[1])
									{
										var qstring="?"+arr[1];
									}
									 if (history.pushState) {
										 if(page_num>0)
										 {
											var newurl =  '<?=base_url();?>'+'products/'+category+'/'+page_num+qstring;
										 }
										 else
										 {
											var newurl =  '<?=base_url();?>' + 'products/'+category+'/'+qstring; 
										 }
									  window.history.pushState({path:newurl},'',newurl);
								  }
								}
								
							});
						}
						
						var service_price_from='<?=$this->input->get("from")?$this->input->get("from"):"500"?>';
						var service_price_to='<?=$this->input->get("to")?$this->input->get("to"):"2000"?>';
				</script>