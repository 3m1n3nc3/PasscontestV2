      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8"> 
            <div class="card">
              <div class="card-header"> 
                <h5 class="title"><?= lang($page_title); ?></h5> 
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="msg_box">
                    <?= $this->session->flashdata('msg'); ?>
                  </div>
                </div> 

                <div class="row collections container">
                <?php if($contests): ?> 
                  <table id="datatables_table" class="table table-bordered rounded table-hover display norap " style="width: 100%;">
                    <thead>
                      <tr>
                        <th>Title</th> 
                        <th>Vote Cost</th> 
                        <th>Cntns.</th> 
                        <th>Country</th>   
                        <th>Created</th>
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
                  <a href="<?= site_url('manage/admin/contests/')?>" class="list-group-item list-group-item-action<?= $filter === null ? ' active' : ''?>">All</a>
                  <a href="<?= site_url('manage/admin/contests/1')?>" class="list-group-item list-group-item-action<?= $filter === '1' && $filter !== null ? ' active' : ''?>">Active</a> 
                  <a href="<?= site_url('manage/admin/contests/0')?>" class="list-group-item list-group-item-action <?= $filter === '0' ? ' active' : ''?>">Inactive</a>
                  <a href="<?= site_url('manage/admin/contests/recommended')?>" class="list-group-item list-group-item-action<?= $filter === 'recommended' && $filter !== null ? ' active' : ''?>">Recommended</a> 
                  <a href="<?= site_url('manage/admin/contests/featured')?>" class="list-group-item list-group-item-action<?= $filter === 'featured' && $filter !== null ? ' active' : ''?>">Featured</a> 
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
