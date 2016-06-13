<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang
        <small>/ Index Barang</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Index Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <a href="<?php echo app_base.'create_barang' ?>">
          	<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Barang</button>
          </a>
          <hr>
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th width="60">Satuan</th>
                  <th width="60">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($data == null){

                }else{
                foreach ($data as $key => $value) {
                ?>
                	<tr>
                		<td><?php echo $key+1 ?></td>
                		<td><?php echo $value['kode_barang'] ?></td>
                		<td><?php echo $value['nama_barang'] ?></td>
                		<td><?php echo Lib::ind($value['harga_beli']) ?></td>
                		<td><?php echo Lib::ind($value['harga_jual']) ?></td>
                		<td><?php echo $value['stok'] ?></td>
                		<td><?php echo $value['satuan'] ?></td>
                		<td align="center">
                			<a href="<?php echo app_base.'edit_barang&kode_barang='.$value['kode_barang'] ?>">
	          					<i style="font-size:1.8em; margin-right:20px" class="fa fa-edit"></i>
	          				</a>
	          				<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_barang&kode_barang='.$value['kode_barang'] ?>">
	          					<i style="font-size:1.8em" class="fa fa-trash"></i>
	          				</a>
                		</td>
                	</tr>
                <?php }} ?>
                </tbody>
              </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    <script>
  $(function () {
    $("#example1").DataTable({
    	"aoColumns": [
		      { "bSortable": false, "align" : "center"},
		      null,
		      null,
		      { "bSortable": false},
		      null,
		      null,
		      null,
		      { "bSortable": false}
        	],
        	"order" : [0, "asc"],
    });
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false
    // });
  });
</script>