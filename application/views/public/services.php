                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-sort">
                                <span class="product-sort-selected">sort by <b>Name</b></span>
                                <a href="#" class="product-sort-order fa fa-angle-down"></a>
                                <ul>
                                    <li><a href="#">sort by Price</a>
                                    </li>
                                    <li><a href="#">sort by Date</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-offset-7">
                            <div class="product-view pull-right">
                                <a class="fa fa-th-large active" href="#"></a>
                                <a class="fa fa-list" href="category-page-thumbnails-shop-horizontal.html"></a>
                            </div>
                        </div>
                    </div>
					<div id="service_ajax_div">
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
                   <!--
				   <ul class="pagination">
                        <li class="prev disabled">
                            <a href="#"></a>
                        </li>
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li class="next">
                            <a href="#"></a>
                        </li>
                    </ul>
					-->
					
					<?php echo $this->ajax_pagination->create_links(); ?>
					</div>
					
					<div class="loading" style="display: none;">
						<div class="content"><img src="<?php echo base_url('public/front/img/loading.gif'); ?>"/></div>
					</div>
                    <div class="gap"></div>
                </div>
				
				<input type="hidden" id="hid_city" value="<?=$city?>">
				
				<input type="hidden" id="hid_category" value="<?=$category?>">

				<script>
						function service_ajax(page_num){
							page_num = page_num?page_num:0;
							var sortBy = $('#sortBy').val();
							  var city = $('#hid_city').val();
								var category = $('#hid_category').val();
							$.ajax({
								type: 'POST',
								url: '<?=base_url("service/ajax_list/"); ?>'+page_num,
								data:'page='+page_num+'&sortBy='+sortBy+'&city='+city+'&category='+category+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								beforeSend: function(){
									$('.loading').show();
								},
								success: function(html){
									$('#service_ajax_div').html(html);
									$('.loading').fadeOut("slow");
								}
							});
						}
				</script>