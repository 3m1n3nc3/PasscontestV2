                <div class="panel-header panel-header-sm">
                </div>
                <div class="content">
                    
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card card-stats">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <div class="statistics">
                                              <div class="info">
                                                  <div class="icon icon-success">
                                                      <i class="now-ui-icons business_money-coins"></i>
                                                  </div>
                                                  <h3 class="info-title"><small><?= pass_currency(3, my_config('site_currency')) ?></small><?= number_format($agent['total_value'], 2) ?>
                                                      <sup class="ml-2"><small><?= number_format($agent['total_value']/my_config('credit_rate'), 2).' '.my_config('credit_code') ?></small></sup>
                                                  </h3>
                                                  <h6 class="stats-title"><?= my_config('credit_name'). ' ' .lang('in_circulation') ?></h6>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="statistics">
                                              <div class="info">
                                                  <div class="icon icon-primary">
                                                      <i class="now-ui-icons business_money-coins"></i>
                                                  </div>
                                                  <h3 class="info-title"><small><?= pass_currency(3, my_config('site_currency')) ?></small><?= number_format($agent['sold_value'], 2) ?>
                                                      <sup class="ml-2"><small><?= number_format($agent['sold_value']/my_config('credit_rate'), 2).' '.my_config('credit_code') ?></small></sup>
                                                  </h3>
                                                  <h6 class="stats-title"><?= my_config('credit_name'). ' ' .lang('sold') ?></h6>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="statistics">
                                              <div class="info">
                                                  <div class="icon icon-info">
                                                      <i class="now-ui-icons users_single-02"></i>
                                                  </div>
                                                  <h3 class="info-title"><?= $agent['total_available']?>
                                                      <sup class="ml-2"><small><?= $agent['total_sold'].' '.lang('sold')?></small></sup>
                                                  </h3>
                                                  <h6 class="stats-title"><?= lang('available_units') ?></h6>
                                              </div>
                                          </div>
                                      </div> 
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="row">

                    <?= isset($generate) ? $generate['format_keys'] : '' ?>

                    <div class="col-lg-6 col-md-6">
                      <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">Recharge</h5> 
                        </div>
                        <div class="card-body">
                          <?= form_open('user/account/credit') ?>
                            <?= validation_errors('<div class="alert alert-danger font-weight-bold text-center">', '</div>') ?>
                            <?= $this->session->flashdata('recharge_msg') ?>
                            <div class="form-group col-12">
                                <label>Enter Card Serial</label>
                                <input type="text" class="form-control" id="key" name="key" placeholder="Card Serial Number" value="<?= set_value('key') ?>" autocomplete="off">  
                            </div>   

                            <div class="form-group col-12">
                                <div class="send-button">
                                    <button type="submit" class="btn btn-primary btn-round btn-sm">Recharge</button>
                                </div>
                            </div>
                          <?= form_close() ?>
                        </div> 
                      </div>
                    </div> 

                    <div class="col-lg-6 col-md-6">
                      <div class="card card-chart">
                        <div class="card-header">
                          <h5 class="card-category"><?= lang('generate') . ' ' . my_config('credit_name') ?></h5> 
                        </div>
                        <div class="card-body">
                          <?= validation_errors('<div class="alert alert-danger font-weight-bold text-center">', '</div>') ?>
                          <?= $this->session->flashdata('generate_msg') ?>
                          <?= form_open('manage/admin/credit', ['class' => 'row']) ?>

                            <input type="hidden" name="generate_tokens" value="1">
                            <div class="form-group col-md-6">
                              <label class="text-info" for="value">Value</label>
                              <select class="form-control" id="value" placeholder="" name="value">
                                <?php foreach ($this->passcontest->credit(1, 'get_units') as $unit): ?>
                                    <?php echo '<option value="'.$unit.'"'.set_select('value', $unit).'>'.pass_currency(3, my_config('site_currency')).ucwords($unit).'</option>' ?>
                                <?php endforeach; ?>
                              </select>
                              <?php echo form_error('value'); ?>
                            </div>

                            <div class="form-group col-md-6">
                              <label class="text-info" for="quantity">Quantity</label>
                              <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity" value="<?= set_value('quantity') ?>">
                              <?php echo form_error('quantity'); ?>
                            </div> 

                            <div class="form-group col-md-6">
                              <label class="text-info" for="contest_id">Contest ID</label>
                              <input type="text" class="form-control" id="contest_id" placeholder="Contest ID" name="contest_id" value="<?= set_value('contest_id') ?>">
                            </div>

                            <div class="form-group col-md-6">
                              <label class="text-info" for="agent_id">Agent ID</label>
                              <input type="text" class="form-control" id="agent_id" placeholder="Agent ID" name="agent_id" value="<?= set_value('agent_id') ?>">
                              <?php echo form_error('agent_id'); ?>
                            </div> 

                            <div class="form-group col-12">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input name="action" class="form-check-input text-primary" type="checkbox" value="save"<?= set_checkbox('action', 'save') ?>>
                                  Check this box to save your keys, else they will just be previewed
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>

                              <div class="send-button">
                                <button type="submit" class="btn btn-primary btn-md">Generate Tokens</button>
                              </div>
                            </div>
                          <?= form_close() ?>
                        </div> 
                      </div>
                    </div> 
                  </div>
                    
                </div>
