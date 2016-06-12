<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Pembelian Barang
        <small>/ Index Laporan Pembelian Barang</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Index Laporan Pembelian Barang</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form method="get" action="<?php echo app_base.'index_laporan_pembelian' ?>">
        <input type="hidden" name="page" value="index_laporan_pembelian">
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
			        				<input type="radio" name="type_laporan" value="tanggal" required>
			        				Tanggal
			        			</label>
				        		<div class="col-md-8">
				        			<div class="row">
				        				<div class="col-md-5" style="padding-right:0px">
				        					<input type="text" name="dari" class="form-control" id="datepicker1" value="<?php echo date("d/m/Y") ?>">
				        				</div>
				        				<div class="col-md-1" style="text-align:center">
				        					s.d
				        				</div>
				        				<div class="col-md-6">
				        					<input type="text" name="sampai" class="form-control" id="datepicker2" value="<?php echo date("d/m/Y") ?>">
				        				</div>
				        			</div>
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
			        				<input type="radio" name="type_laporan" value="supplier" required>
			        				Supplier
			        			</label>
				        		<div class="col-md-8">
				        			<select class="form-control select2" name="kode_supplier" style="width: 100%;" >
					                  <?php echo Lib::dropSupplier() ?>
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
			        				<input type="radio" name="type_laporan" value="barang" required>
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
	        		<h4>Laporan Data Pembelian Barang</h4>
	        		<?php
	        		if(!empty($g['dari'])){
	        			$dr = $g['dari'];
	        		}else{
	        			$dr = date("d-m-Y");
	        		}
	        		if(!empty($g['sampai'])){
	        			$smp = $g['sampai'];
	        		}else{
	        			$smp = date("d-m-Y");
	        		}
	        		?>
	        		<h5>Periode : <?php echo $dr.' s/d '.$smp ?></h5>
	        	</center>
	        	<table id="example1" class="table table-bordered table-striped" style="margin-top:10px;">
                <thead>
                <tr>
                  <th width="10">#</th>
                  <th>Kode Transaksi</th>
                  <th>Tanggal</th>
                  <th>Supplier</th>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Harga</th>
                  <th>Sub Total</th>
                </tr>
                </thead>
                <tbody>
	        		<?php
	        			foreach ($data as $key => $value) {
	        		?>
	        		<tr>
	        			<td><?php echo $key+1 ?></td>
	        			<td><?php echo $value['kode_beli'] ?></td>
	        			<td><?php echo Lib::dateInd($value['tanggal_beli'], true) ?></td>
	        			<td><?php echo Lib::namaSupplier($value['kode_supplier']) ?></td>
	        			<td><?php echo Lib::namaBarang($value['kode_barang']) ?></td>
	        			<td><?php echo $value['jumlah_beli'] ?></td>
	        			<td><?php echo $value['satuan'] ?></td>
	        			<td><?php echo Lib::ind($value['harga_beli']) ?></td>
	        			<td><?php echo Lib::ind($value['jumlah_beli']*$value['harga_beli']) ?></td>
	        		</tr>
	        		<?php
	        			$sub_total[] = $value['jumlah_beli']*$value['harga_beli'];
	        			}
	        		?>
	        	</tbody>
	        	<tfoot>
	        		<tr>
	        			<th colspan="8">Grand Total</th>
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
    	 $('#datepicker1, #datepicker2').datepicker({
	      autoclose: true,
	      format: "dd/mm/yyyy"
	    });
    	 function print()
    	 {
    	 	if($('input[name=type_laporan]').is(':checked')){
    	 		// alert($('input[name=type_laporan]:checked').val());	
    	 		window.open("<?php echo base_url.'function/func.php?func=laporan_pembelian' ?>"+"&type_laporan="+$('input[name=type_laporan]:checked').val()+"&id_kategori="+$('select[name=id_kategori]').val()+"&kode_barang="+$('select[name=kode_barang]').val()+"&kode_supplier="+$('select[name=kode_supplier]').val()+"&dari="+$('input[name=dari]').val()+"&sampai="+$('input[name=sampai]').val(),'_blank');
    	 	}
    	 }
    </script>