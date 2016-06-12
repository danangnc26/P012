<?php
session_start();
ob_start();
error_reporting(E_ALL ^ E_DEPRECATED);
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'bootstrap.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'lib.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../config/Config.php';

function route($page)
{
	$g = $_GET;
	$p = $_POST;
	$s = $_SESSION;

	$user = new Users();
	$kategori = new Kategori();
	$barang = new Barang();
	$supplier = new Supplier();
	$beli = new CBeli();
	$jual = new CJual();

	switch ($page) {

		case 'authenticate':
			$user->doLogin($p);
			break;
		case 'logout':
			$user->doLogout();
			break;

		// // // // // MASTER // // // // // 

		#MASTER USER
		case 'index_user':
				$data = $user->indexUser();
				include "view/admin/master/user/index.php";
			break;
		case 'create_user':
				include "view/admin/master/user/create.php";
			break;
		case 'save_user':
				$user->saveUser($p);
			break;
		case 'edit_user':
				$data = $user->findUser($g['id_user']);
				include "view/admin/master/user/edit.php";
			break;
		case 'update_user':
				$user->updateUser($p);
			break;
		case 'delete_user':
				$user->deleteUser($g['id_user']);
			break;

		#MASTER KATEGORI

		case 'index_kategori':
				$data = $kategori->index();
				include "view/admin/master/kategori/index.php";
			break;
		case 'create_kategori':
				include "view/admin/master/kategori/create.php";
			break;
		case 'save_kategori':
				$kategori->saveKategori($p);
			break;
		case 'edit_kategori':
				$data = $kategori->findKategori($g['id_kategori']);
				include "view/admin/master/kategori/edit.php";
			break;
		case 'update_kategori':
				$kategori->updateKategori($p);
			break;
		case 'delete_kategori':
				$kategori->deleteKategori($g['id_kategori']);
			break;

		#MASTER BARANG
		case 'index_barang':
				$data = $barang->index();
				include "view/admin/master/barang/index.php";
			break;
		case 'create_barang':
				include "view/admin/master/barang/create.php";
			break;
		case 'save_barang':
				$barang->saveBarang($p);
			break;
		case 'edit_barang':
				$data = $barang->findBarang($g['kode_barang']);
				include "view/admin/master/barang/edit.php";
			break;
		case 'update_barang':
				$barang->updateBarang($p);
			break;
		case 'delete_barang':
				$barang->deleteBarang($g['kode_barang']);
			break;

		#MASTER SUPPLIER
		case 'index_supplier':
				$data = $supplier->index();
				include "view/admin/master/supplier/index.php";
			break;
		case 'create_supplier':
				include "view/admin/master/supplier/create.php";
			break;
		case 'save_supplier':
				$supplier->saveSupplier($p);
			break;
		case 'edit_supplier':
				$data = $supplier->findSupplier($g['kode_supplier']);
				include "view/admin/master/supplier/edit.php";
			break;
		case 'update_supplier':
				$supplier->updateSupplier($p);
			break;
		case 'delete_supplier':
				$supplier->deleteSupplier($g['kode_supplier']);
			break;

		// // // // // TRANSAKSI // // // // // 

		#PEMBELIAN
		case 'index_transaksi_pembelian':
				$data = $beli->index();
				include "view/admin/transaksi/pembelian/index.php";
			break;
		case 'create_transaksi_pembelian':
				include "view/admin/transaksi/pembelian/create.php";
			break;
		case 'save_transaksi_pembelian':
				$beli->doneBeli($g['kode_beli']);
			break;
		case 'add_barang_transaksi_pembelian':
				$beli->saveBeli($p);
			break;
		case 'edit_transaksi_pembelian':
				$data = $beli->findBeli($g['kode_beli']);
				include "view/admin/transaksi/pembelian/edit.php";
			break;
		case 'update_transaksi_pembelian':
			# code...
			break;
		case 'delete_transaksi_pembelian':
				$beli->deleteTransPembelian($g['kode_beli']);
			break;
		case 'delete_barang_transaksi_pembelian':
				$beli->deleteBarangTerbeli($g['id_beli'], $g['kode_barang'], $g['jumlah']);
			break;
		




		#PENJUALAN
		case 'index_transaksi_penjualan':
				$data = $jual->index();
				include "view/admin/transaksi/penjualan/index.php";
			break;
		case 'create_transaksi_penjualan':
				include "view/admin/transaksi/penjualan/create.php";
			break;
		case 'save_transaksi_penjualan':
				$jual->doneJual($g['kode_jual']);
			break;
		case 'add_barang_transaksi_penjualan':
				$jual->saveJual($p);
			break;
		case 'edit_transaksi_penjualan':
				$data = $jual->findJual($g['kode_jual']);
				include "view/admin/transaksi/penjualan/edit.php";
			break;
		case 'update_transaksi_penjualan':
			# code...
			break;
		case 'delete_transaksi_penjualan':
				$jual->deleteTransPenjualan($g['kode_jual']);
			break;
		case 'delete_barang_transaksi_penjualan':
				$jual->deleteBarangTerjual($g['id_jual'], $g['kode_barang'], $g['jumlah']);
			break;

		// // // // // LAPORAN // // // // // 

		#STOK BARANG
		case 'index_laporan_stok_barang':
				if(isset($g['type_laporan']) || isset($g['id_kategori']) || isset($g['kode_barang'])){
					$data = $barang->getLaporan($g['type_laporan'],$g['id_kategori'],$g['kode_barang']);
				}else{
					$data = null;
				}
				include "view/admin/laporan/laporan_stok.php";
			break;

		#PEMBELIAN
		case 'index_laporan_pembelian':
				if(isset($g['type_laporan']) || isset($g['id_kategori']) || isset($g['kode_barang']) || isset($g['kode_supplier']) || isset($g['dari']) || isset($g['sampai'])){
					$data = $beli->getLaporan($g['type_laporan'],$g['id_kategori'],$g['kode_barang'], $g['kode_supplier'], $g['dari'], $g['sampai']);
				}else{
					$data = null;
				}
				include "view/admin/laporan/laporan_pembelian.php";
			break;

		#PENJUALAN
		case 'index_laporan_penjualan':
				if(isset($g['type_laporan']) || isset($g['id_kategori']) || isset($g['kode_barang']) || isset($g['dari']) || isset($g['sampai'])){
					$data = $jual->getLaporan($g['type_laporan'],$g['id_kategori'],$g['kode_barang'], $g['dari'], $g['sampai']);
				}else{
					$data = null;
				}
				include "view/admin/laporan/laporan_penjualan.php";
			break;


		case 'show_welcome':
				include "view/home.php";
			break;

		// case 'home':
		// 		include "view/home.php";
		// 	break;
		
		case 'main' :
				default : 
				// header("location:index.php");
			break;
	}
}

define("index", "index.php");
define("base_url", server_name()."/".Config::getConfig('rootdir')."/");
define("app_base", index."?page=");

function server_name()
{
	  $serverport = (isset($_SERVER['SERVER_PORT'])) ? ':'.$_SERVER['SERVER_PORT'] : '';
	  return sprintf(
	    "%s://%s".$serverport,
	    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
	    $_SERVER['SERVER_NAME'],
	    $_SERVER['REQUEST_URI']
	  );
}