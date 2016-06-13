<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi Penjualan
        <small>/ Tambah Transaksi Penjualan</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Transaksi Penjualan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <form method="post" action="<?php echo app_base.'add_barang_transaksi_penjualan' ?>" id="save_transaksi_penjualan">
        <input type="hidden" name="status" value="1">
        <div class="box-body">
        	<div class="row">
        		<div class="col-md-6">
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Kode Penjualan</label>
	        				<div class="col-md-8">
	        					<input type="text" name="kode_penjualan" class="form-control" readonly required value="<?php echo $g['kode_jual'] ?>">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Tanggal Penjualan</label>
	        				<div class="col-md-8">
	        					<input type="text" name="tgljual" class="form-control" id="datepicker" value="<?php echo date("d/m/Y") ?>" required value="">
	        				</div>
	        			</div>
        			</div>
        		</div>
        		<div class="col-md-6">
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Nama Barang</label>
	        				<div class="col-md-8">
	        					<select class="form-control select2" name="kode_barang" style="width: 100%;" required>
				                  <?php echo Lib::dropBarang() ?>
				                </select>
				                <input type="hidden" name="stok_saatini">
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
	        					<input type="text" name="harga_jual" class="form-control" readonly value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Jumlah</label>
	        				<div class="col-md-8">
	        					<input type="text" name="jumlah_jual" class="form-control" value="">
	        				</div>
	        			</div>
        			</div>
        			<div class="form-group">
        				<div class="row">
	        				<label class="col-md-4 control-label">Total</label>
	        				<div class="col-md-8">
	        					<input type="text" name="total_jual" class="form-control" value="">
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
	        		<div id="tabel-jual"></div>
	        		
	        	</div>
	        </div>
	        	

	       
        </div>
         <!-- /.box-body -->
         <div class="box-footer">
         	<button type="button" onclick="simpan()" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
         	<a href="<?php echo app_base.'index_transaksi_penjualan' ?>">
         		<button type="button" class="btn btn-danger"><i class="fa fa-arrow-left"></i>  Kembali</button>
         	</a>
         </div>
         </form>	
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

    $("input[name=harga_jual], input[name=jumlah_jual]").keyup(function(){
    	hitung();
    });

    $('select[name=kode_barang]').change(function(){
    	var kd = $('select[name=kode_barang]').val();
    	get_list_barang(kd);
    });

    function tabel()
    {
    	$('#tabel-jual').load("<?php echo base_url.'function/func.php?func=tabel_jual_barang&kode_jual=' ?>"+$('input[name=kode_penjualan]').val());
    }

    function hitung()
    {
    	var hjual = $('input[name=harga_jual]').val();
    	var jmljual = $('input[name=jumlah_jual]').val();
    	total = hjual * jmljual;
    	$('input[name=total_jual]').val(total);
    }

    function get_list_barang(id)
    {
    	$.get("<?php echo base_url.'function/func.php' ?>?func=dropdown_barang&kode_barang="+id, function(data){
    		var json = $.parseJSON(data);
    		// console.log(json);
    		if(json != null){
    			$('input[name=satuan]').val(json.satuan);
    			$('input[name=harga_jual]').val(json.harga_jual);
    			$('input[name=stok_saatini]').val(json.stok);
    			hitung();
    		}else{
    			$('input[name=satuan]').val('');
    			$('input[name=harga_jual]').val('');
    			$('input[name=stok_saatini]').val('');
    		}
    	});
    }

    function form_barang_reset()
    {
    	$('select[name=kode_barang]').select2("val", "");
    	$('input[name=jumlah_jual]').val('');
    	$('input[name=total_jual]').val('');
    }

    $('#save_transaksi_penjualan').submit(function(event){
    	event.preventDefault();
        var stk = parseInt($('input[name=stok_saatini]').val());
        var jml = parseInt($('input[name=jumlah_jual]').val());
    	// "<?php echo app_base.'add_barang_transaksi_penjualan' ?>"
    	if(stk < jml){
    		alert('Anda tidak bisa menjual lebih dari '+$('input[name=stok_saatini]').val()+' '+$('input[name=satuan]').val());
    	}else{
	    	$.post(
	    		$(this).prop('action'),
	    		{
	    			"kode_jual"		: $('input[name=kode_penjualan]').val(),
	    			"tanggal_jual"	: $('input[name=tgljual]').val(),
	    			"kode_barang"	: $('select[name=kode_barang]').val(),
	    			"jumlah_jual"	: $('input[name=jumlah_jual]').val(),
	    			"harga_jual"	: $('input[name=harga_jual]').val()
	    		},
	    		function(data){
	    			// var json = $.parseJSON(data);
	    			console.log(data);
	    			tabel();
	    			form_barang_reset();
	    		},
	    		'json'
    		);
    	}
    });

    function simpan()
    {
    	$.get("<?php echo app_base.'save_transaksi_penjualan&kode_jual=' ?>"+$('input[name=kode_penjualan]').val(), function(data){
    		location.replace("<?php echo app_base.'index_transaksi_penjualan' ?>");
    	});
    }
</script>