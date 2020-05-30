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
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="msg_box">
                    <?= $this->session->flashdata('msg'); ?>
                  </div>
                </div> 

                <div class="row collections container">
                <?php if($users): ?> 
                  <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Cnts.<span class="text-info">Vts</span></th> 
                        <th>Creation date</th>
                        <th class="disabled-sorting text-right">Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Cnts.<span class="text-info">Vts</span></th> 
                        <th>Creation date</th>
                        <th class="disabled-sorting text-right">Actions</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php foreach($users AS $user): ?> 
                        <?php $user = $this->account_data->fetch($user['id']); ?> 
                      <tr id="table_row_<?= $user['id'] ?>">
                        <td>
                          <span class="avatar avatar-sm rounded-circle">
                            <img src="<?= $this->creative_lib->fetch_image($user['avatar']); ?>" alt="<?= $user['name']; ?>" style="max-width: 80px; border-radius: 100px">
                          </span>
                        </td>
                        <td><a href="<?= site_url('profile/info/'.$user['username']); ?>"><?= $user['name']; ?></a></td>
                        <td><a href="mailto:<?= $user['email']; ?>"><?= $user['email']; ?></a></td>
                        <td><?= $user['country']; ?></td>
                        <td class="font-weight-bold text-center">
                          <?= count($this->contestant_model->get(['contestant_id' => $user['id']]))?>
                           - 
                          <span class="text-info"><?= $this->passcontest->vote_counter(['contestant_id' => $user['id']]) ?></span>
                        </td>
                        <td><?= date('Y-m-d', $user['date_created']); ?></td>
                        <td class="text-right">
                          <a type="button" href="<?= site_url('manage/admin/update_user/'.$user['id']) ?>" class="btn btn-info btn-icon btn-sm">
                            <i class="fas fa-edit fa-fw"></i>
                          </a>
                          <a type="button" 
                             data-delete="<?= $user['id']; ?>" 
                             href="javascript:void(0)" 
                             class="btn btn-danger btn-icon btn-sm deleter"
                             onclick="deleteItem({type: 'user', action: 1, id: '<?= $user['id']; ?>', init: 'table'})">
                            <i class="fas fa-trash fa-fw"></i>
                          </a>
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

            <?= $pagination ?>
            
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
