    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                     <div class="col-lg-2"></div>					 
                    <div class="col-lg-8">
							<div class="p-5">
							<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4"><?=keyword_value('bussiness_regsiter','Bussiness Register')?></h1>
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

							<?php echo form_open('register/admin_front'); ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control form-control-user" name="mobile" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="conf_password" placeholder="Repeat Password" required>
                                    </div>
                                </div>
                            
								  <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            <?=keyword_value('register_account',' Register Account')?>
                                        </button>
                                <hr>
                             
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=base_url('authentication/forgot_password')?>">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?=base_url('authentication/admin')?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
	
	</div>
	</div>