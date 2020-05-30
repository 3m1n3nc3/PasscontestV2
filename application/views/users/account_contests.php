      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8"> 
            <div class="card">
              <div class="card-header">
                <div class="float-right">
                  <a href="<?= site_url('manage/contest/create')?>" class="btn btn-primary mr-1">New Contest</a>
                </div>
                <h5 class="title"><?= lang($page_title); ?></h5>
              </div>
              <?= $pending_contestants; ?> 
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <?= $this->session->flashdata('msg'); ?>
                  </div>
                </div> 

                <div class="row collections container">
                <?php if($contests): ?>
                  <?php foreach($contests AS $contest): ?>   
                  <div class="col-md-6"> 
                    <div class="card">
                      <a href="<?php echo site_url('contest/details/'.$contest['safelink']); ?>">
                        <img class="card-img-top" src="<?php echo $this->creative_lib->fetch_image($contest['cover']); ?>" alt="<?php echo $contest['title']; ?> image cap">
                      </a>
                      <div class="card-body">
                        <h4 class="card-title mt-0"><a href="<?php echo site_url('contest/details/'.$contest['safelink']); ?>"><?php echo $contest['title']; ?></a></h4>
                        <p class="card-text"><?php echo $contest['description']; ?></p>
                        <?php echo $this->passcontest->vote_bar(['contest_id' => $contest['id']]); ?>
                      </div>
                    </div>                                            
                  </div>   
                  <?php endforeach; ?> 
                <?php else: ?>
                    <?php echo $this->creative_lib->default_card(lang('no_contest_created'));?>
                <?php endif; ?> 
                </div>

              </div>
            </div> 
          </div>
          
          <!-- Right profile sidebar -->
          <?php $this->load->view('layout/_right_profile_sidebar') ?> 
          
        </div>
      </div>
