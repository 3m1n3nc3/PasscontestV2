      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8"> 
            <div class="card">
              <div class="card-header"> 
                <h5 class="float-right title text-primary"><?= lang('step') . ' ' . ($step === 0 ? 1 : $step); ?></h5>
                <h5 class="title"><?= $contest['id'] ? lang('update_contest') : lang($page_title); ?></h5>
                <?php if ($contest['title']): ?> 
                <h7 class="title text-info"><?= $contest['title']; ?></h7>
                <?php endif; ?>
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

                    <?php if ($enable_steps && ($step === 0 || $step == 1)): ?> 
                    <input type="hidden" name="step" value="1">
                    <label class="font-weight-bold" for="basic_block">Basic Details</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="basic_block"> 
                      <div class="form-group col-md-12">
                          <label for="title">Contest Title</label>
                          <input type="text" class="form-control" id="title" placeholder="Contest Title" name="title" value="<?php echo $switch ? set_value('title') : $contest['title']; ?>">  
                          <?php echo form_error('title'); ?>
                      </div> 

                      <div class="form-group col-md-12">
                          <label for="slug">Short Intro or Slogan</label>
                          <input type="text" class="form-control" id="slug" placeholder="Short Intro" name="slug" value="<?php echo $switch ? set_value('slug') : $contest['slug']; ?>">  
                          <?php echo form_error('slug'); ?>
                      </div> 

                      <div class="form-group col-md-12">
                          <label for="type">Contest Type (E.g. Pageant)</label>
                          <input type="text" class="form-control" id="type" placeholder="Contest Type" name="type" value="<?php echo $switch ? set_value('type') : $contest['type']; ?>">  
                          <?php echo form_error('type'); ?>
                      </div> 
                    </div>
                    <?php endif; ?>

                    <?php if ($enable_steps && $step == 2): ?> 
                    <input type="hidden" name="step" value="2">
                    <label class="font-weight-bold" for="contact_block">Contact Details</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="contact_block"> 
                      <div class="form-group col-md-6">
                          <label for="email">Contact Email Address</label>
                          <input type="text" class="form-control" id="email" placeholder="Contact Email Address" name="email" value="<?php echo $switch ? set_value('email') : $contest['email']; ?>">  
                          <?php echo form_error('email'); ?>
                      </div> 

                      <div class="form-group col-md-6">
                          <label for="phone">Contact Phone</label>
                          <input type="text" class="form-control" id="phone" placeholder="Contact Phone" name="phone" value="<?php echo $switch ? set_value('phone') : $contest['phone']; ?>">  
                          <?php echo form_error('phone'); ?>
                      </div> 

                      <div class="form-group col-md-4">
                          <label for="facebook">Facebook</label>
                          <input type="text" class="form-control" id="facebook" placeholder="Facebook" name="facebook" value="<?php echo $switch ? set_value('facebook') : $contest['facebook']; ?>">  
                          <?php echo form_error('facebook'); ?>
                      </div> 

                      <div class="form-group col-md-4">
                          <label for="twitter">Twitter</label>
                          <input type="text" class="form-control" id="twitter" placeholder="Twitter" name="twitter" value="<?php echo $switch ? set_value('twitter') : $contest['twitter']; ?>">  
                          <?php echo form_error('twitter'); ?>
                      </div> 

                      <div class="form-group col-md-4">
                          <label for="instagram">Instagram</label>
                          <input type="text" class="form-control" id="instagram" placeholder="Instagram" name="instagram" value="<?php echo $switch ? set_value('phone') : $contest['instagram']; ?>">  
                          <?php echo form_error('instagram'); ?>
                      </div> 
                    </div>
                    <?php endif; ?>

                    <?php if ($enable_steps && $step == 3): ?> 
                    <input type="hidden" name="step" value="3">
                    <label class="font-weight-bold" for="contest_block">Contest Details</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="contest_block">  
                      <div class="form-group col-12">
                          <label for="description">Details</label>
                          <textarea class="form-control" id="bio" placeholder="Details" name="description"><?php echo $switch ? set_value('description') : $contest['description']; ?></textarea>
                          <?php echo form_error('description'); ?>
                      </div>

                      <div class="form-group col-12">
                          <label for="eligibility">Eligibility Info</label>
                          <textarea class="form-control" id="bio" placeholder="Eligibility" name="eligibility"><?php echo $switch ? set_value('eligibility') : $contest['eligibility']; ?></textarea>
                          <?php echo form_error('eligibility'); ?>
                      </div>

                      <div class="form-group col-12">
                          <label for="prizes">Prizes</label>
                          <textarea class="form-control" id="bio" placeholder="Prizes" name="prizes"><?php echo $switch ? set_value('prizes') : $contest['prizes']; ?></textarea>
                          <?php echo form_error('prizes'); ?>
                      </div>
                    </div> 
                    <?php endif; ?>

                    <?php if ($enable_steps && $step == 4): ?> 
                    <input type="hidden" name="step" value="4">
                    <label class="font-weight-bold" for="address_block">Address Information</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="address_block"> 

                      <div class="form-group col-md-12">
                          <label for="country">Country</label>
                          <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="<?php echo $switch ? set_value('country') : $contest['country']; ?>">  
                          <?php echo form_error('country'); ?>
                      </div> 

                      <div class="form-group col-md-6">
                          <label for="state">State</label>
                          <input type="text" class="form-control" id="state" placeholder="State" name="state" value="<?php echo $switch ? set_value('state') : $contest['state']; ?>">  
                          <?php echo form_error('state'); ?>
                      </div>  

                      <div class="form-group col-md-6">
                          <label for="city">City</label>
                          <input type="text" class="form-control" id="city" placeholder="City" name="city" value="<?php echo $switch ? set_value('city') : $contest['city']; ?>">  
                          <?php echo form_error('city'); ?>
                      </div>  

                      <div class="form-group col-12">
                          <label for="office">Contact Address</label>
                          <textarea class="form-control" id="office" placeholder="Contact Address" name="office"><?php echo $switch ? set_value('office') : $contest['office']; ?></textarea>
                          <?php echo form_error('office'); ?>
                      </div>

                      <div class="form-group col-12">
                          <label for="venue">Event Location</label>
                          <textarea class="form-control" id="venue" placeholder="Event Location" name="venue"><?php echo $switch ? set_value('venue') : $contest['venue']; ?></textarea>
                          <?php echo form_error('venue'); ?>
                      </div>
                    </div>
                    <?php endif; ?>

                    <?php if ($step === 'settings'): ?> 
                    <input type="hidden" name="step" value="settings">
                    <label class="font-weight-bold" for="settings_block">Contest Settings</label>
                    <hr class="my-0">
                    <div class="row p-3 mb-3" id="settings_block"> 

                      <div class="form-group col-md-12">
                        <label for="tags">Tags (comma separated keywords)</label>
                        <input type="tags" class="form-control" id="tags" placeholder="Tags1, Tags2, Tags2" name="tags" value="<?php echo $switch ? set_value('tags') : $contest['tags']; ?>">  
                        <?php echo form_error('tags'); ?>
                      </div>  

                      <div class="form-group col-md-4">
                        <label for="entry">Registration Status</label>
                          <select class="form-control" id="entry" placeholder="" name="entry">
                              <option value="1" <?php echo set_select('entry', '1', int_bool($contest['entry'] ? 1 : 0)); ?>>Registration Open</option>
                              <option value="0" <?php echo set_select('entry', '0', int_bool(!$contest['entry'] ? 1 : 0)); ?>>Registration Closed</option> 
                          </select>
                          <?php echo form_error('entry'); ?>
                      </div> 

                      <div class="form-group col-md-4">
                        <label for="use_payment">Payment for Registration</label>
                          <select class="form-control" id="use_payment" placeholder="" name="use_payment">
                              <option value="1" <?php echo set_select('use_payment', '1', int_bool($contest['use_payment'] ? 1 : 0)); ?>>Require Payment</option>
                              <option value="0" <?php echo set_select('use_payment', '0', int_bool(!$contest['use_payment'] ? 1 : 0)); ?>>Registration is Free</option> 
                          </select>
                          <?php echo form_error('use_payment'); ?>
                      </div> 

                      <div class="form-group col-md-4">
                        <label for="vote_cost">Cost per Vote (<?= my_config('credit_name') ?>)</label>
                        <input type="text" class="form-control" id="vote_cost" placeholder="12" name="vote_cost" value="<?php echo $switch ? set_value('vote_cost') : $contest['vote_cost']; ?>">  
                        <?php echo form_error('vote_cost'); ?>
                      </div>  

                      <div class="form-group col-md-6">
                        <label for="allow_vote">Voting Status</label>
                        <select class="form-control" id="allow_vote" placeholder="" name="allow_vote">
                            <option value="1" <?php echo set_select('allow_vote', '1', int_bool($contest['allow_vote'] ? 1 : 0)); ?>>Votting Open</option>
                            <option value="0" <?php echo set_select('allow_vote', '0', int_bool(!$contest['allow_vote'] ? 1 : 0)); ?>>Voting Closed</option> 
                        </select>
                        <?php echo form_error('allow_vote'); ?>
                      </div>  

                      <div class="form-group col-md-6">
                        <label for="require_social">Require Social</label>
                        <select class="form-control" id="require_social" placeholder="" name="require_social">
                            <option value="1" <?php echo set_select('require_social', '1', int_bool($contest['require_social'] ? 1 : 0)); ?>>Votting Open</option>
                            <option value="0" <?php echo set_select('require_social', '0', int_bool(!$contest['require_social'] ? 1 : 0)); ?>>Voting Closed</option> 
                        </select>
                        <?php echo form_error('require_social'); ?>
                      </div> 
                    </div>
                    <?php endif; ?>

                    <div class="send-button">
                      <?php if ($step < 5 && $step !== 'settings'): ?> 
                      <button type="submit" class="btn btn-primary btn-round btn-lg">Next</button>
                      <?php elseif ($step === 'settings'): ?>  
                      <a href="<?= site_url('manage/contest/create/'.$contest['id'].'/update/1')?>" class="btn btn-danger btn-round btn-lg">
                        <i class="fas fa-chevron-left"></i>
                        Return
                      </a>
                      <?php else: ?>
                      <a href="<?= site_url('contest/details/'.$contest['id'])?>" class="btn btn-primary btn-round btn-lg">Go to your contest</a>
                      <?php endif; ?>

                      <?php if ($step === 'settings'): ?>  
                      <button type="submit" class="btn btn-info btn-round btn-lg"> <i class="fas fa-wrench"></i> Update Settings </a>
                      <?php elseif (isset($contest['id'])): ?> 
                      <a href="<?= site_url('manage/contest/create/'.$contest['id'].'/update/settings')?>" class="btn btn-danger btn-round btn-lg">
                        <i class="fas fa-wrench"></i>
                        Contest Settings
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
