<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang
        <small>/ Tambah Barang</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <form method="post" action="<?php echo app_base.'save_barang' ?>">
        <div class="box-body">
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Kode barang</label>
				        		<div class="col-md-8">
				        			<input type="text" name="kode_barang" class="form-control" placeholder="Kode barang" readonly required value="B<?php echo mt_rand(100, 999) ?>">
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Kategori</label>
				        		<div class="col-md-8">
				        			<select class="form-control" name="id_kategori" required>
				        				<?php echo Lib::dropKategori() ?>
				        			</select>
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Nama Barang</label>
				        		<div class="col-md-8">
				        			<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required>
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Satuan</label>
				        		<div class="col-md-8">
				        			<input type="text" name="satuan" class="form-control" placeholder="Satuan" required>
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Harga Beli</label>
				        		<div class="col-md-8">
				        			<input type="text" name="harga_beli" class="form-control" placeholder="Harga Beli" required pattern="[0-9].{1,}" title="Gunakan Format Angka">
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Harga Jual</label>
				        		<div class="col-md-8">
				        			<input type="text" name="harga_jual" class="form-control" placeholder="Harga Jual" required pattern="[0-9].{1,}" title="Gunakan Format Angka">
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<!-- <div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">Stok Awal</label>
				        		<div class="col-md-8">
				        			<input type="text" name="stok_awal" class="form-control" placeholder="Stok Awal" required>
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div> -->

	       
        </div>
         <!-- /.box-body -->
         <div class="box-footer">
         	<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
         	<a href="<?php echo app_base.'index_barang' ?>">
         		<button type="button" class="btn btn-danger"><i class="fa fa-arrow-left"></i>  Kembali</button>
         	</a>
         </div>
         </form>	
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->