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
                                                    <h3 class="info-title"><small><?= pass_currency(3, my_config('site_currency')) ?></small><?= $credit['actual_value'] ?>
                                                        <sup class="ml-2"><small><?= $credit['balance'].' '.my_config('credit_code') ?></small></sup>
                                                    </h3>
                                                    <h6 class="stats-title"><?= my_config('credit_name'). ' ' .lang('balance') ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="statistics">
                                                <div class="info">
                                                    <div class="icon icon-primary">
                                                        <i class="now-ui-icons business_money-coins"></i>
                                                    </div>
                                                    <h3 class="info-title"><small><?= pass_currency(3, my_config('site_currency')) ?></small><?= $agent['total_value'] ?>
                                                        <sup class="ml-2"><small><?= number_format($agent['total_value']/my_config('credit_rate'), 2).' '.my_config('credit_code') ?></small></sup>
                                                    </h3>
                                                    <h6 class="stats-title"><?= lang('agent_balance') ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="statistics">
                                                <div class="info">
                                                    <div class="icon icon-info">
                                                        <i class="now-ui-icons users_single-02"></i>
                                                    </div>
                                                    <h3 class="info-title"><?= $agent['total_sold']?>
                                                        <sup class="ml-2"><small><?= $agent['total_available'].' '.lang('units')?></small></sup>
                                                    </h3>
                                                    <h6 class="stats-title"><?= lang('agent_sales') ?></h6>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
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
                                    <h5 class="card-category">Notice Board</h5> 
                                </div>
                                <div class="card-body">

                                </div> 
                            </div>
                        </div> 
                    </div>
                    
                </div>
