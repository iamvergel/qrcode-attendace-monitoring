<aside class="main-sidebar sidebar-light-primary elevation-3">

  <a href="../index.php" class="brand-link">
    <span class="brand-text font-weight-normal text-lg text-dark"><?= $system_name ?></span>
  </a>

  <?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1); ?>
  <div class="sidebar">
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex -column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="index.php" class="nav-link <?= $page == 'index.php' ? 'active' : '' ?>">
            <i class="fa fa-home nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="user-profile.php" class="nav-link <?= $page == 'user-profile.php' ? 'active' : '' ?>">
            <i class="nav-icon fa fa-user"></i>
            <p>Profile</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>