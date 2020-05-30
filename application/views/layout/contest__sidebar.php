                    <?php $segment = $this->uri->segment(2, 0); ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-info">
                                        <i class="fa fa-users fa-fw text-secondary"></i> 1200 Followers
                                    </h5>

                                    <h5 class="text-info">
                                        <i class="fa fa-user-friends fa-fw text-secondary"></i> 200 Following
                                    </h5> 

                                    <h5 class="text-info">
                                        <i class="fa fa-crown fa-fw text-secondary"></i> <a href="<?php echo site_url('contest/contestants/'.$id)?>"><?php echo count($contestants)?> Contestants</a>
                                    </h5> 

                                    <?php if($country): ?> 
                                    <h5 class="text-info">
                                        <i class="fa fa-map-marker fa-fw text-secondary"></i> &nbsp; Taking place in <?php echo $city.' '.$state.' '.$country; ?>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($email): ?> 
                                    <h5 class="text-info">
                                        <i class="fa fa-at fa-fw text-secondary"></i> <?php echo $email; ?>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($phone): ?> 
                                    <h5 class="text-info">
                                        <i class="fa fa-phone fa-fw text-secondary"></i> <?php echo $phone; ?>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($facebook): ?> 
                                    <h5 class="text-info">
                                        <i class="fab fa-facebook fa-fw text-secondary"></i> <a href="https://facebook.com/<?php echo $facebook; ?>"> Facebook</a>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($instagram): ?> 
                                    <h5 class="text-info">
                                        <i class="fab fa-instagram fa-fw text-secondary"></i> <a href="https://instagram.com/<?php echo $instagram; ?>">Instagram</a>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($twitter): ?> 
                                    <h5 class="text-info">
                                        <i class="fab fa-twitter fa-fw text-secondary"></i> <a href="https://twitter.com/<?php echo $twitter; ?>">Twitter</a>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($venue): ?>
                                    <hr>
                                    <h5 class="text-primary">
                                        <div class="my-2 font-weight-bold"><i class="fa fa-map-marker fa-fw text-secondary"></i> Event Venue</div> 
                                    </h5>
                                    <span class="text-info"><?php echo $venue; ?> </span>
                                    <?php endif; ?>

                                    <?php if($office): ?>
                                    <hr>
                                    <h5 class="text-primary">
                                        <div class="my-2 font-weight-bold"><i class="fa fa-map-marker fa-fw text-secondary"></i> Office Address</div> 
                                    </h5>
                                    <span class="text-info"><?php echo $office; ?> </span>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
