            <?php $segment = $this->uri->segment(2, 0); ?>

            <div class="page-header clear-filter page-header-small" filter-color="orange">
                <div class="page-header-image" data-parallax="true" style="background-image:url('<?= $this->creative_lib->fetch_image($cover); ?>');">
                </div>
                <div class="container">
                    <div class="photo-container">
                        <img src="<?= $this->creative_lib->fetch_image($avatar); ?>" alt="<?= $title; ?> Avatar">
                    </div>
                    <h3 class="title"><?= $title; ?></h3>
                    <p class="category"><?= $slug ?></p> 
                </div>
            </div>

            <div class="section">
                <div class="container">
                    <div class="button-container">

                        <?php if($segment !== 'details'): ?>
                        <a href="<?= site_url('contest/details/'.$safelink)?>" class="btn btn-info btn-round btn-lg pass-lg"><i class="fa fa-info-circle"></i> Details</a>
                        <?php endif; ?>
                        
                        <?php if ($entry && empty($this_contestant)): ?>
                        <a href="<?= site_url('user/account/update/apply/data/'.$id)?>" class="btn btn-primary btn-round btn-lg pass-lg"><i class="fa fa-file-signature"></i> Register</a>
                        <?php endif; ?>

                        <?php if($segment !== 'contestants'): ?>
                        <a href="<?= site_url('contest/contestants/'.$id)?>" class="btn btn-warning btn-round btn-lg pass-lg"><i class="fa fa-users"></i> Contestants</a>
                        <?php endif; ?>

                        <a href="https://facebook.com/<?= $facebook ?>" class="btn btn-success btn-round btn-lg btn-icon" rel="tooltip" title="Follow this contest">
                            <i class="fa fa-dice-d20 pass"></i>
                        </a>

                        <?php if($facebook): ?>
                        <a href="https://facebook.com/<?= $facebook ?>" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Follow us on Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <?php endif; ?>

                        <?php if($instagram): ?>
                        <a href="https://instagram.com/<?= $instagram ?>" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Follow us on Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <?php endif; ?>
                    </div>
