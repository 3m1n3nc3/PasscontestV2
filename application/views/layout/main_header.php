<!--

=========================================================
* Now UI Kit - v1.3.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-kit
* Copyright 2019 Creative Tim (http://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->

<?php 
    $has_banner = (isset($has_banner) ? 1 : 0);
    $extra_pad = (isset($extra_pad) ? 1 : 0);
    $active_page = (isset($active_page) ? $active_page : null);
?>

<!DOCTYPE html>
<html lang="en">

    <?php $this->load->view('layout/header') ?>

    <body class="<?php echo ($active_page ? $active_page : 'landing-page') ?> sidebar-collapse">

        <script type="text/javascript">
            site_url = '<?php echo site_url(); ?>';
        </script>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-primary<?php echo ($has_banner ? ' fixed-top navbar-transparent' : ' fixed-top')?>"<?php echo ($has_banner ? ' color-on-scroll="400"' : '') ?>> 
        
            <div class="container">
                <div class="dropdown button-dropdown">
                    <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                        <span class="button-bar"></span>
                        <span class="button-bar"></span>
                        <span class="button-bar"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-header">Dropdown header</a>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                        <?php if ($this->session->has_userdata('username')): ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('user/account/logout'); ?>">Logout</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="navbar-translate">
                    <a class="navbar-brand" href="https://demos.creative-tim.com/now-ui-kit/index.html" rel="tooltip" title="Designed by Invision. Coded by Creative Tim" data-placement="bottom" target="_blank">
                        Passcontest V2
                    </a>
                    <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar top-bar"></span>
                    <span class="navbar-toggler-bar middle-bar"></span>
                    <span class="navbar-toggler-bar bottom-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="<?php echo base_url('resources/img/blurred-image-1.jpg'); ?>">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.html">Back to Kit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('user/account'); ?>">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <p class="d-lg-none d-xl-none">Twitter</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
                                <i class="fab fa-facebook-square"></i>
                                <p class="d-lg-none d-xl-none">Facebook</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
                                <i class="fab fa-instagram"></i>
                                <p class="d-lg-none d-xl-none">Instagram</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        
        <?php if($active_page == 'login-page'): ?>
        <div class="page-header clear-filter" filter-color="orange"> 
        <?php else: ?>
        <div class="wrapper<?php echo (!$has_banner && $extra_pad ? ' mt-5 pt-5' : '') ?>"> 
        <?php endif; ?>


