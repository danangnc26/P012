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
		<h4>JJ EDUCATION TOYS SEMARANG</h4>
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
			if($data == null){
				echo Lib::tblNotFound(8);
			}else{
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
			}}
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
</div>