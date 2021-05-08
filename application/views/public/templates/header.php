<!DOCTYPE HTML>
<html>
<head>
    <title><?=@$title?></title>
    <!-- meta info -->
    <meta name="keywords" content="<?=@$meta_keywords?>" />
    <meta name="description" content="<?=@$meta_description?>">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'>
    <!-- Bootstrap styles -->
    <link rel="stylesheet" href="<?=base_url('public/front/css/boostrap.css')?>">
    <!-- Font Awesome styles (icons) -->
    <link rel="stylesheet" href="<?=base_url('public/front/css/font_awesome.css')?>">
    <!-- Main Template styles -->
    <link rel="stylesheet" href="<?=base_url('public/front/css/styles.css')?>">
    <!-- IE 8 Fallback -->
    <!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Your custom styles (blank file) -->
    <link rel="stylesheet" href="<?=base_url('public/front/css/mystyles.css')?>">
<script> var base_url="<?=base_url()?>"; </script>

</head>

<body>


    <div class="global-wrap">


        <!-- //////////////////////////////////
	//////////////MAIN HEADER///////////// 
	////////////////////////////////////-->
        <div class="top-main-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <a href="<?=base_url()?>" class="logo mt5">
                            <img src="<?=base_url('public/front/img/logo-small-dark.png')?>" alt="Image Alternative text" title="Image Title" />
                        </a>
                    </div>
                    <div class="col-md-6 col-md-offset-4">
                        <div class="pull-right">
                            <ul class="header-features">
                                <li><i class="fa fa-phone"></i>
                                    <div class="header-feature-caption">
                                        <h5 class="header-feature-title">+1-202-555-0140</h5>
                                        <p class="header-feature-sub-title">24/7 phone assistance</p>
                                    </div>
                                </li>
                                <li><i class="fa fa-truck"></i>
                                    <div class="header-feature-caption">
                                        <h5 class="header-feature-title">Free Delivery</h5>
                                        <p class="header-feature-sub-title">on all orders over $100</p>
                                    </div>
                                </li>
                                <li><i class="fa fa-asterisk"></i>
                                    <div class="header-feature-caption">
                                        <h5 class="header-feature-title">Huge Bonuses</h5>
                                        <p class="header-feature-sub-title">shopping with ease</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="flexnav-menu-button" id="flexnav-menu-button">Menu</div>
                        <nav>
                            <ul class="nav nav-pills flexnav" id="flexnav" data-breakpoint="800">
                                <li class="active"><a href="<?=base_url()?>">Home</a>
                                </li>
                                <li><a href="<?=base_url('city/'.$this->session->city.'/services/all')?>">Services</a>
								<?=service_cats_menu_li();?>
                                </li>
                                <li><a href="<?=base_url('products/all')?>">Product </a>
                                 <?=product_cats_menu_li();?>
                                </li>
								<li><a href="#">About us</a>
                                </li>
										
                                <li><a href="#">Contact</a>
                                </li>
								<li><a href="#">Blog</a>
                                    
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-6">
                        <ul class="login-register">
                            <li class="shopping-cart"><a href="<?=base_url('cart')?>"><i class="fa fa-shopping-cart"></i>My Cart</a>
                                <div class="shopping-cart-box">
								<?php $header_cart_data=get_cart_data();?>
                                    <ul class="shopping-cart-items">
									<?php if($header_cart_data) { 
									$hflag=0;
									foreach($header_cart_data as $hcd) { 
										$hflag=1;?>
                                        <li>
                                            <a href="<?=$hcd['item_slug']?>">
                                                <img src="<?=$hcd['item_image']?>" alt="<?=$hcd['item_name']?>" title="<?=$hcd['item_name']?>" />
                                                <h5><?=$hcd['item_name']?></h5><span class="shopping-cart-item-price">₹<?=$hcd['item_qty']*$hcd['item_price']?> (x<?=$hcd['item_qty']?>)</span>
                                            </a>
                                        </li>
									<?php } } else { ?>
										<li><p align="center">Your cart is empty</p></li>
										
										<?php } ?>
                                    </ul>
									<?php if(@$hflag==1) { ?>
                                    <ul class="list-inline text-center">
                                        <li><a href="<?=base_url('cart')?>"><i class="fa fa-shopping-cart"></i> View Cart</a>
                                        </li>
                                        <li><a href="<?=base_url('checkout')?>"><i class="fa fa-check-square"></i> Checkout</a>
                                        </li>
                                    </ul>
									
									<?php } ?>
                                </div>
                            </li>
							<?php if($this->session->front_user_id){?>
							<li><a href="<?=base_url('my-account')?>" ><i class="fa fa-user"></i>My Account</a>
                            </li>
							<li><a href="<?=base_url('logout')?>" ><i class="fa fa-power-off"></i>Logout</a>
                            </li>
							<?php } else {?>
                            <li><a class="popup-text" id="login_li" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>Sign in</a>
                            </li>
                            <li><a class="popup-text" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>Sign up</a>
                            </li>
							<?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- LOGIN REGISTER LINKS CONTENT -->
        <div id="login-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-sign-in dialog-icon"></i>
            <h3>Login</h3>
			 <h5 id="login_message"></h5>
            <form class="dialog-form">
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="email"  id="login_email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="login_password" class="form-control">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                </div>
                <p align="center"><input type="button" value="Sign in" onclick="user_login();" class="btn btn-primary"></p>
				<p align="center">Or</p>
				
            </form>
			<div class="social-login p-40">
                                    <div class="mb-20">
                                        <button class="btn btn-lg btn-block btn-social btn-facebook"><i class="fa fa-facebook-square"></i>Sign In with Facebook</button>
                                    </div>
                                    <div class="mb-20">
                                        <button class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-twitter"></i>Sign In with Twitter</button>
                                    </div>
                                    <div class="mb-20">
                                        <button class="btn btn-lg btn-block btn-social btn-google-plus"><i class="fa fa-google-plus"></i>Sign In with Google</button>
                                    </div>
                                </div>
			<br>
            <ul class="dialog-alt-links">
                <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">Not member yet</a>
                </li>
                <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">Forgot password</a>
                </li>
            </ul>
        </div>
		<script>
		
		function user_signup()
		{
			$('#reg_message').html();
			var fname=$('#reg_first_name').val();
			var lname=$('#reg_last_name').val();
			var email=$('#reg_email').val();
			var mobile=$('#reg_mobile').val();
			var pass=$('#reg_password').val();
			var cpass=$('#reg_password_confirm').val();
			if(fname && lname && email && mobile && pass && cpass)
			{
						$.ajax({
								type: 'POST',
								url: '<?=base_url("home/user_register"); ?>',
								data:'reg_first_name='+fname+'&reg_last_name='+lname+'&reg_email='+email+'&reg_mobile='+mobile+'&reg_password='+pass+'&reg_password_conf='+cpass+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								success: function(html){
									if(html){
										var obj = JSON.parse(html);
										if(obj.status==true)
										{
											$('#reg_message').html(obj.message);
											window.location.href="<?=base_url('my-account')?>";
										}
										else
										{
											$('#reg_message').html(obj.message);
										}
									
									}
									else
									{
										$('#reg_message').html('Error Occured, Try again after sometime');
										
									}
								  
								}
							});
				
			}
			else
			{
				$('reg_message').html('Fill all(*) required fields ');
			}
			
		}
		
				function user_login()
		{
			$('#login_message').html();
			var email=$('#login_email').val();
			var pass=$('#login_password').val();

			if(email && pass)
			{
						$.ajax({
								type: 'POST',
								url: '<?=base_url("home/user_login"); ?>',
								data:'login_email='+email+'&login_password='+pass+'&<?=$this->security->get_csrf_token_name()?>=<?=$this->security->get_csrf_hash()?>',
								success: function(html){
									if(html){
										var obj = JSON.parse(html);
										if(obj.status==true)
										{
											$('#login_message').html(obj.message);
											window.location.href="<?=base_url('my-account')?>";
										}
										else
										{
											$('#login_message').html(obj.message);
										}
									
									}
									else
									{
										$('#login_message').html('Error Occured, Try again after sometime');
										
									}
								  
								}
							});
				
			}
			else
			{
				$('login_message').html('Fill all(*) required fields ');
			}
			
		}
		</script>

        <div id="register-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-edit dialog-icon"></i>
            <h3>Register</h3>

			<h5 id="reg_message" style="color:brown"></h5>
            <form class="dialog-form">
			<div class="row">
				<div class="col-md-6">
			  <div class="form-group ">
                    <label>First Name *</label>
                    <input type="text" class="form-control" id="reg_first_name" required>
                </div>
				</div>
				<div class="col-md-6">
				 <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" class="form-control" id="reg_last_name" required>
                </div>
			</div>
			</div>
                <div class="form-group">
                    <label>E-mail *</label>
                    <input type="email" id="reg_email" class="form-control" required>
                </div>
				<div class="form-group">
                    <label>Mobile (without ISD code)</label>
                    <input type="tel" id="reg_mobile" class="form-control" >
                </div>
                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" id="reg_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Repeat Password *</label>
                    <input type="password" id="reg_password_confirm" class="form-control" required>
                </div>

				<a href="javascript:void(0);" class="btn btn-primary" onclick="user_signup();">Sign up<a>
            </form>
            <ul class="dialog-alt-links">
                <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Already member</a>
                </li>
            </ul>
        
		</div>
		
		



        <div id="password-recover-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="icon-retweet dialog-icon"></i>
            <h3>Password Recovery</h3>
            <h5>Fortgot your password? Don't worry we can deal with it</h5>
            <form class="dialog-form">
                <label>E-mail</label>
                <input type="email" id="forgot_email"class="span12">
                <input type="submit" value="Request new password" class="btn btn-primary">
            </form>
        </div>
        <!-- END LOGIN REGISTER LINKS CONTENT -->



        <!-- SEARCH AREA -->

		<?php echo form_open(base_url('city/'.$this->session->city), 'class="search-area form-group search-area-white"'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 clearfix">
                        <label><i class="fa fa-search"></i><span>I am searching for</span>
                        </label>
                        <div class="search-area-division search-area-division-input">
                            <input class="form-control" type="text" placeholder="Travel Vacation" name="search" required/>
                        </div>
                    </div>
                    <div class="col-md-3 clearfix">
                        <label><i class="fa fa-map-marker"></i><span>In</span>
                        </label>
                        <div class="search-area-division search-area-division-location">
                    
							<select class="form-control select2" name="city">
							<?php foreach($cities as $city) { ?>
							<option value="<?=$city['city_slug']?>" <?php if($this->session->city==$city['city_slug']) { echo 'selected'; } ?> > <?=$city['city_name']?></option>
							<?php } ?>
							</select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-block btn-white search-btn" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- END SEARCH AREA -->

        <div class="gap"></div>


        <!-- //////////////////////////////////
	//////////////END MAIN HEADER////////// 
	////////////////////////////////////-->


        <!-- //////////////////////////////////
	//////////////PAGE CONTENT///////////// 
	////////////////////////////////////-->

 <div class="container">
            <div class="row">
                  