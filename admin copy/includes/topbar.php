<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span><?php
        include_once('../../config/dbconn.php');
        if (isset($_SESSION['auth'])) {
          $sql = "SELECT * FROM tbluser WHERE id = '" . $_SESSION['auth_user']['user_id'] . "'";
          $query_run = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($query_run)) {
            ?>
              <span class="d-inline  d-md-inline btn btn-primary rounded-pill">
                <?= $row['fname'] . ' ' . $row['lname'] ?>
                <input type="hidden" id="session_id" value="<?= $row['id'] ?>">
              </span>
            <?php }
        } else {
          echo "Not Logged in";
        }

        ?>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item logoutbtn">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>