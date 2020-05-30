            <?php $this->load->view('layout/main_header', $view_data); ?>
            <div class="page-header clear-filter" filter-color="orange"> 
              <div class="page-header-image" style="background-image:url(http://passcontest2.te/resources/img/ryan.jpg)"></div> 
              <div class="content"> 
                <div class="container"> 
                  <div class="col-md-4 ml-auto mr-auto"> 
                    <div class="card card-login card-plain" style="width: auto; max-width: unset;">   
                      <div class="card-body pass-md"> 
                        <h1><?= $title; ?></h1>
                        <h3><?= $message; ?></h3>
                      </div>  
                    </div> 
                  </div> 
                </div> 
              </div> 
            </div>
            <?php $this->load->view('layout/main_footer', $view_data); ?>
