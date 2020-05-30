      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <?= form_open(uri_string(), ['id' => 'sett_form', 'class' => 'needs-validation', 'novalidate' => null]); ?>
              <div class="card">
                <div class="card-header"> 
                  <h5 class="title"><?= lang($page_title); ?></h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <?= $this->session->flashdata('msg'); ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?= set_value_switch('username', $user['username']); ?>">
                        <?= form_error('username'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" value="<?= set_value_switch('password'); ?>">
                        <?= form_error('password'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value_switch('email', $user['email']); ?>">
                        <?= form_error('email'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="phone">Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?= set_value_switch('phone', $user['phone']); ?>">
                        <?= form_error('phone'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?= set_value_switch('first_name', $user['first_name']); ?>">
                        <?= form_error('first_name'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?= set_value_switch('last_name', $user['last_name']); ?>">
                        <?= form_error('last_name'); ?>
                      </div>
                    </div>

                    <div class="form-group col-md-4 pr-1">
                      <label class="text-info" for="active">Active</label>
                      <select class="form-control" id="active" name="active">
                        <option value="1" <?php echo set_select('active', '1', int_bool($user['active'] == 1 ? 1 : 0)); ?>>Active</option> 
                        <option value="0" <?php echo set_select('active', '0', int_bool($user['active'] == 0 ? 1 : 0)); ?>>Inactive</option>
                      </select>
                      <?php echo form_error('active'); ?>
                    </div>

                    <div class="form-group col-md-4 px-1">
                      <label class="text-info" for="banned">Ban</label>
                      <select class="form-control" id="banned" name="banned">
                        <option value="1" <?php echo set_select('banned', '1', int_bool($user['banned'] == 1 ? 1 : 0)); ?>>Banned</option> 
                        <option value="0" <?php echo set_select('banned', '0', int_bool($user['banned'] == 0 ? 1 : 0)); ?>>Unbanned</option>
                      </select>
                      <?php echo form_error('banned'); ?>
                    </div>

                    <div class="form-group col-md-4 pl-1">
                      <label class="text-info" for="featured">Featured</label>
                      <select class="form-control" id="banned" name="featured">
                        <option value="1" <?php echo set_select('featured', '1', int_bool($user['featured'] == 1 ? 1 : 0)); ?>>Featured</option> 
                        <option value="0" <?php echo set_select('featured', '0', int_bool($user['featured'] == 0 ? 1 : 0)); ?>>Not featured</option>
                      </select>
                      <?php echo form_error('banned'); ?>
                    </div>

                    <div class="col-md-12">
                      <div>
                        <button type="submit" class="btn btn-info pass"><?= lang('update_user'); ?></button>
                        <a href="<?= site_url('manage/admin/privileges/assign/'.$user['id']); ?>" class="btn btn-primary pass"><?= lang('update_privilege'); ?></a>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>
            <?= form_close() ?>
          </div>
          
          <!-- Right profile sidebar -->
          <?php $this->load->view('layout/_right_profile_sidebar') ?> 
          
        </div>
      </div>
