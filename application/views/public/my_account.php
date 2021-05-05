                <div class="col-md-3">
                    <aside class="sidebar-left">
                        <ul class="nav nav-pills nav-stacked nav-arrow">
                            <li class="active"><a href="<?=base_url('my-account')?>">Settings</a>
                            </li>
                            <li><a href="<?=base_url('my-addresses')?>">Address Book</a>
                            </li>
                            <li><a href="javascript:void(0);">Orders History</a>
                            </li>
                            <li><a href="javascript:void(0);">Wishlist</a>
                            </li>
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" value="<?=$profile['user_firstname']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" value="<?=$profile['user_lastname']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="text" value="<?=$profile['user_email']?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" value="<?=$profile['user_phone']?>" class="form-control">
                                </div>
                                <input type="submit" value="Save Changes" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                    <div class="gap"></div>
                </div>