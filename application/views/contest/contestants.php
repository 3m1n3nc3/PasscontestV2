                    <?php echo $contest_banner; ?>  
                    
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <h3 class="title text-center">Contestants and Polls</h3> 
                            <h5 class="description">
                                Here you can vote your favorite contestant for for each category of <?php echo $title ?>
                            </h5>
                        </div>

                        <!-- Contestants -->
                        <div class="col-md-10 ml-auto mr-auto">
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
                        <div class="col-md-10 ml-auto mr-auto">
                            <div class="row container collections">
                                <?php echo $pagination; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
