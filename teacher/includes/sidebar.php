<aside class="main-sidebar sidebar-light-primary elevation-3">

  <a href="../../../index.php" class="brand-link">
    <span class="brand-text font-weight-normal text-lg text-dark"><?= $system_name ?></span>
  </a>
  <?php $page = basename(dirname($_SERVER['PHP_SELF'])); ?>
  <div class="sidebar">
    <nav class="mt-4">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
            <i class="fa fa-home nav-icon"></i>
            <p>Dashboard </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="../admins" class="nav-link <?= $page == 'admins' ? 'active' : '' ?>">
            <i class="fas fa-user-shield nav-icon"></i>
            <p>Admins </p>
          </a>
        </li> -->
        <li class="nav-item">
          <a href="../students" class="nav-link <?= $page == 'students' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>Students</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../attendance" class="nav-link <?= $page == 'attendance' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file"></i>
            <p>Attendance Record</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../qr-code" class="nav-link <?= $page == 'qr-code' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-qrcode"></i>
            <p>Generate QR Code</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>