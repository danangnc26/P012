<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kategori Barang
        <small>/ Tambah Kategori Barang</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Kategori Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <form method="post" action="<?php echo app_base.'save_kategori' ?>">
        <div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Nama Kategori</label>
				        		<div class="col-md-8">
				        			<input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required>
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>	       
        </div>
         <!-- /.box-body -->
         <div class="box-footer">
         	<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
         	<a href="<?php echo app_base.'index_kategori' ?>">
         		<button type="button" class="btn btn-danger"><i class="fa fa-arrow-left"></i>  Kembali</button>
         	</a>
         </div>
         </form>	
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->