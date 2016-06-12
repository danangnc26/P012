<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Stok Barang
        <small>/ Index Laporan Stok Barang</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Index Laporan Stok Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form method="get" action="<?php echo app_base.'index_laporan_stok_barang' ?>">
        <input type="hidden" name="page" value="index_laporan_stok_barang">
        		<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">
			        				<input type="radio" name="type_laporan" value="semua" required>
			        				Semua Data
			        			</label>
				        		<div class="col-md-8">
				        			
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-6">
	        			<div class="form-group">
			        		<div class="row">
			        			<label class="col-md-4 control-label">
			        				<input type="radio" name="type_laporan" value="kategori" required>
			        				Kategori Barang
			        			</label>
				        		<div class="col-md-8">
				        			<select class="form-control" name="id_kategori">
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
			        			<label class="col-md-4 control-label">
			        				<input type="radio" name="type_laporan" value="kode" required>
			        				Nama Barang
			        			</label>
				        		<div class="col-md-8">
				        			<select class="form-control select2" name="kode_barang" style="width: 100%;">
					                  <?php echo Lib::dropBarang() ?>
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
			        			<label class="col-md-4 control-label">
			        				
			        			</label>
				        		<div class="col-md-8">
				        			<button class="btn btn-primary"><i class="fa fa-eye"></i> Tampilkan</button>
				        			<button onclick="print()" type="button" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
				        		</div>
			        		</div>
			        	</div>
	        		</div>
	        	</div>
	    </form>
	        	<?php
	        	if($data == null){
	        		// echo "<script>alert('Data tidak ditemukan')</script>";
	        	}else{
	        	?>
	        	<hr>
	        	<center>
	        		<h4>Laporan Data Barang</h4>
	        		<h5>Periode : <?php echo date("d-m-Y") ?></h5>
	        	</center>
	        	<table id="example1" class="table table-bordered table-striped" style="margin-top:10px;">
                <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Kategori</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th>Sub Total</th>
                </tr>
                </thead>
                <tbody>
	        	<?php
	        	foreach ($data as $key => $value) {
	        	?>
	        	<tr>
	        		<td><?php echo $key+1 ?></td>
	        		<td><?php echo $value['kode_barang'] ?></td>
	        		<td><?php echo $value['nama_barang'] ?></td>
	        		<td><?php echo Lib::namaKategori($value['id_kategori']) ?></td>
	        		<td><?php echo Lib::ind($value['harga_beli']) ?></td>
	        		<td><?php echo Lib::ind($value['harga_jual']) ?></td>
	        		<td><?php echo $value['stok'].' '.$value['satuan'] ?></td>
	        		<td><?php echo Lib::ind($value['harga_beli']*$value['stok']) ?></td>
	        	</tr>
	        	<?php
	        	$sub_total[] = $value['harga_beli']*$value['stok'];
	        	$sub_stok[] = $value['stok'];
	        	}
	        	?>
	        	</tbody>
	        	<tfoot>
	        		<tr>
	        			<th colspan="6">Grand Total</th>
	        			<th>
	        				<?php
	        				if(isset($sub_stok)){
	        					echo array_sum($sub_stok).'';
	        				}
	        				?>
	        			</th>
	        			<th>
	        				<?php
	        				if(isset($sub_total)){
	        					echo Lib::ind(array_sum($sub_total));
	        				}
	        				?>
	        			</th>
	        		</tr>
	        	</tfoot>
	        	</table>
	        	<?php
	        	}
	        	?>
	        	
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    <script type="text/javascript">
    	 $(".select2").select2();

    	 function print()
    	 {
    	 	if($('input[name=type_laporan]').is(':checked')){
    	 		// alert($('input[name=type_laporan]:checked').val());	
    	 		window.open("<?php echo base_url.'function/func.php?func=laporan_stok' ?>"+"&type_laporan="+$('input[name=type_laporan]:checked').val()+"&id_kategori="+$('select[name=id_kategori]').val()+"&kode_barang="+$('select[name=kode_barang]').val(),'_blank');
    	 	}
    	 }
    </script>