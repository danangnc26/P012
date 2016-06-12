<script src="<?php echo base_url.'assets/js/' ?>jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		PrintElem('#print_laporan');
	});
	
	function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
    	console.log(data);
        var mywindow = window.open('', 'Print Laporan', 'height=600,width=1000');
        mywindow.document.write('<html><head><title>Print Laporan</title>');
        // optional stylesheet //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('<style>body{font-family:sans-serif}h4{font-size:25px;} hr{border:none; border-bottom:1px solid #000;} table{width:100%; border:1px solid #000; border-collapse:collapse} table td{font-size:12px; border:1px solid #000; padding:5px;} table th{border:1px solid #000; background:#dfdfdf}</style></head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>
<div id="print_laporan" style="width:80%;margin:auto">
<style type="text/css">
	h4{
		font-size: 25px;
		margin: 0px;
	}
	h5{
		margin: 10px;
	}
	body{
		font-family: sans-serif;
	}
	table{
		border:1px solid #333;
		border-collapse: collapse;
		width: 100%;
		margin: auto;
		font-size: 11px;
	}
	table th, td{
		border:1px solid #333;	
		padding: 5px;
	}
	table th{
		background: #dfdfdf;
	}
</style>
	        	<center>
	        		<h4>Laporan Data Pembelian Barang</h4>
	        		<?php
	        		if(!empty($_GET['dari'])){
	        			$dr = $_GET['dari'];
	        		}else{
	        			$dr = date("d-m-Y");
	        		}
	        		if(!empty($_GET['sampai'])){
	        			$smp = $_GET['sampai'];
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
			if($data == null){
				echo Lib::tblNotFound(9);
			}else{
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
			}}
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
</div>