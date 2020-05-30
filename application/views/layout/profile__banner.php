            <?php $segment = $this->uri->segment(2, 0); ?>
            <div class="page-header clear-filter page-header-small" filter-color="orange">
                <div class="page-header-image" data-parallax="true" style="background-image:url('<?php echo $this->creative_lib->fetch_image($cover); ?>');">
                </div>
                <div class="container">
                    <div class="photo-container">
                        <img src="<?php echo $this->creative_lib->fetch_image($avatar); ?>" alt="<?php echo $name; ?> Avatar">
                    </div>
                    <h3 class="title"><?php echo $name; ?></h3>
                    <p class="category"><?php echo $bio ?></p> 
                </div>
            </div>

            <div class="section">
                <div class="container">
                    <div class="button-container">

                        <a href="#button" class="btn btn-primary btn-round btn-lg pass-lg"><i class="fa fa-user-plus"></i> Follow</a>  

                        <?php if($segment !== 'info'): ?>
                        <a href="<?php echo site_url('profile/info/'.$id); ?>" class="btn btn-info btn-round btn-lg pass-lg"><i class="fa fa-user"></i>  Profile</a> 
                        <?php endif; ?>

                        <?php if($segment !== 'gallery'): ?> 
                        <a href="<?php echo site_url('profile/gallery/'.$id); ?>" class="btn btn-info btn-round btn-lg pass-lg"><i class="fa fa-images"></i> Gallery</a> 
                        <?php endif; ?>

                        <?php if($facebook): ?>
                        <a href="https://facebook.com/<?php echo $facebook ?>" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Follow <?php echo $name; ?> on Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <?php endif; ?>

                        <?php if($instagram): ?>
                        <a href="https://instagram.com/<?php echo $instagram ?>" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Follow <?php echo $name; ?> on Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <?php endif; ?>
                    </div>
