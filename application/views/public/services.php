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
					<div id="service_ajax_div">
                    <div class="row row-wrap">
					
					<?php if($services) {
						foreach($services as $service) { ?>
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
					<?php } }
					
					else{?>
						<p align="center">No record Found</p>
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
					
					
                    <div class="gap"></div>
                </div>
				
				</div>
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
											var newurl =  '<?=base_url();?>'+'city/'+ city+ '/services/'+category+'/'+page_num+qstring;
										 }
										 else
										 {
											var newurl =  '<?=base_url();?>' + 'city/'+ city+ '/services/'+category+'/'+qstring; 
										 }
									  window.history.pushState({path:newurl},'',newurl);
								  }
								}
								
							});
						}
						
						var service_price_from='<?=$this->input->get("from")?$this->input->get("from"):"500"?>';
						var service_price_to='<?=$this->input->get("to")?$this->input->get("to"):"2000"?>';
				</script>