<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengguna
        <small>/ Index Pengguna</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Index Pengguna</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <a href="<?php echo app_base.'create_user' ?>">
          	<button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pengguna</button>
          </a>
          <hr>
          <table class="table table-bordered table-striped">
          	<thead>
          		<tr>
          			<th style="width: 10px">#</th>
          			<th>Username</th>
          			<th>Nama</th>
          			<th>Status</th>
          			<th style="width: 100px">Action</th>
          		</tr>
          	</thead>
          	<tbody>
          	<?php 
          	if($data == null){
          		echo Lib::tblNotFound(5);
          	}else{
          	foreach ($data as $key => $value) {
          	?>
          		<tr>
          			<td><?php echo $key+1 ?></td>
          			<td><?php echo $value['username'] ?></td>
          			<td><?php echo $value['nama'] ?></td>
          			<td><?php echo ($value['is_active'] == 1) ? 'Aktif' : 'Tidak Aktif' ?></td>
          			<td align="center">
          				<a href="<?php echo app_base.'edit_user&id_user='.$value['id_user'] ?>">
          					<i style="font-size:1.8em; margin-right:20px" class="fa fa-edit"></i>
          				</a>
          				<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_user&id_user='.$value['id_user'] ?>">
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