<!-- Logo -->
    <a href="<?php echo app_base.'show_welcome' ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="font-size:15px; margin-top:5px; font-weight:bold; line-height:20px;">Sistem Persediaan Barang<br>JJ Education Toys</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <!-- <span class="logo-lg"></span> -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-warning"></i>
            <?php
            if(Lib::minStock() != null){
            ?>
            <span class="label label-danger" style="font-size:10px;">
              <?php echo count(Lib::minStock()); ?>
            </span>
            <?php
            }
            ?>
            </a>
          </li>
        </ul>
      </div>
    </nav>