<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Home Page
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Home Page</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
          <div class="col-md-12">
            <center>
              <h3 style="margin-top:0px; padding-top:0px;">Selamat Datang Administrator di</h3>
              <h2 style="margin-top:0px; padding-top:0px;">SISTEM INFORMASI PERSEDIAAN BARANG</h2>
              <h2 style="margin-top:0px; padding-top:0px;">JJ EDUCATION TOYS SEMARANG</h2>
              <img src="<?php echo base_url.'assets/img/logo.png' ?>" height="150">
            </center>
            <hr style="margin-bottom:5px">
            <center><b>CONTROL PANEL</b></center>
            <hr style="margin-top:5px;">
          </div>
          <a href="<?php echo app_base.'index_barang' ?>">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo Lib::count('barang') ?></h3>
                  <h4>Data Barang</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-database"></i>
                </div>
              </div>
            </div>
           </a>
           <a href="<?php echo app_base.'index_transaksi_pembelian' ?>">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo Lib::count('pembelian') ?></h3>
                  <h4>Pembelian</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-arrow-down"></i>
                </div>
              </div>
            </div>
           </a>
           <a href="<?php echo app_base.'index_transaksi_penjualan' ?>">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo Lib::count('penjualan') ?></h3>
                  <h4>Penjualan</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-arrow-up"></i>
                </div>
              </div>
            </div>
           </a>
           <a href="<?php echo app_base.'index_laporan_stok_barang' ?>">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3> </h3>
                  <h4 style="margin-top:51px">Stok Barang</h4>
                </div>
                <div class="icon">
                  <i class="fa fa-book"></i>
                </div>
              </div>
            </div>
           </a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
    <!-- /.content -->