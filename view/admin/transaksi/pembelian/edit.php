<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Pembelian
        <small>/ Edit Transaksi Pembelian</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Transaksi Pembelian</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <?php
        if($data == null){

        }else{

        foreach ($data as $key => $value) {
        ?>
        <form method="post" action="<?php echo app_base.'add_barang_transaksi_pembelian' ?>" id="save_transaksi_pembelian">
        <input type="hidden" name="status" value="1">
        <div class="box-body">
        	<div class="row">
        		<div class="col-md-6">
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Kode Pembelian</label>
	        				<div class="col-md-8">
	        					<input type="text" name="kode_pembelian" class="form-control" readonly required value="<?php echo $value['kode_beli'] ?>">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Tanggal Pembelian</label>
	        				<div class="col-md-8">
	        					<input type="text" name="tglbeli" class="form-control" id="datepicker" value="<?php echo Lib::dateInd($value['tanggal_beli'], true) ?>" required value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Supplier</label>
	        				<div class="col-md-8">
	        					<select class="form-control select2" name="kode_supplier" style="width: 100%;" required>
				                  <?php echo Lib::dropSupplier($value['kode_supplier']) ?>
				                </select>
	        				</div>
	        			</div>
        			</div>
        		</div>
        		<div class="col-md-6">
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Nama Barang</label>
	        				<div class="col-md-8">
	        					<select class="form-control select2" name="kode_barang" style="width: 100%;">
				                  <?php echo Lib::dropBarang() ?>
				                </select>
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Satuan</label>
	        				<div class="col-md-8">
	        					<input type="text" name="satuan" class="form-control" readonly value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Harga</label>
	        				<div class="col-md-8">
	        					<input type="text" name="harga_beli" class="form-control" readonly value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Jumlah</label>
	        				<div class="col-md-8">
	        					<input type="text" name="jumlah_beli" class="form-control" value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Total</label>
	        				<div class="col-md-8">
	        					<input type="text" name="total_beli" class="form-control" value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
        					<label class="col-md-4 control-label"></label>
        					<div class="col-md-8">
        						<button class="btn btn-success pull-left"><i class="fa fa-plus"></i> Tambah</button>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	
	        <div class="row">
	        	<div class="col-md-12">
	        		<div id="tabel-beli"></div>
	        		
	        	</div>
	        </div>
	        	

	       
        </div>
         <!-- /.box-body -->
         <div class="box-footer">
         	<button type="button" onclick="simpan()" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
         	<a href="<?php echo app_base.'index_transaksi_pembelian' ?>">
         		<button type="button" class="btn btn-danger"><i class="fa fa-arrow-left"></i>  Kembali</button>
         	</a>
         </div>
         </form>	
         <?php
            }}
         ?>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

<script type="text/javascript">
	$(document).ready(function(){
		tabel();
	});

	//Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format: "dd/mm/yyyy"
    });
    //Initialize Select2 Elements
    $(".select2").select2();

    $("input[name=harga_beli], input[name=jumlah_beli]").keyup(function(){
    	hitung();
    });

    $('select[name=kode_barang]').change(function(){
    	var kd = $('select[name=kode_barang]').val();
    	get_list_barang(kd);
    });

    function tabel()
    {
    	$('#tabel-beli').load("<?php echo base_url.'function/func.php?func=tabel_beli_barang&kode_beli=' ?>"+$('input[name=kode_pembelian]').val());
    }

    function hitung()
    {
    	var hbeli = $('input[name=harga_beli]').val();
    	var jmlbeli = $('input[name=jumlah_beli]').val();
    	total = hbeli * jmlbeli;
    	$('input[name=total_beli]').val(total);
    }

    function get_list_barang(id)
    {
    	$.get("<?php echo base_url.'function/func.php' ?>?func=dropdown_barang&kode_barang="+id, function(data){
    		var json = $.parseJSON(data);
    		// console.log(json);
    		if(json != null){
    			$('input[name=satuan]').val(json.satuan);
    			$('input[name=harga_beli]').val(json.harga_beli);
    			hitung();
    		}else{
    			$('input[name=satuan]').val('');
    			$('input[name=harga_beli]').val('');
    		}
    	});
    }

    function form_barang_reset()
    {
    	$('select[name=kode_barang]').select2("val", "");
    	$('input[name=jumlah_beli]').val('');
    	$('input[name=total_beli]').val('');
    }

    $('#save_transaksi_pembelian').submit(function(event){
    	event.preventDefault();
    	// "<?php echo app_base.'add_barang_transaksi_pembelian' ?>"
    	$.post(
    		$(this).prop('action'),
    		{
    			"kode_beli"		: $('input[name=kode_pembelian]').val(),
    			"tanggal_beli"	: $('input[name=tglbeli]').val(),
    			"kode_supplier"	: $('select[name=kode_supplier]').val(),
    			"kode_barang"	: $('select[name=kode_barang]').val(),
    			"jumlah_beli"	: $('input[name=jumlah_beli]').val(),
    			"harga_beli"	: $('input[name=harga_beli]').val()
    		},
    		function(data){
    			// var json = $.parseJSON(data);
    			console.log(data);
    			tabel();
    			form_barang_reset();
    		},
    		'json'
    		);
    });

    function simpan()
    {
    	$.get("<?php echo app_base.'save_transaksi_pembelian&kode_beli=' ?>"+$('input[name=kode_pembelian]').val(), function(data){
    		location.replace("<?php echo app_base.'index_transaksi_pembelian' ?>");
    	});
    }
</script>