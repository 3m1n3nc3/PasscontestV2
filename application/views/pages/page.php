<div class="wrapper">
    <div class="page-header page-header-small">
    <div class="page-header-image" data-parallax="true" style="<?= $content['banner'] ? 'background-image: url(\''.$this->creative_lib->fetch_image($content['banner']).'\');' : 'background: linear-gradient(150deg, #f96331, transparent)'; ?>">
    </div>
    <div class="content-center">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <h1 class="title"><?= $content['title'] ?></h1>
                <h4><?= $content['intro'] ?></h4>
            </div>
        </div>
    </div>
</div>

<?php
    $i_query_1    = array('parent' => $content['safelink'], 'section' => 'info', 'priority' => 1); 
    $infochildren_1 = $this->content_model->get($i_query_1);

    $i_query_2    = array('parent' => $content['safelink'], 'section' => 'info', 'priority' => 2); 
    $infochildren_2 = $this->content_model->get($i_query_2);

    $i_query_3    = array('parent' => $content['safelink'], 'section' => 'info', 'priority' => 3); 
    $infochildren_3 = $this->content_model->get($i_query_3);

    $f_query    = array('parent' => $content['safelink'], 'section' => 'feature', 'priority' => 1); 
    $featurechildren = $this->content_model->get($f_query);

    $c_query    = array('parent' => $content['safelink'], 'section' => 'card', 'priority' => 2); 
    $cardchild = $this->content_model->get($c_query)[0];

    $h_query    = array('parent' => $content['safelink'], 'section' => 'highlight');  
    $highlightchildren = $this->content_model->get($h_query);

    $t_query    = array('parent' => $content['safelink'], 'section' => 'team'); 
    $teamchildren = $this->content_model->get($t_query);
?>

<div class="section">
    <div class="about-description text-center">
        <div class="features-3">
            <div class="container">
                <?php if ($infochildren_1): ?>
                    <?php foreach ($infochildren_1 AS $i_child): ?>
                        <div class="row">
                            <div class="col-md-8 mr-auto ml-auto">
                                <h2 class="title"><?= $i_child['title'] ?></h2>
                                <h4 class="description"><?= $i_child['content'] ?></h4>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="row">
                        <div class="col-md-8 mr-auto ml-auto"> 
                            <h4 class="description"><?= $content['content'] ?></h4>
                        </div>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <?php if ($featurechildren): ?>
                        <?php foreach ($featurechildren AS $f_child): ?>
                            <div class="col-md-4">
                                <div class="info info-hover">
                                    <div class="icon icon-<?= $f_child['color'] ?> icon-circle">
                                        <i class="<?= $f_child['icon'] ?>"></i>
                                    </div>
                                    <h4 class="info-title"><?= $f_child['title'] ?></h4>
                                    <p class="description"><?= $f_child['content'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?> 
                    <?php endif; ?>  
                </div>

            </div>
        </div>
    </div>
    <?php if ($featurechildren): ?>
        <div class="separator-line separator-primary"></div>
    <?php endif; ?> 

    <div class="projects-5">
        <div class="container">

            <?php if ($infochildren_2): ?>
                <?php foreach ($infochildren_2 AS $ii_child): ?>

                    <div class="row">
                        <div class="col-md-8 mr-auto ml-auto text-center">
                            <h2 class="title"><?= $ii_child['title'] ?></h2>
                            <h4 class="description"><?= $ii_child['content'] ?></h4>
                            <div class="section-space"></div>
                        </div>
                    </div>

                <?php endforeach; ?> 
            <?php endif; ?> 

            <div class="row">

                <?php if ($cardchild && $cardchild['align'] == 'left'): ?> 

                    <div class="col-md-5 ml-auto">
                        <div class="card card-background card-background-product card-raised" style="background-image: url('<?= $this->creative_lib->fetch_image($cardchild['banner']) ?>')">
                            <div class="card-body">
                                <h2 class="card-title"><?= $cardchild['title'] ?></h2>
                                <p class="card-description">
                                    <?= $cardchild['content'] ?>
                                </p> 
                            </div>
                        </div>
                    </div>

                <?php endif; ?>  


                <?php if ($highlightchildren): ?>

                    <div class="col-md-5 <?=($cardchild && $cardchild['align'] == 'left' ? 'mr-auto' : 'ml-auto') ?> mt-5">

                        <?php foreach ($highlightchildren AS $h_child): ?>
                            <div class="info info-horizontal">
                                <div class="icon icon-<?= $h_child['color'] ?>">
                                    <i class="<?= $h_child['icon'] ?>"></i>
                                </div>
                                <div class="description">
                                    <h4 class="info-title"><?= $h_child['title'] ?></h4>
                                    <p class="description">
                                        <?= $h_child['content'] ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?> 

                    </div>

                <?php endif; ?>   

                <?php if ($cardchild && $cardchild['align'] == 'right'): ?> 
                    <div class="col-md-5 mr-auto mt-5">
                        <div class="card card-background card-background-product card-raised" style="background-image: url('<?= $this->creative_lib->fetch_image($cardchild['banner']) ?>')">
                            <div class="card-body">
                                <h2 class="card-title"><?= $cardchild['title'] ?></h2>
                                <p class="card-description">
                                    <?= $cardchild['content'] ?>
                                </p> 
                            </div>
                        </div>
                    </div>
                <?php endif; ?>  

            </div> 

        </div>
    </div>


    <div class="about-team team-4">
        <div class="container">

            <?php if ($infochildren_3): ?>
                <?php foreach ($infochildren_3 AS $iii_child): ?>

                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto text-center">
                            <h2 class="title"><?= $iii_child['title'] ?></h2>
                            <h4 class="description"><?= $iii_child['content'] ?></h4>
                        </div>
                    </div>

                <?php endforeach; ?> 
            <?php endif; ?> 

            <div class="row">

            <?php if ($highlightchildren): ?>
                <?php foreach ($highlightchildren AS $team): ?>

                    <div class="col-xl-6 col-lg-7 ml-auto mr-auto">
                        <div class="card card-profile card-plain">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="card-image">
                                        <a href="#">
                                            <img class="img img-raised rounded" src="<?= $this->creative_lib->fetch_image($team['banner']) ?>" />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $team['content'] ?></h4>
                                        <h6 class="category"><?= $team['content'] ?></h6>

                                        <p class="card-description">
                                            <?= $team['content'] ?>
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                <?php endforeach; ?> 
            <?php endif; ?> 

            </div>

        </div>
    </div> 
 
</div>
