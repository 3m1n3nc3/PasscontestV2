            <?php echo $contest_banner; ?>            
                    <?php echo $contest_sidebar; ?>            
                        <div class="col-md-8 mr-auto ml-auto">

                            <?php if($description): ?> 
                            <h5 class="description pass">
                                <?php echo $description; ?>
                            </h5>
                            <?php endif; ?> 

                            <div class="row">
                                <div class="col-md-6 ml-auto mr-auto"> 
                                    <div class="nav-align-center">
                                        <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#eligibility" role="tablist">
                                                    <i class="fa fa-check-circle"></i>
                                                    <div class="font-weight-bold text-secondary mt-2">Eligibility</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#prizes" role="tablist">
                                                    <i class="fa fa-box"></i>
                                                    <div class="font-weight-bold text-secondary mt-2">Prizes</div>
                                                </a>
                                            </li> 
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#contestants" role="tablist">
                                                    <i class="now-ui-icons sport_user-run"></i>
                                                    <div class="font-weight-bold text-secondary mt-2">Contestants</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-12 ml-auto mr-auto"> 
                                    <!-- Tab panes -->
                                    <div class="tab-content gallery">
                                        <div class="tab-pane active" id="prizes" role="tabpanel">
                                            <div class="col-md-12 ml-auto mr-auto">
                                                <div class="row collections container">
                                                    <h5>
                                                        <?php echo $prizes ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="eligibility" role="tabpanel">
                                            <div class="col-md-12 ml-auto mr-auto">
                                                <div class="row collections container">
                                                    <h5 >
                                                        <?php echo $eligibility ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="tab-pane" id="contestants" role="tabpanel">
                                            <div class="col-md-12 ml-auto mr-auto">
                                                <div class="row collections container">
                                                <?php if($contestants): ?>
                                                    <?php foreach($contestants AS $cdata): ?>
                                                        <?php  
                                                        $contestant = $this->account_data->fetch($cdata['contestant_id']);
                                                        if ($contestant):
                                                        ?>
                                                        <div class="col-md-6"> 
                                                            <div class="card">
                                                                <a href="<?php echo site_url('profile/info/'.$contestant['username']); ?>">
                                                                    <img class="card-img-top" src="<?php echo $this->creative_lib->fetch_image($contestant['avatar']); ?>" alt="<?php echo $contestant['name']; ?> image cap">
                                                                </a>
                                                                <div class="card-body">
                                                                    <h4 class="card-title mt-0"><a href="<?php echo site_url('profile/info/'.$contestant['username']); ?>"><?php echo $contestant['name']; ?></a></h4>
                                                                    <p class="card-text"><?php echo $contestant['bio']; ?></p>
                                                                    <?php echo $this->passcontest->vote_bar(['contest_id' => $id, 'contestant_id' => $contestant['id']]); ?>
                                                                </div>
                                                            </div>                                            
                                                        </div> 
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <?php echo $this->creative_lib->default_card();?>
                                                <?php endif; ?> 
                                                </div>
                                            </div>
                                        </div> 

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> 

                </div>
            </div>
