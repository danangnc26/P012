<?php Lib::uCheck() ?>
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGASI</li>
        <li><a href="<?php echo app_base.'show_welcome' ?>"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <?php
            if($_SESSION['level_user'] == 'Super Admin'){
            ?>
            <li><a href="<?php echo app_base.'index_user' ?>"><i class="fa fa-circle-o"></i> Pengguna</a></li>
            <?php } ?>
            <li><a href="<?php echo app_base.'index_kategori' ?>"><i class="fa fa-circle-o"></i> Kategori Barang</a></li>
            <li><a href="<?php echo app_base.'index_barang' ?>"><i class="fa fa-circle-o"></i> Barang</a></li>
            <li><a href="<?php echo app_base.'index_supplier' ?>"><i class="fa fa-circle-o"></i> Supplier</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-compress"></i> <span>Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo app_base.'index_transaksi_pembelian' ?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
            <li><a href="<?php echo app_base.'index_transaksi_penjualan' ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo app_base.'index_laporan_stok_barang' ?>"><i class="fa fa-circle-o"></i> Stok Barang</a></li>
            <li><a href="<?php echo app_base.'index_laporan_pembelian' ?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
            <li><a href="<?php echo app_base.'index_laporan_penjualan' ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
          </ul>
        </li>
      	<li><a href="<?php echo app_base.'logout' ?>"><i class="fa fa-power-off"></i> <span>Keluar</span></a></li>
        <!-- <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->