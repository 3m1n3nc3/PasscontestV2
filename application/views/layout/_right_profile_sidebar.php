          <?php
            $facebook  = $profile['facebook'];
            $twitter   = $profile['twitter'];
            $instagram = $profile['instagram'];
            $name      = $profile['name'];
            $description = $profile['description'];
            $avatar    = $profile['avatar'];
            $cover     = $profile['cover'];
            $link      = $profile['link'];
          ?>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="<?= $this->creative_lib->fetch_image($cover); ?>" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="<?= $link ?>">
                    <img class="avatar border-gray" src="<?= $this->creative_lib->fetch_image($avatar); ?>" alt="...">
                  </a>

                  <?php if ($profile['type']): ?>
                  <div class="text-center">
                    <button type="button" id="upload_resize_image" class="btn btn-info btn-sm" data-endpoint="contest" data-endpoint_id="<?= $contest['id']; ?>" data-toggle="modal" data-target="#passModal">Change Photos</button>
                  </div> 
                  <?php else: ?>
                  <div class="text-center">
                    <button type="button" id="upload_resize_image" class="btn btn-info btn-sm" data-endpoint="user" data-endpoint_id="<?= $profile['id']; ?>" data-toggle="modal" data-target="#passModal">Change Photos</button>
                  </div>
                  <?php endif; ?>

                  <a href="<?= $link ?>">
                    <h5 class="title"><?= $name; ?></h5>
                  </a>

                  <p class="description">
                    <?= $name; ?>
                  </p>
                </div>
                <p class="description text-center">
                  <?= $description; ?>
                </p>
              </div>
              <?php if ($facebook || $twitter || $instagram): ?>
              <hr>
              <div class="button-container">
                <?php if ($facebook): ?>
                <a href="https://facebook.com/<?= $facebook; ?>" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <?php endif; ?>
                <?php if ($twitter): ?>
                <a href="https://twitter.com/<?= $twitter; ?>" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-twitter"></i>
                </a>
                <?php endif; ?>
                <?php if ($instagram): ?>
                <a href="https://instagram.com/<?= $instagram; ?>" class="btn btn-neutral btn-icon btn-round btn-lg">
                  <i class="fab fa-instagram"></i>
                </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>

            </div>
          </div>
