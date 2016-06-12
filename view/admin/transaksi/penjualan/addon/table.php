<table class="table table-bordered table-striped" id="tbl_brg">
	<thead>
		<tr>
			<th style="width: 10px">#</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Satuan</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th style="width: 100px">Action</th>
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
				<td><?php echo $value['kode_barang'] ?></td>
				<td><?php echo $value['nama_barang'] ?></td>
				<td><?php echo $value['satuan'] ?></td>
				<td><?php echo Lib::ind($value['harga_jual']) ?></td>
				<td><?php echo $value['jumlah_jual'] ?></td>
				<td><?php echo Lib::ind($value['harga_jual']*$value['jumlah_jual']) ?></td>
				<td width="20" align="center">
					<a href="#tbl_brg" onclick="hapus_barang(<?php echo $value['id_jual'] ?>, '<?php echo $value['kode_barang'] ?>', <?php echo $value['jumlah_jual'] ?>)">
						<i style="font-size:1.8em" class="fa fa-trash"></i>
					</a>
				</td>
			</tr>
			<?php 
			$tot[] = $value['harga_jual']*$value['jumlah_jual'];
			}} ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="6">Total</th>
					<th>
						<?php
						if(isset($tot)){
							echo Lib::ind(array_sum($tot));
						}
						?>
					</th>
				</tr>
			</tfoot>
		</table>
		<script type="text/javascript">
		function hapus_barang(id, kode_barang, jml)
		{
			$.get("<?php echo app_base.'delete_barang_transaksi_penjualan&id_jual=' ?>"+id+"&kode_barang="+kode_barang+"&jumlah="+jml, function(data){
				tabel();
			});
		}
		</script>