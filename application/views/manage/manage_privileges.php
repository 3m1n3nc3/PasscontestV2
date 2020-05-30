                <div class="panel-header panel-header-sm">
                </div>
                <div class="content"> 

                  <div class="row">

                    <?= isset($generate) ? $generate['format_keys'] : '' ?>

                    <div class="col-lg-6 col-md-6">
                      <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category"><?= lang('assign_privilege') ?></h5> 
                        </div>
                        <div class="card-body"> 
                          <?= $this->session->flashdata('assign_msg') ?>
                          <?= form_open('manage/admin/privileges/assign') ?>
                            <?= $this->session->flashdata('recharge_msg') ?>
                            <input type="hidden" name="action" value="assign">
                            <div class="form-group col-12">
                              <label class="text-info" for="id">User ID</label>
                              <input type="text" class="form-control" id="id" name="id" placeholder="User ID" value="<?= set_value('id', $action_id) ?>">
                              <?php echo form_error('id'); ?>
                            </div>  

                            <div class="form-group col-md-12">
                              <label class="text-info" for="role_id"><?= lang('role_id') ?></label>
                              <select class="form-control" id="role_id" name="role_id"> 
                                <option value="0" <?= set_select('role_id', '0'); ?>>Reset</option>
                                <?php foreach ($this->privilege_model->get() AS $option): ?>
                                <option value="<?= $option['id']; ?>" <?= set_select('role_id', $option['id']); ?>><?= $option['title']; ?></option>
                                <?php endforeach; ?>
                              </select>
                              <?php echo form_error('role_id'); ?>
                            </div> 

                            <div class="form-group col-12">
                              <div class="send-button">
                                  <button type="submit" class="btn btn-primary btn-md"><?= lang('assign_privilege') ?></button>
                              </div>
                            </div>
                          <?= form_close() ?>
                        </div> 
                      </div>
                    </div> 

                    <div class="col-lg-6 col-md-6">
                      <div class="card card-chart">
                        <div class="card-header">
                          <h5 class="card-category"><?= lang('create_privilege') ?></h5> 
                        </div>
                        <div class="card-body"> 
                          <?= $this->session->flashdata('create_msg') ?>
                          <?= form_open('manage/admin/privileges/create'.($privileges['id'] ? '/'.$privileges['id'] : ''), ['class' => 'form-row']) ?> 
                            
                            <input type="hidden" name="action" value="create">

                            <div class="form-group col-md-6">
                              <label class="text-info" for="title">Title</label>
                              <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?= set_value('title', $privileges['title']) ?>">
                              <?php echo form_error('title'); ?>
                            </div> 

                            <div class="form-group col-md-6">
                              <label class="text-info" for="info">Description</label>
                              <input type="text" class="form-control" id="info" placeholder="Description" name="info" value="<?= set_value('info', $privileges['info']) ?>">
                              <?php echo form_error('info'); ?>
                            </div>

                            <div class="form-group col-md-12">
                              <label class="text-info" for="permissions">Permissions (Comma Separated)</label>
                              <input type="text" class="form-control" id="permissions" placeholder="Permissions" name="permissions" value="<?= set_value('permissions', list_permissions($privileges['permissions'])) ?>">
                              <?php echo form_error('permissions'); ?>
                              <small class="text-primary"><?= lang('list_privileges'); ?></small> 
                            </div> 

                            <div class="form-group col-12"> 
                              <div class="send-button">
                                <button type="submit" class="btn btn-primary btn-md"><?= $action_id ? lang('update_privilege') : lang('create_privilege') ?></button>

                                <?php if ($privileges['id']): ?>
                                <a href="<?= site_url('manage/admin/privileges/delete/'.$privileges['id'])?>" class="btn btn-danger btn-md"><i class="fa fa-trash fa-fw"></i></a>
                                <?php endif; ?>
                              </div>
                            </div>
                          <?= form_close() ?>
                        </div> 
                        <div class="card-footer bg-light bg-light">

                          <?php foreach ($this->privilege_model->get() AS $priv): ?>
                           | <a class="font-weight-bold" href="<?= site_url('manage/admin/privileges/create/'.$priv['id']); ?>"> <?= $priv['title']; ?> </a> |
                          <?php endforeach; ?>

                        </div>
                      </div>
                    </div> 
                  </div>
                    
                </div>
