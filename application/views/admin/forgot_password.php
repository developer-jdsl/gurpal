<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('public/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url('public/css/sb-admin-2.min.css')?>" rel="stylesheet">

</head>
<body class="bg-gradient-primary">
  <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?=keyword_value('forgot_password','Forgot Password')?></h1>
                                    </div>
                                    <?php echo validation_errors();
									if(!empty($this->session->flashdata('msg'))){ ?>
							<div class="alert alert-info alert-dismissible fade show" role="alert">
											  <?=$this->session->flashdata('msg')?>
											  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
											
											<?php } ?>
									<?php echo form_open('authentication/forgot_password'); ?>
									
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="<?=keyword_value('enter_email','Enter Registered Email Address...')?>" required>
                                        </div>
										
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            <?=keyword_value('send_reset_link','Send Reset Link')?>
                                        </button>
                                    </form>
                                    <hr>
                                   <div class="text-center">
                                <a class="small" href="<?=base_url('authentication/admin')?>">Login </a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?=base_url('register/admin')?>">Create Account</a>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
	
	    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('public/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?=base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('public/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('public/js/sb-admin-2.min.js')?>"></script>

</body>

</html>