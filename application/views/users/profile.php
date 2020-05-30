                    <?= $profile_banner ?>
                    
                    <div class="row">
                        
                        <?= $profile_sidebar; ?>
                        
                        <div class="col-md-8">
                            <?php if($contests): ?>
                                <?php foreach($contests AS $cdata): ?>
                                    <?php 
                                    $contest = $this->contest_model->get($cdata['contest_id']);
                                    if ($contest):
                                    ?>
                                    <div class="card">
                                        <a href="<?= site_url('contest/details/'.$contest['safelink']); ?>"> 
                                            <div class="card-background-top" style="background-image: url('<?= $this->creative_lib->fetch_image($contest['cover']); ?>');"></div>
                                        </a>
                                        <div class="card-body">
                                            <h4 class="card-title mt-0">
                                                <a href="<?= site_url('contest/details/'.$contest['safelink']); ?>">
                                                    <?= $contest['title']; ?>
                                                </a>
                                            </h4>
                                            <p class="card-text"><?= character_limiter($contest['description'], 300, ''); ?></p> 
                                            <?= $this->passcontest->vote_bar(['contest_id' => $contest['id'], 'contestant_id' => $id]); ?>
                                        </div>
                                    </div>  
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?= $this->creative_lib->default_card();?>
                            <?php endif; ?> 
                        </div>
                    </div>  
                </div>
            </div>
