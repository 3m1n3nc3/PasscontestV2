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
                        <label class="text-info" for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" value="<?= set_value_switch('title', $contest['title']); ?>">
                        <?= form_error('title'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="safelink">Safelink</label>
                        <input type="text" class="form-control" name="safelink" placeholder="Password" value="<?= set_value_switch('safelink', $contest['safelink']); ?>">
                        <?= form_error('safelink'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?= set_value_switch('email', $contest['email']); ?>">
                        <?= form_error('email'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="phone">Phone Number</label>
                        <input type="text" class="form-control" name="phone" placeholder="Phone" value="<?= set_value_switch('phone', $contest['phone']); ?>">
                        <?= form_error('phone'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="type">Contest Type (E.g. Pageant)</label>
                        <input type="text" class="form-control" name="type" placeholder="Contest Type" value="<?= set_value_switch('type', $contest['type']); ?>">
                        <?= form_error('type'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label class="text-info" for="vote_cost">Cost Per Vote (<?= my_config('credit_name'); ?>)</label>
                        <input type="text" class="form-control" name="vote_cost" placeholder="Creator ID" value="<?= set_value_switch('vote_cost', $contest['vote_cost']); ?>">
                        <?= form_error('vote_cost'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="creator_id">Creator ID (Manager)</label>
                        <input type="text" class="form-control" name="creator_id" placeholder="Creator ID" value="<?= set_value_switch('creator_id', $contest['creator_id']); ?>">
                        <?= form_error('creator_id'); ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="text-info" for="tags">Tags (Comma Separated)</label>
                        <input type="text" class="form-control" name="tags" placeholder="Tags" value="<?= set_value_switch('tags', $contest['tags']); ?>">
                        <?= form_error('tags'); ?>
                      </div>
                    </div>
                  </div>

                  <hr class="border-danger">

                  <div class="row">
                    <div class="form-group col-md-4 pr-1">
                      <label class="text-info" for="status">Active (Ban)</label>
                      <select class="form-control" id="status" name="status">
                        <option value="1" <?php echo set_select('status', '1', int_bool($contest['status'] == 1 ? 1 : 0)); ?>>Active</option> 
                        <option value="0" <?php echo set_select('status', '0', int_bool($contest['status'] == 0 ? 1 : 0)); ?>>Inactive</option>
                      </select>
                      <?php echo form_error('active'); ?>
                    </div>

                    <div class="form-group col-md-4 px-1">
                      <label class="text-info" for="entry">Allow Registrations</label>
                      <select class="form-control" id="entry" name="entry">
                        <option value="1" <?php echo set_select('entry', '1', int_bool($contest['entry'] == 1 ? 1 : 0)); ?>>Allowed</option> 
                        <option value="0" <?php echo set_select('entry', '0', int_bool($contest['entry'] == 0 ? 1 : 0)); ?>>Disallowed</option>
                      </select>
                      <?php echo form_error('entry'); ?>
                    </div>

                    <div class="form-group col-md-4 pl-1">
                      <label class="text-info" for="use_payment">Require Payment for registration</label>
                      <select class="form-control" id="use_payment" name="use_payment">
                        <option value="1" <?php echo set_select('use_payment', '1', int_bool($contest['use_payment'] == 1 ? 1 : 0)); ?>>Require</option> 
                        <option value="0" <?php echo set_select('use_payment', '0', int_bool($contest['use_payment'] == 0 ? 1 : 0)); ?>>Not Required</option>
                      </select>
                      <?php echo form_error('use_payment'); ?>
                    </div>

                    <div class="form-group col-md-4 pr-1">
                      <label class="text-info" for="allow_vote">Allow Voting</label>
                      <select class="form-control" id="allow_vote" name="allow_vote">
                        <option value="1" <?php echo set_select('allow_vote', '1', int_bool($contest['allow_vote'] == 1 ? 1 : 0)); ?>>Allowed</option> 
                        <option value="0" <?php echo set_select('allow_vote', '0', int_bool($contest['allow_vote'] == 0 ? 1 : 0)); ?>>Disallowed</option>
                      </select>
                      <?php echo form_error('allow_vote'); ?>
                    </div>

                    <div class="form-group col-md-4 px-1">
                      <label class="text-info" for="require_social">Require Social</label>
                      <select class="form-control" id="require_social" name="require_social">
                        <option value="1" <?php echo set_select('require_social', '1', int_bool($contest['require_social'] == 1 ? 1 : 0)); ?>>Required</option> 
                        <option value="0" <?php echo set_select('require_social', '0', int_bool($contest['require_social'] == 0 ? 1 : 0)); ?>>Don't Require</option>
                      </select>
                      <?php echo form_error('require_social'); ?>
                    </div>

                    <div class="form-group col-md-4 pl-1">
                      <label class="text-info" for="recommend">Recommend</label>
                      <select class="form-control" id="recommend" name="recommend">
                        <option value="1" <?php echo set_select('recommend', '1', int_bool($contest['recommend'] == 1 ? 1 : 0)); ?>>Recommended</option> 
                        <option value="0" <?php echo set_select('recommend', '0', int_bool($contest['recommend'] == 0 ? 1 : 0)); ?>>Not Recommended</option>
                      </select>
                      <?php echo form_error('recommend'); ?>
                    </div>

                    <div class="col-md-12">
                      <div>
                        <button type="submit" class="btn btn-info pass"><?= lang('update_contest'); ?></button>
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
