<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'lib.php';
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'class/Core.php';

if(isset($_GET['func'])){
	$func = $_GET['func'];
}else{
	$func = '';
}

switch ($func) {
	case 'dropdown_barang':
		$res = json_encode(Lib::getBarang($_GET['kode_barang'])[0]);
		break;
	case 'tabel_beli_barang':
			// include dirname(__DIR__)."/view/admin/transaksi/pembelian/index.php";
			$data = Lib::raw("SELECT tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang_beli.harga_beli, tbl_barang_beli.jumlah_beli, tbl_barang_beli.id_beli, tbl_barang_beli.kode_barang, tbl_barang_beli.kode_beli FROM tbl_barang INNER JOIN tbl_barang_beli ON tbl_barang_beli.kode_barang = tbl_barang.kode_barang WHERE tbl_barang_beli.kode_beli='".$_GET['kode_beli']."'");
			include dirname(__DIR__)."/view/admin/transaksi/pembelian/addon/table.php";
		break;
	case 'tabel_jual_barang':
			// include dirname(__DIR__)."/view/admin/transaksi/pembelian/index.php";
			$data = Lib::raw("SELECT tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang_jual.harga_jual, tbl_barang_jual.jumlah_jual, tbl_barang_jual.id_jual, tbl_barang_jual.kode_barang, tbl_barang_jual.kode_jual FROM tbl_barang INNER JOIN tbl_barang_jual ON tbl_barang_jual.kode_barang = tbl_barang.kode_barang WHERE tbl_barang_jual.kode_jual='".$_GET['kode_jual']."'");
			include dirname(__DIR__)."/view/admin/transaksi/penjualan/addon/table.php";
		break;
	case 'ajax_success':
		$res = json_encode(['status' => true]);
		break;
	case 'laporan_stok':
			if(isset($_GET['type_laporan']) || isset($_GET['id_kategori']) || isset($_GET['kode_barang'])){
				$data = Lib::laporanStok($_GET['type_laporan'],$_GET['id_kategori'],$_GET['kode_barang']);
			}else{
				$data = null;
			}
			include dirname(__DIR__)."/view/admin/laporan/printout/stok.php";
		break;
	case 'laporan_pembelian':
			if(isset($_GET['type_laporan']) || isset($_GET['id_kategori']) || isset($_GET['kode_barang']) || isset($_GET['kode_supplier']) || isset($_GET['dari']) || isset($_GET['sampai'])){
					$data = Lib::laporanPembelian($_GET['type_laporan'],$_GET['id_kategori'],$_GET['kode_barang'], $_GET['kode_supplier'], $_GET['dari'], $_GET['sampai']);
				}else{
					$data = null;
				}
			include dirname(__DIR__)."/view/admin/laporan/printout/pembelian.php";
		break;
	case 'laporan_penjualan':
			if(isset($_GET['type_laporan']) || isset($_GET['id_kategori']) || isset($_GET['kode_barang']) || isset($_GET['dari']) || isset($_GET['sampai'])){
					$data = Lib::laporanPenjualan($_GET['type_laporan'],$_GET['id_kategori'],$_GET['kode_barang'], $_GET['dari'], $_GET['sampai']);
				}else{
					$data = null;
				}
			include dirname(__DIR__)."/view/admin/laporan/printout/penjualan.php";
		break;
	
	default:
		$res = '';
		break;
}

if(isset($res)){
	echo $res;
}
