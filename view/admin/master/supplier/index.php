<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Supplier
        <small>/ Index Supplier</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Index Supplier</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <a href="<?php echo app_base.'create_supplier' ?>">
          	<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Supplier</button>
          </a>
          <hr>
          <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Kode Supplier</th>
                  <th>Nama Nama Supplier</th>
                  <th>Alamat</th>
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
                		<td><?php echo $value['kode_supplier'] ?></td>
                		<td><?php echo $value['nama_supplier'] ?></td>
                    <td><?php echo $value['alamat'] ?></td>
                		<td align="center">
                			<a href="<?php echo app_base.'edit_supplier&kode_supplier='.$value['kode_supplier'] ?>">
	          					<i style="font-size:1.8em; margin-right:20px" class="fa fa-edit"></i>
	          				</a>
	          				<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_supplier&kode_supplier='.$value['kode_supplier'] ?>">
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
		      null,
		      { "bSortable": false}
        	],
        	"order" : [0, "asc"],
    });
  });
</script>