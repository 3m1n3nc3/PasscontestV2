      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8"> 
            <div class="card">
              <div class="card-header"> 
                <div class="float-right">
                  <a href="<?= site_url(uri_string().'?use=datatables')?>" class="btn btn-primary mr-1">Use Datatables</a>
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
                  <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th> 
                        <th>Reg. date</th>
                        <th>Category</th>
                        <th class="disabled-sorting text-right">Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th> 
                        <th>Reg. date</th>
                        <th>Category</th>
                        <th class="disabled-sorting text-right">Actions</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php foreach($contestants AS $contestant): ?> 
                        <?php $user = $this->account_data->fetch($contestant['contestant_id']); ?> 
                      <tr id="table_row_<?= $contestant['contestant_id']; ?>">
                        <td>
                          <span class="avatar avatar-sm rounded-circle">
                            <img src="<?= $this->creative_lib->fetch_image($user['avatar']); ?>" alt="<?= $user['name']; ?>" style="max-width: 80px; border-radius: 100px">
                          </span>
                        </td>
                        <td><a href="<?= site_url('profile/info/'.$user['username']); ?>"><?= $user['name']; ?></a></td>
                        <td><a href="mailto:<?= $user['email']; ?>"><?= $user['email']; ?></a></td>
                        <td><?= date_diff(date_create($user['dob']), date_create('now'))->y; ?></td> 
                        <td><?= date('Y-m-d', strtotime($contestant['date'])); ?></td>
                        <td><?= ucwords($contestant['category']); ?></td>
                        <td class="text-right"> 
                          <div class="d-flex">
                            <a href="<?= site_url('profile/data/'.$contestant['contestant_id'])?>" class="btn btn-sm btn-icon btn-info mr-1 identifier">
                              <i class="fas fa-user fa-fw"></i>
                            </a>
                            <?php if($contestant['active']): ?> 
                            <a href="javascript:void(0)" 
                               class="btn btn-sm btn-danger d-flex identifier" 
                               data-reject="<?= $contestant['id']; ?>" 
                               onclick="acceptItem({type: 'contestant', action: 0, id: '<?= $contestant['contestant_id']; ?>', contest_id: '<?= $contestant['contest_id']; ?>', init: 'table'})">
                              <i class="fas fa-trash fa-fw"></i> Reject
                            </a>
                            <?php else: ?> 
                            <a href="javascript:void(0)" 
                               class="btn btn-sm btn-success identifier" 
                               data-accept="<?= $contestant['id']; ?>" 
                               onclick="acceptItem({type: 'contestant', action: 1, id: '<?= $contestant['contestant_id']; ?>', contest_id: '<?= $contestant['contest_id']; ?>', init: 'table'})">
                              <i class="fas fa-check fa-fw"></i> Accept
                            </a>
                            <?php endif; ?> 
                          </div>
                        </td>
                      </tr>
                      <?php endforeach; ?> 
                    </tbody>
                  </table> 
                <?php else: ?>
                    <?php echo $this->creative_lib->default_card(lang('no_contests'));?>
                <?php endif; ?> 
                </div>

              </div>
            </div>  

            <?= $pagination__ ?>
            
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
