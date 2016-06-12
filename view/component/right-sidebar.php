 <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light" >
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 style="margin-bottom:5px; margin-top:5px" class="control-sidebar-heading" style="margin-top:0px">Notifikasi Persediaan Barang</h3>
        <hr style="margin-top:0px; margin-bottom:0px">
        <ul class="control-sidebar-menu" style="overflow-y:scroll;">
        <?php
        if(Lib::minStock() == null){

        }else{
        foreach (Lib::minStock() as $key => $value) {
        ?>
          <li>
            <a href="<?php echo app_base.'create_transaksi_pembelian&kode_beli='.Lib::kodeBeli('beli') ?>">
              <i class="menu-icon fa fa-database bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading"><?php echo $value['nama_barang'] ?></h4>
                <p style="font-size:12px">Masih tersisa <?php  echo $value['stok'].' '.$value['satuan'] ?></p>
              </div>
            </a>
          </li>
        <?php
        }}
        ?>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>