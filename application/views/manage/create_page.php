      <?php $switch = ($this->input->post() ? 1 : null) ?>
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <?= form_open(uri_string(), ['id' => 'sett_form', 'class' => 'needs-validation', 'novalidate' => null]); ?>
              <div class="card">
                <div class="card-header"> 
                <div class="float-right">
                  <a href="<?= site_url('manage/admin/create_page')?>" class="btn btn-primary mr-1">Create New Content</a>
                </div>
                  <h5 class="title"><?= lang($page_title); ?></h5>
                </div>
                <div class="card-body">
                  <div class="form-row">
                    <div class="col-md-12">
                      <?= $this->session->flashdata('msg'); ?>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="title">Title</label>
                        <input type="text" onkeyup="safeLinker(this)" class="form-control" name="title" placeholder="Title" value="<?= set_value_switch('title', $content['title']); ?>">
                        <?= form_error('title'); ?>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="safelink">Safelink</label>
                        <input type="text" class="form-control" name="safelink" placeholder="Safelink" value="<?= set_value_switch('safelink', $content['safelink']); ?>">
                        <?= form_error('safelink'); ?>
                      </div>
                    </div> 
                  </div>
                  <div class="form-row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label class="text-info" for="icon">Icon</label> 
                        <select class="form-control" id="icon" name="icon">
                           <?= pass_icon(1, $content['icon'], TRUE); ?>
                        </select>
                        <?= form_error('icon'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label class="text-info" for="color">Color (Use bootstrap Colors)</label>
                        <input type="text" class="form-control" name="color" placeholder="Color" value="<?= set_value_switch('color', $content['color']); ?>">
                        <?= form_error('color'); ?>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label class="text-info" for="priority">Priority</label>
                        <select class="form-control" id="priority" name="priority">
                          <option value="1" <?= set_select('priority', '1', int_bool($content['priority'] == '1' ? 1 : 0)) ?>>1</option> 
                          <option value="2" <?= set_select('priority', '2', int_bool($content['priority'] == '2' ? 1 : 0)) ?>>2</option>
                          <option value="3" <?= set_select('priority', '3', int_bool($content['priority'] == '3' ? 1 : 0)) ?>>3</option>
                        </select>
                        <?= form_error('priority'); ?>
                      </div> 
                    </div>
 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-info" for="parent">Parent</label>
                        <select class="form-control" id="parent" name="parent">
                          <option value="" <?= set_select('parent', '', int_bool($content['parent'])) ?>>No Parent</option> 
                          <?php foreach($this->content_model->get(['parent' => 'non']) AS $parent): ?> 
                            <?php
                             $pager = $this->content_model->get(['safelink' => $parent['safelink']]);
                             if($parent['safelink'] != ''): ?>
                              <?= '<option value="'.$parent['safelink'].'"'.set_select('parent', $parent['safelink'], int_bool($content['parent'] == $parent['safelink'] ? 1 : 0)).'>'.ucwords($pager['title']).'</option>' ?>   
                            <?php endif; ?>
                          <?php endforeach; ?> 
                        </select>
                      </div>
                    </div> 

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-info" for="section">Section</label>
                        <select class="form-control" id="section" name="section">
                          <option value="info" <?= set_select('section', 'info', int_bool($content['section'] == 'info' ? 1 : 0)) ?>>Info</option>
                          <option value="feature" <?= set_select('section', 'feature', int_bool($content['section'] == 'feature' ? 1 : 0)) ?>>Features</option> 
                          <option value="card" <?= set_select('section', 'card', int_bool($content['section'] == 'card' ? 1 : 0)) ?>>Card</option>
                          <option value="highlight" <?= set_select('section', 'highlight', int_bool($content['section'] == 'highlight' ? 1 : 0)) ?>>Highlights</option>
                          <option value="team" <?= set_select('section', 'team', int_bool($content['section'] == 'team' ? 1 : 0)) ?>>Team</option>
                        </select>
                      </div>
                    </div> 
 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="text-info" for="align">Align Children</label>
                        <select class="form-control" id="align" name="align">
                          <option value="left" <?= set_select('align', 'left', int_bool($content['align'] == 'left' ? 1 : 0)) ?>>Left</option> 
                          <option value="right" <?= set_select('align', 'right', int_bool($content['align'] == 'right' ? 1 : 0)) ?>>Right</option>
                        </select>
                      </div>
                    </div> 

                    <div class="form-group col-12 <?= $content['parent'] ? 'd-none' : '';?>" id="in_footer">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input name="in_footer" class="form-check-input text-primary" type="checkbox" value="1"<?= set_checkbox('in_footer', '1', int_bool($content['in_footer'])) ?>>
                          Show in Footer
                          <span class="form-check-sign">
                            <span class="check"></span>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>

                  <hr class="border-danger">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="text-info" for="intro">Introductory Text</label>
                        <input type="text" class="form-control" name="intro" placeholder="Introductory Text" value="<?= set_value_switch('intro', $content['intro']); ?>">
                        <?= form_error('intro'); ?>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="text-info" for="content">Content</label>
                      <textarea class="form-control" id="content" name="content"><?= $content['content']; ?></textarea>
                      <?= form_error('content'); ?>
                    </div>
  
                    <div class="col-md-12">
                      <div>
                        <button type="submit" class="btn btn-info pass">Create Content</button>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>
            <?= form_close() ?>
          </div>
          
          <div class="col-md-4">
            <div class="card"> 
              <div class="card-header"> 
                <h5 class="title"><?= $children_title ?></h5> 
              </div>
              <div class="card-body">
                <?php if ($children): ?>
                  <?php foreach ($children AS $child): ?>
                  <div class="list-group list-group-flush">
                    <a href="<?= site_url('manage/admin/create_page/edit/'.$child['id'])?>" class="list-group-item list-group-item-action<?= $content['id'] === $child['id'] ? ' active' : ''?>"><?= $child['title'] ?></a> 
                  </div>
                  <?php endforeach; ?>
                 <?php endif; ?>
              </div> 
            </div>
          </div>
          
        </div>
      </div>
