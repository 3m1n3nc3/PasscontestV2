
<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('layout/header') ?>
<?php $this_page = isset($page_subtitle) ? $page_subtitle : (isset($page_title) ? $page_title : '') ?>

<body class="user-profile">

  <script type="text/javascript">
      site_url = '<?php echo site_url(); ?>';
  </script>
        
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          CT
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          <?= $this->my_config->item('site_name') ?>
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li<?= $this_page == 'edit_profile' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('user/account'); ?>">
              <i class="fas fa-user"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li<?= $this_page == 'account_settings' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('user/account/settings'); ?>">
              <i class="fa fa-wrench"></i>
              <p>Settings</p>
            </a>
          </li>
          <li<?= $this_page == 'account_contests' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('user/account/contests'); ?>">
              <?= isset($page_subtitle) && $this_page == 'account_contests' ? ' <i class="fas fa-chevron-left"></i>' : '' ?>
              <i class="fas fa-crown"></i>
              <p>Your Contests</p>
            </a>
          </li>
          <li<?= $this_page == 'account_credit' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('user/account/credit'); ?>">
              <i class="fas fa-coins"></i>
              <p><?= my_config('credit_name'); ?></p>
            </a>  
          </li>

          <?php if (has_privilege('manage-configuration')): ?>
          <li<?= $this_page == 'admin_configuration' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('manage/admin/configuration'); ?>">
              <i class="fas fa-cog"></i>
              <p>Site Configuration</p>
            </a>
          </li> 
          <?php endif; ?>

          <?php if (has_privilege('manage-contests')): ?>
          <li<?= $this_page == 'manage_contests' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('manage/admin/contests'); ?>">
              <?= isset($page_subtitle) && $this_page == 'manage_contests' ? ' <i class="fas fa-chevron-left"></i>' : '' ?>
              <i class="fas fa-crown"></i>
              <p>Manage Contests</p>
            </a>
          </li>  
          <?php endif; ?>

          <?php if (has_privilege('manage-users')): ?>
          <li<?= $this_page == 'manage_users' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('manage/admin/users'); ?>">
              <?= isset($page_subtitle) && $this_page == 'manage_users' ? ' <i class="fas fa-chevron-left"></i>' : '' ?>
              <i class="fas fa-users"></i>
              <p>Manage Users</p>
            </a>
          </li>  
          <?php endif; ?>

          <?php if (has_privilege('manage-credit')): ?>
          <li<?= $this_page == 'admin_credit' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('manage/admin/credit'); ?>">
              <i class="fas fa-coins"></i>
              <p><?= lang('manage').' '. my_config('credit_name'); ?></p>
            </a>
          </li> 
          <?php endif; ?>

          <?php if (has_privilege('manage-privilege')): ?>
          <li<?= $this_page == 'manage_privileges' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('manage/admin/privileges'); ?>">
              <i class="fas fa-lock"></i>
              <p><?= lang('manage_privileges') ?></p>
            </a>
          </li> 
          <?php endif; ?>

          <?php if (has_privilege('manage-pages')): ?>
          <li<?= $this_page == 'manage_pages' ? ' class="active"' : ''; ?>>
            <a href="<?= site_url('manage/admin/pages'); ?>">
              <?= isset($page_subtitle) && $this_page == 'manage_pages' ? ' <i class="fas fa-chevron-left"></i>' : '' ?>
              <i class="fas fa-pager"></i>
              <p><?= lang('manage').' '. lang('pages'); ?></p>
            </a>
          </li>  
          <?php endif; ?>

        </ul>
      </div>
    </div>

    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"><?= $name ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons media-2_sound-wave"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>                        
                  <?php if ($this->session->has_userdata('username')): ?> 
                  <a class="dropdown-item" href="<?= site_url('user/account/logout'); ?>">Logout</a>
                  <?php endif; ?>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="accountDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>                        
                  <?php if ($this->session->has_userdata('username')): ?> 
                  <a class="dropdown-item" href="<?= site_url('user/account/logout'); ?>">Logout</a>
                  <?php endif; ?>
                </div> 
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
