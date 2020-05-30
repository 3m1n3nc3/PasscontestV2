      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <?= form_open('user/account/settings', ['id' => 'sett_form', 'class' => 'needs-validation', 'novalidate' => null]); ?>
              <div class="card">
                <div class="card-header">
                  <h5 class="title">Account Settings</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <?= $this->session->flashdata('msg'); ?>
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Allow Email Notifications</label>
                        <select class="form-control" name="email_letter">
                          <option value="1"<?= set_select('email_letter', '1', TRUE) ?>>Allow</option>
                          <option value="0"<?= set_select('email_letter', '0', ($email_letter == 0 && !$switch ? TRUE : FALSE)) ?>>Reject</option>
                        </select>
                        <?= form_error('first_name'); ?>
                      </div>
                    </div> 
                  </div>   
                </div>
              </div>
              <div>
                <button type="submit" class="btn btn-info pass">Update</button>
              </div>
            <?= form_close() ?>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="<?= $this->creative_lib->fetch_image($cover); ?>" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="<?php echo site_url('profile/info'); ?>">
                    <img class="avatar border-gray" src="<?= $this->creative_lib->fetch_image($avatar); ?>" alt="...">
                    <h5 class="title"><?= $name; ?></h5>
                  </a>
                  <p class="description">
                    <?= $username; ?>
                  </p>
                </div>
                <p class="description text-center">
                  <?= $bio ? '"'.$bio.'"' : ''; ?>
                </p>
              </div>
              <?php if ($facebook || $twitter || $instagram): ?>
              <hr>
              <div class="button-container">
                <?php if ($facebook): ?>
                <a href="https://facebook.com/<?= $facebook; ?>" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <?php endif; ?>
                <?php if ($twitter): ?>
                <a href="https://twitter.com/<?= $twitter; ?>" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </a>
                <?php endif; ?>
                <?php if ($instagram): ?>
                <a href="https://instagram.com/<?= $instagram; ?>" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-instagram"></i>
                </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
