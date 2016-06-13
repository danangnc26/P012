<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kategori Barang
        <small>/ Index Kategori Barang</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Index Kategori Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <a href="<?php echo app_base.'create_kategori' ?>">
          	<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</button>
          </a>
          <hr>
          <table class="table table-bordered table-striped">
          	<thead>
          		<tr>
          			<th style="width: 10px">#</th>
          			<th>Nama Kategori</th>
          			<th style="width: 100px">Action</th>
          		</tr>
          	</thead>
          	<tbody>
          	<?php
          	if($data == null){
          		echo Lib::tblNotFound(3);
          	}else{
          	foreach ($data as $key => $value) {
          	?>
          		<tr>
          			<td><?php echo $key+1 ?></td>
          			<td><?php echo $value['nama_kategori'] ?></td>
          			<td align="center">
          			<a href="<?php echo app_base.'edit_kategori&id_kategori='.$value['id_kategori'] ?>">
          					<i style="font-size:1.8em; margin-right:20px" class="fa fa-edit"></i>
          				</a>
          				<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_kategori&id_kategori='.$value['id_kategori'] ?>">
          					<i style="font-size:1.8em" class="fa fa-trash"></i>
          				</a>
          			</td>
          		</tr>
          	<?php
          	}}
          	?>
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
        	"order" : [1, "asc"],
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