            <?php echo $contest_banner; ?>            
                    <?php echo $contest_sidebar; ?>            
                        <div class="col-md-8 mr-auto ml-auto"> 

                            <div class="row">
                                <div class="col-md-12 ml-auto mr-auto">
                                    <div class="row collections container">
                                    <?php if($voters): ?>
                                        <?php foreach($voters AS $vdata): ?>
                                            <?php  
                                            if (filter_var($vdata['voter_id'], FILTER_VALIDATE_IP)) 
                                            {
                                                $voter = $this->ip->guestUser($vdata['voter_id']);
                                            } 
                                            else 
                                            {
                                                $voter = $this->account_data->fetch($vdata['voter_id']);
                                            }
                                            $voted = $this->account_data->fetch($vdata['contestant_id']);
                                            $voted_person = ($voter['id'] !== $vdata['contestant_id'] ? $voted['name'] : $voted['personify'].'self');
                                            if ($voter): 
                                            ?>   
                                            <div class="container">
                                                <a href="<?php echo site_url('profile/info/'.$voter['username']); ?>">
                                                    <div class="card">
                                                        <div class="row no-gutters">
                                                            <div class="col-auto card-background-left" style="background-image:url('<?php echo $this->creative_lib->fetch_image($voter['avatar']); ?>')"> 
                                                            </div>
                                                            <div class="col">
                                                                <div class="card-block px-2">
                                                                    <h4 class="card-title text-primary" style="margin-top: 0px;"> 
                                                                        <?php 
                                                                        echo $voter['name'];
                                                                        if($vdata['count']>1): ?>
                                                                        <span class="badge badge-info"><?php echo sprintf(lang('voted_for'), $vdata['count'], $voted_person) ?></span>
                                                                        <?php endif; ?>
                                                                    </h4>
                                                                    <p class="card-text text-info"><?php echo $voter['bio']; ?></p>  
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a>
                                            </div>   
                                            <?php endif; ?>
                                        <?php endforeach; ?> 
                                    <?php else: ?>
                                        <?php echo $this->creative_lib->default_card();?>
                                    <?php endif; ?> 
                                    </div>
                                </div>
                                <div class="col-md-10 ml-auto mr-auto">
                                    <div class="row container collections">
                                        <?php echo $pagination; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> 

                </div>
            </div>
