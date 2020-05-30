      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8"> 
            <div class="card">
              <div class="card-header"> 
                <h5 class="float-right title text-primary"><?= ucwords($step ? $step . ' ' . lang('configuration') : ''); ?></h5>
                <h5 class="title"><?=lang($page_title); ?></h5>
     
                <h7 class="title text-info"><? = //$contest['title']; ?></h7>
     
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <?= $this->session->flashdata('msg'); ?> <?php //echo validation_errors(); ?>
                  </div>
                </div> 

                <div class="collections container">
                            
                  <?php $switch = ($this->input->post() ? 1 : null) ?> 

                  <?php echo form_open(uri_string(), ['id' => 'paform', 'class' => 'needs-validation', 'novalidate' => null]); ?>

                    <?php if ($enable_steps && $step === 'main'): ?> 
                    <input type="hidden" name="step" value="main">
                    <label class="font-weight-bold" for="basic_block">Main Configuration</label>
                    <hr class="my-0">
                    <div class="form-row p-3 mb-3" id="basic_block"> 
                      <div class="form-group col-md-12">
                        <label class="text-info" for="site_name">Site Name</label>
                        <input type="text" name="value[site_name]" value="<?= set_value_switch('value[site_name]', my_config('site_name')) ?>" class="form-control" >
                        <small class="text-muted">The name of this website</small>
                        <?php echo form_error('value[site_name]'); ?>
                      </div> 

                      <div class="form-group col-md-12">
                        <label class="text-info" for="password">Primary Server</label>
                        <input type="text" name="value[primary_server]" value="<?= set_value_switch('value[primary_server]', my_config('primary_server')) ?>" class="form-control" >
                        <small class="text-muted">The server domain from where all products will be hosted</small>
                        <?php echo form_error('value[primary_server]'); ?>
                      </div> 

                      <div class="form-group col-md-12">
                        <label class="text-info" for="password">Server Directory</label>
                        <input type="text" name="value[server_dir]" value="<?= set_value_switch('value[server_dir]', my_config('server_dir')) ?>" class="form-control" >
                        <small class="text-muted">Directory on the server relative to the root dir</small>
                        <?php echo form_error('value[server_dir]'); ?>
                      </div>  

                      <div class="form-group col-md-6">
                        <label class="text-info" for="ip_interval">IP Update Interval</label>
                        <input type="text" name="value[ip_interval]" value="<?= set_value_switch('value[ip_interval]', my_config('ip_interval'))?>" class="form-control" >
                        <small class="text-muted">Time interval in hours before a guest user can vote again</small>
                        <?php echo form_error('value[ip_interval]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="restrict_creation">Restrict Contest Creation</label> 
                        <select class="form-control" name="value[restrict_creation]">
                          <option value="1" <?= set_select('value[restrict_creation]', 1, int_bool(my_config('restrict_creation')))?>>Yes</option>
                          <option value="0" <?= set_select('value[restrict_creation]', 0, int_bool(!my_config('restrict_creation')))?>>No</option> 
                        </select>
                        <small class="text-muted">Limit contest creation to preset contest creators only</small>
                        <?php echo form_error('value[restrict_creation]'); ?>
                      </div>
                    </div>
                    <?php endif; ?> 


                    <?php if ($enable_steps &&  $step === 'payment'): ?> 
                    <input type="hidden" name="step" value="payment">
                    <label class="font-weight-bold" for="payment_block">Payment Settings</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="payment_block"> 
                      <div class="form-group col-md-6">
                        <label class="text-info" for="password">Site Currency</label>
                        <input type="text" name="value[site_currency]" value="<?= set_value_switch('value[site_currency]', my_config('site_currency')) ?>" class="form-control" >
                        <small class="text-muted">The base currency for all purchases originating from this site (E.g USD)</small>
                        <?php echo form_error('value[site_currency]'); ?>
                      </div>  

                      <div class="form-group col-md-6">
                        <label class="text-info" for="password">Currency Symbol</label>
                        <input type="text" name="value[currency_symbol]" value="<?= set_value_switch('value[currency_symbol]', my_config('currency_symbol')) ?>" class="form-control" >
                        <small class="text-muted">The symbol for the base currency</small>
                        <?php echo form_error('value[currency_symbol]'); ?>
                      </div>  

                      <div class="form-group col-md-6">
                        <label class="text-info" for="credit_name">Voting Credit Name</label>
                        <input type="text" name="value[credit_name]" value="<?= set_value_switch('value[credit_name]', my_config('credit_name')) ?>" class="form-control" >
                        <small class="text-muted">What is the name of the site voting currency (Voting Credit)</small>
                        <?php echo form_error('value[credit_name]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="credit_code">Credit Code</label>
                        <input type="text" name="value[credit_code]" value="<?= set_value_switch('value[credit_code]', my_config('credit_code')) ?>" class="form-control" >
                        <small class="text-muted">Letter code of the site voting currency (Voting Credit)</small>
                        <?php echo form_error('value[credit_code]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="credit_rate">Credit Rate</label>
                        <input type="text" name="value[credit_rate]" value="<?= set_value_switch('value[credit_rate]', my_config('credit_rate')) ?>" class="form-control" >
                        <small class="text-muted">The exchange rate of the site voting currency (Voting Credit) against the site currency</small>
                        <?php echo form_error('value[credit_rate]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="credit_bonus">Credit Bonus</label>
                        <input type="text" name="value[credit_bonus]" value="<?= set_value_switch('value[credit_bonus]', my_config('credit_bonus')) ?>" class="form-control" >
                        <small class="text-muted">Amount of voting credit given to users after registration and after credit purchase as bonus</small>
                        <?php echo form_error('value[credit_bonus]'); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <label class="text-info" for="credit_units">Available Credit Units (Comma Separated E.g 1000,500, 100)</label>
                        <input type="text" name="value[credit_units]" value="<?= set_value_switch('value[credit_units]', my_config('credit_units')) ?>" class="form-control" >
                        <small class="text-muted">Credit Units available for token creation and purchase</small>
                        <?php echo form_error('value[credit_units]'); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <label class="text-info" for="password">Payment Reference Prefix</label>
                        <input type="text" name="value[payment_ref_pref]" value="<?= set_value_switch('value[payment_ref_pref]', my_config('payment_ref_pref')) ?>" class="form-control" >
                        <small class="text-muted">The prefix for generated payment reference</small>
                        <?php echo form_error('value[payment_ref_pref]'); ?>
                      </div> 

                      <div class="form-group col-md-12">
                        <label class="text-info" for="paystack_public">Paystack Public Key</label>
                        <input type="text" name="value[paystack_public]" value="<?= set_value_switch('value[paystack_public]', my_config('paystack_public')) ?>" class="form-control" > 
                        <?php echo form_error('value[paystack_public]'); ?>
                      </div>  

                      <div class="form-group col-md-12">
                        <label class="text-info" for="paystack_secret">Paystack Secret Key</label>
                        <input type="text" name="value[paystack_secret]" value="<?= set_value_switch('value[paystack_secret]', my_config('paystack_secret')) ?>" class="form-control" > 
                        <?php echo form_error('value[paystack_secret]'); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <label class="text-info" for="checkout_info">Checkout Info</label>
                        <textarea name="value[checkout_info]" class="form-control" ><?= set_value_switch('value[checkout_info]', my_config('checkout_info')) ?></textarea>
                        <small class="text-muted">This is shown on the generated invoice for a user purchase</small>
                        <?php echo form_error('value[checkout_info]'); ?>
                      </div> 
                    </div>
                    <?php endif; ?> 


                    <?php if ($enable_steps &&  $step === 'contact'): ?> 
                    <input type="hidden" name="step" value="contact">
                    <label class="font-weight-bold" for="contact_block">Contact Settings</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="contact_block"> 
                      <div class="form-group col-md-6">
                        <label class="text-info" for="contact_email">Contact Email</label>
                        <input type="text" name="value[contact_email]" value="<?= set_value_switch('value[contact_email]', my_config('contact_email')) ?>" class="form-control" >
                        <small class="text-muted">Contact email address for the site</small>
                        <?php echo form_error('value[contact_email]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="contact_phone">Contact Phone</label>
                        <input type="text" name="value[contact_phone]" value="<?= set_value_switch('value[contact_phone]', my_config('contact_phone')) ?>" class="form-control" >
                        <small class="text-muted">Contact phone for the site</small>
                        <?php echo form_error('value[contact_phone]'); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <label class="text-info" for="contact_facebook">Site Facebook</label>
                        <input type="text" name="value[contact_facebook]" value="<?= set_value_switch('value[contact_facebook]', my_config('contact_facebook')) ?>" class="form-control" >
                        <small class="text-muted">Facebook account for the site</small>
                        <?php echo form_error('value[contact_facebook]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="contact_twitter">Site Twitter</label>
                        <input type="text" name="value[contact_twitter]" value="<?= set_value_switch('value[contact_twitter]', my_config('contact_twitter')) ?>" class="form-control" >
                        <small class="text-muted">Twitter account for the site</small>
                        <?php echo form_error('value[contact_twitter]'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label class="text-info" for="contact_instagram">Site Instagram</label>
                        <input type="text" name="value[contact_instagram]" value="<?= set_value_switch('value[contact_instagram]', my_config('contact_instagram')) ?>" class="form-control" >
                        <small class="text-muted">Instagram account for the site</small>
                        <?php echo form_error('value[contact_instagram]'); ?>
                      </div>

                      <div class="form-group col-md-12">
                        <label class="text-info" for="contact_address">Contact Address</label>
                        <textarea name="value[contact_address]" class="form-control" ><?= set_value_switch('value[contact_address]', my_config('contact_address')) ?></textarea>
                        <small class="text-muted">The site's contact or office address</small>
                        <?php echo form_error('value[contact_address]'); ?>
                      </div> 
                    </div>
                    <?php endif; ?> 


                    <div class="send-button">

                      <button type="submit" class="btn btn-info btn-round btn-lg">Update Configuration</button>

                      <?php if ($step !== 'main'): ?> 
                      <a href="<?= site_url('manage/admin/configuration/main')?>" class="btn btn-danger btn-round btn-lg">
                        <i class="fas fa-home"></i>
                        Main Configuration
                      </a> 
                      <?php endif; ?>

                      <?php if ($step !== 'payment'): ?> 
                      <a href="<?= site_url('manage/admin/configuration/payment')?>" class="btn btn-danger btn-round btn-lg">
                        <i class="fas fa-credit-card"></i>
                        Payment Settings
                      </a> 
                      <?php endif; ?>

                      <?php if ($step !== 'contact'): ?> 
                      <a href="<?= site_url('manage/admin/configuration/contact')?>" class="btn btn-danger btn-round btn-lg">
                        <i class="fas fa-map"></i>
                        Contact Settings
                      </a> 
                      <?php endif; ?>

                      <?php if ($step === 'settings'): ?>  
                      <a href="<?= site_url('manage/contest/create/update/1')?>" class="btn btn-danger btn-round btn-lg">
                        <i class="fas fa-chevron-left"></i>
                        Return
                      </a> 
                      <?php endif; ?>

                    </div>

                  <?php echo form_close(); ?>  
                </div>

              </div>
            </div> 
          </div>
          
          <!-- Right profile sidebar -->
          <?php $this->load->view('layout/_right_profile_sidebar') ?> 

        </div>
      </div>
