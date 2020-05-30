      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8"> 
            <div class="card">
              <div class="card-header"> 
                <div class="float-right">
                  <a href="<?= site_url(uri_string())?>" class="btn btn-primary mr-1">Use Plain Tables</a>
                </div>
                <h5 class="title"><?= lang($page_title); ?></h5> 
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="msg_box">
                    <?= $this->session->flashdata('msg'); ?>
                  </div>
                </div> 

                <div class="row collections container">
                <?php if($users): ?> 
                  <table id="datatables_table" class="table table-bordered rounded table-hover display norap " style="width: 100%;">
                    <thead>
                      <tr>
                        <th>Name</th>  
                        <th>Email</th>     
                        <th>Country</th>  
                        <th>Cnts.<span class="text-info">Vts</span></th>  
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table> 
                <?php else: ?>
                    <?php echo $this->creative_lib->default_card(lang('no_contests'));?>
                <?php endif; ?> 
                </div>

              </div>
            </div>  
          </div>
          <div class="col-md-4">
            <div class="card"> 
              <div class="card-body">  
                <div class="list-group list-group-flush">
                  <a href="<?= site_url('manage/admin/users'.$display_method)?>" class="list-group-item list-group-item-action<?= $filter === '' ? ' active' : ''?>">All</a>
                  <a href="<?= site_url('manage/admin/users/1'.$display_method)?>" class="list-group-item list-group-item-action<?= $filter === '1' && $filter !== '' ? ' active' : ''?>">Active</a> 
                  <a href="<?= site_url('manage/admin/users/0'.$display_method)?>" class="list-group-item list-group-item-action <?= $filter === '0' ? ' active' : ''?>">Inactive</a>
                  <a href="<?= site_url('manage/admin/users/banned'.$display_method)?>" class="list-group-item list-group-item-action<?= $filter === 'banned' && $filter !== '' ? ' active' : ''?>">Banned</a> 
                  <a href="<?= site_url('manage/admin/users/featured'.$display_method)?>" class="list-group-item list-group-item-action<?= $filter === 'featured' && $filter !== '' ? ' active' : ''?>">Featured</a> 
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
