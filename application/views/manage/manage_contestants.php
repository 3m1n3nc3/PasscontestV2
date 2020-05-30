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
                  <a href="<?= site_url('manage/contest/create/'.$contest['id'].'/update')?>" class="btn btn-info mr-1">Update Contest</a>
                </div>
                <h5 class="title"><?= lang($page_title); ?></h5>
                <h7 class="title text-info"><?= $contest['title']; ?></h7>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="msg_box">
                    <?= $this->session->flashdata('msg'); ?>
                  </div>
                </div> 

                <div class="row collections container">
                <?php if($contestants): ?> 
                  <table id="datatables_table" class="table table-bordered rounded table-hover display norap " style="width: 100%;">
                    <thead>
                      <tr>
                        <th>Name</th> 
                        <th>Age</th> 
                        <th>Cate.</th>   
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table> 
                <?php else: ?>
                    <?php echo $this->creative_lib->default_card(lang('no_contestants'));?>
                <?php endif; ?> 
                </div>

              </div>
            </div>  
          </div>
          <div class="col-md-4">
            <div class="card"> 
              <div class="card-body">  
                <div class="list-group list-group-flush">
                  <a href="<?= site_url('manage/contest/contestants/'.$contest['id'].'/all'.$display_method)?>" class="list-group-item list-group-item-action<?= $filter === null ? ' active' : ''?>">All</a>
                  <a href="<?= site_url('manage/contest/contestants/'.$contest['id'].'/1'.$display_method)?>" class="list-group-item list-group-item-action <?= $filter == 1 ? ' active' : ''?>">Approved</a>
                  <a href="<?= site_url('manage/contest/contestants/'.$contest['id'].'/0'.$display_method)?>" class="list-group-item list-group-item-action<?= $filter == 0 && $filter !== null ? ' active' : ''?>">Pending Approval</a> 
                </div>
              </div> 
            </div>
          </div>
        </div>
      </div>
