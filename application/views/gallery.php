                    <?php echo $profile_banner ?>
                    
                    <div class="row">
                        
                        <?php echo $profile_sidebar; ?>

                        <div class="col-md-8">
                            <div class="row">
                            <?php if($gallery): ?>
                                <?php foreach($gallery AS $gdata): ?>
                                    <?php  
                                    if ($gdata):
                                    ?>
                                    <div class="col-md-6">
                                        <img src="<?php echo $this->creative_lib->fetch_image($gdata['file']); ?>" alt="Gallery Image" class="img-raised"> 
                                        <div class="mt-2"><?php echo $gdata['description']; ?></div>
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
