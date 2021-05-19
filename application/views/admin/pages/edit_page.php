<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?=keyword_value('Edit_page','Edit Page')?></h1>
					<a href="<?=base_url('admin/pages')?>" class="btn btn-primary text-right"><?=keyword_value('back','Back')?></a>
					<?php if($msg=$this->session->flashdata('msg')){?>
						  <div class="alert alert-primary alert-dismissible fade show" role="alert">
						  <?=$msg?>
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
					<?php } ?>
  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 mc col-md-11">
                       
                        <div class="card-body">
                            <?php echo validation_errors();?>

									<?php echo form_open_multipart('admin/update_page'); ?>
									
										<div class="row">
											<div class="col-md-6">
											 <div class="form-group">
												<label><?=keyword_value('page_name','Page Name')?></label>
													<input type="text" name="page_name" class="form-control form-control-user" value="<?=$results['page_name']?>" required>
												</div>
									
											
												
											
												   <div class="form-group">
										<label><?=keyword_value('status','Status')?></label>
										<select name="active" class="form-control form-control-user">
										<option value="1" <?php if($results['active']==1) { echo 'selected';} ?>>Active</option>
										<option value="0" <?php if($results['active']==0) { echo 'selected';} ?>>Inactive</option>
										</select>
                              
                                        </div>
										
											   <div class="form-group">
										<label><?=keyword_value('show_on_menu','Show On Menu')?></label>
										<select name="show_on_menu" class="form-control form-control-user">
										<option value="1" <?php if($results['show_on_menu']==1) { echo 'selected';} ?>>Yes</option>
										<option value="0" <?php if($results['show_on_menu']==0) { echo 'selected';} ?>>No</option>
										</select>
                              
                                        </div>
										
										<div class="form-group">
												<label><?=keyword_value('page_slug','Slug')?></label>
													<input type="text" name="page_slug" class="form-control form-control-user" value="<?=$results['page_slug']?>" >
												</div>
					
												
											
										
										<div class="form-group">
												<label><?=keyword_value('ordering','Ordering')?></label>
													<input type="number" name="ordering" class="form-control form-control-user" value="<?=$results['ordering']?>" >
												</div>
											</div>
											
										<div class="col-md-6">
										
								
										
										 <div class="form-group">
												<label><?=keyword_value('meta_title','Meta Title')?></label>
													<input type="text" name="meta_title" class="form-control form-control-user" value="<?=$results['meta_title']?>"  >
												</div>
												
												 <div class="form-group">
												<label><?=keyword_value('meta_keywords','Meta Keywords')?></label>
													<input type="text" name="meta_keywords" class="form-control form-control-user" value="<?=$results['meta_keywords']?>"  >
												</div>
												
												
												 <div class="form-group">
												<label><?=keyword_value('meta_description','Meta Description')?></label>
											
													<textarea name="meta_description" class="form-control form-control-user" rows="8"><?=$results['meta_description']?></textarea>
												</div>
												
					
												
											</div>
											
												
												
												
											</div>
											
											<div class="col-md-12">
												
												 <div class="form-group">
												<label><?=keyword_value('page_content','Page Content')?></label>
											
													<textarea name="page_content"   class="form-control form-control-user editor" rows="10"><?=$results['page_content']?></textarea>
												</div>
											
											</div>
											
										
										</div>
										
										<input type="hidden" name="id" value="<?=$results['pk_page_id']?>">
                                        <button  type="submit" class="btn btn-primary btn-user btn-block">
                                            <?=keyword_value('submit','Submit')?>
                                        </button>
                                    </form>
							
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
	