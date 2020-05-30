            <div class="page-header clear-filter" filter-color="orange"> 
              <div class="page-header-image" style="background-image:url(http://passcontest2.te/resources/img/ryan.jpg)"></div> 
              <div class="content"> 
                <div class="container"> 
                  <div class="col-md-4 ml-auto mr-auto"> 
                    <div class="card card-login card-plain"> 
                      <?php echo form_open('access/signup', ['id' => 'signup_form']); ?>
                        <div class="card-header text-center"> 
                          <div class="logo-container mb-5"> 
                            <img src="http://passcontest2.te/resources/img/ryan.jpg" alt=""> 
                          </div>  
                        </div> 
                        <div class="card-body pass-md"> 

                          <?php echo $this->session->flashdata('username_msg'); ?>
                          <?php echo form_error('username'); ?>
                          <div class="input-group no-border input-lg" id="username-block"> 
                            <div class="input-group-prepend"> 
                              <span class="input-group-text"> 
                                <i class="fa fa-user-circle"></i> 
                              </span> 
                            </div> 
                            <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Username (or email)"> 
                          </div> 

                          <?php echo $this->session->flashdata('email_msg'); ?>
                          <?php echo form_error('email'); ?>
                          <div class="input-group no-border input-lg" id="email-block"> 
                            <div class="input-group-prepend"> 
                              <span class="input-group-text"> 
                                <i class="fa fa-at"></i> 
                              </span> 
                            </div> 
                            <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Username (or email)"> 
                          </div>  

                          <?php echo $this->session->flashdata('password_msg'); ?>
                          <?php echo form_error('password'); ?>
                          <div class="input-group no-border input-lg" id="password-block"> 
                            <div class="input-group-prepend"> 
                              <span class="input-group-text"> 
                                <i class="fa fa-key"></i> 
                              </span> 
                            </div> 
                            <input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" class="form-control" /> 
                          </div> 
                        </div> 
                        <div class="card-footer text-center"> 
                          <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Signup</button> 
                          <div class="pull-left"> 
                            <h6> <a href="<?php echo site_url('access/login'); ?>" class="link">Already Registered</a> </h6> 
                          </div> 
                          <div class="pull-right"> 
                            <h6> <a href="#pablo" class="link">Need Help?</a> </h6> 
                          </div> 
                        </div> 
                      <?php echo form_close(); ?>
                    </div> 
                  </div> 
                </div> 
              </div> 
            </div>
