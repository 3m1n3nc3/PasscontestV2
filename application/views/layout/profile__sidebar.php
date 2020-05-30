                       <?php $segment = $this->uri->segment(2, 0); ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-info">
                                        <i class="fa fa-users fa-fw text-primary"></i> 1200 Followers
                                    </h5>
                                    <h5 class="text-info">
                                        <i class="fa fa-user-friends fa-fw text-primary"></i> 200 Following
                                    </h5>
                                    <?php if($course || $school): ?> 
                                    <h5 class="text-info">
                                        <i class="fa fa-check-circle fa-fw text-primary"></i> Studied <?php echo ($course && $school ? $course.' at '.$school : ($course ? $course : $school)); ?>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($city): ?> 
                                    <h5 class="text-info">
                                        <i class="fa fa-map-marker fa-fw text-primary"></i> &nbsp; Lives in <?php echo $city; ?>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($prev_contest): ?> 
                                    <h5 class="text-info">
                                        <i class="fa check-circle fa-fw text-primary"></i> Contested for <?php echo $prev_contest; ?>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($facebook): ?> 
                                    <h5 class="text-info">
                                        <i class="fab fa-facebook fa-fw text-primary"></i> <a href="https://facebook.com/<?php echo $facebook; ?>">Facebook</a>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($instagram): ?> 
                                    <h5 class="text-info">
                                        <i class="fab fa-instagram fa-fw text-primary"></i> <a href="https://instagram.com/<?php echo $instagram; ?>">Instagram</a>
                                    </h5>
                                    <?php endif; ?>

                                    <?php if($twitter): ?> 
                                    <h5 class="text-info">
                                        <i class="fab fa-twitter fa-fw text-primary"></i> <a href="https://twitter.com/<?php echo $twitter; ?>">Twitter</a>
                                    </h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
