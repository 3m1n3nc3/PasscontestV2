      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <?= form_open('user/account', ['id' => 'sett_form', 'class' => 'needs-validation', 'novalidate' => null]); ?>
              <div class="card">
                <div class="card-header">
                  <div class="float-right">
                    <a href="<?= site_url('user/account/update')?>" class="btn btn-primary mr-1">Update Personal Data</a>
                  </div>
                  <h5 class="title">Edit Profile</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <?= $this->session->flashdata('msg'); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" disabled="" placeholder="Username" value="<?= $username; ?>">
                        <?= form_error('username'); ?>
                      </div>
                    </div>
                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value_switch('email', $email); ?>">
                        <?= form_error('email'); ?>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?= set_value_switch('phone', $phone); ?>">
                        <?= form_error('phone'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?= set_value_switch('first_name', $first_name); ?>">
                        <?= form_error('first_name'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?= set_value_switch('last_name', $last_name); ?>">
                        <?= form_error('last_name'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" class="form-control" name="facebook" placeholder="Facebook" value="<?= set_value_switch('facebook', $facebook); ?>">
                        <?= form_error('facebook'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" class="form-control" name="twitter" placeholder="Twitter" value="<?= set_value_switch('twitter', $twitter); ?>">
                        <?= form_error('twitter'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Instagram</label>
                        <input type="text" class="form-control" name="instagram" placeholder="Instagram" value="<?= set_value_switch('instagram', $instagram); ?>">
                        <?= form_error('instagram'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="curr_address" placeholder="Current Address" value="<?= set_value_switch('curr_address', $curr_address); ?>">
                        <?= form_error('curr_address'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" placeholder="Country" value="<?= set_value_switch('country', $country); ?>">
                        <?= form_error('country'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" placeholder="State" value="<?= set_value_switch('state', $state); ?>">
                        <?= form_error('state'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" placeholder="City" value="<?= set_value_switch('city', $city); ?>">
                        <?= form_error('city'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea rows="4" cols="80" class="form-control" name="bio" placeholder="Tell us about yourself"><?= set_value_switch('bio', $bio) ?></textarea>
                        <?= form_error('bio'); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <button type="submit" class="btn btn-info pass">Save Profile</button>
              </div>
            <?= form_close() ?>
          </div>
          
          <!-- Right profile sidebar -->
          <?php $this->load->view('layout/_right_profile_sidebar') ?> 
          
        </div>
      </div>
