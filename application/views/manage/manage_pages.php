      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-12"> 
            <div class="card">
              <div class="card-header"> 
                <h5 class="title"><?= lang($page_title); ?></h5>
                <div class="float-right">
                  <a href="<?= site_url('manage/admin/create_page')?>" class="btn btn-primary mr-1">Create New Page</a>
                </div> 
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12" id="msg_box">
                    <?= $this->session->flashdata('msg'); ?>
                  </div>
                </div> 

                <?= form_open(uri_string(), ['method' => 'get']);?>
                <label class="text-info" for="parent">Filter by Parent</label>
                <div class="form-row">
                  <div class="form-group col">
                    <select class="form-control" id="parent" name="parent">
                      <option value="non" <?= set_select('parent', 'non') ?>>No Parent</option>
                      <option value="" <?= set_select('parent', '') ?>>All</option>
                      <?php foreach($this->content_model->get_parent() AS $parent): ?> 
                        <?php 
                         $pager = $this->content_model->get(['safelink' => $parent['parent']]);
                         if($parent['parent'] != ''): ?>
                          <?= '<option value="'.$parent['parent'].'"'.set_select('parent', $parent['parent']).'>'.ucwords($pager['title']).'</option>' ?>   
                        <?php endif; ?>
                      <?php endforeach; ?> 
                    </select>
                  </div>

                  <div class="form-group col">
                    <button class="btn btn-primary btn-lg font-weight-bold pass"><i class="fa fa-spinner"></i> Filter</button>
                  </div>
                </div>
                <?= form_close(); ?>

                <hr class="bg-primary">

                <div class="row collections container">
                <?php if($contents): ?> 

                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th>Title</th>
                      <th>Content</th> 
                      <th>Parent</th> 
                      <th class="text-right">Priority</th>
                      <th class="text-right">Actions</th>
                    </tr>
                  </thead>
 
                  <?php 
                    $i = 0;
                    foreach($contents AS $content): 
                    $i++;
                  ?>  
                  <tbody>
                    <tr id="table_row_<?= $content['id'] ?>">
                      <td class="text-center"><?= $i; ?></td>
                      <?php if(!$content['parent']): ?> 
                      <td class="text-info font-weight-bold"><a href="<?= site_url('home/page/'.$content['safelink']) ?>"><?= $content['title'] ?></a></td>
                      <?php else: ?> 
                      <td><?= $content['title'] ?></td>
                      <?php endif; ?> 
                      <td><?= word_limiter($content['content'], 30);?></td> 
                      <td><?= word_limiter($content['parent'] ? $this->content_model->get(['safelink' => $content['parent']])['title'] : '', 5);?></td> 
                      <td class="text-right"><?= $content['priority'] ?></td>
                      <td class="td-actions text-right">
                        <a href="<?= site_url('manage/admin/create_page/edit/'.$content['id']);?>" class="btn btn-info">
                            <i class="fa fa-edit fa-fw"></i>
                        </a> 
                        <button class="btn btn-danger deleter" 
                          onclick="deleteItem({type: 'page', action: 1, id: '<?= $content['id'];?>', init: 'table'})">
                          <i class="fa fa-trash fa-fw"></i>
                        </button>
                      </td>
                    </tr>  
                  </tbody>
                <?php endforeach; ?> 
                </table>
 
                <?php else: ?>
                    <?php echo $this->creative_lib->default_card(lang('no_contests'));?>
                <?php endif; ?> 
                </div>

              </div>
            </div>  

            <?= $pagination;?>

          </div> 
        </div>
      </div>
