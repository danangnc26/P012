<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'route.php';

Class Lib{

	public static function redirect($loc)
	{
		header('Location:'.app_base.$loc);
	}

	public static function redirectjs($src = '', $msg = '')
	{
		$r 	= '<script>';
		$r .= (!empty($msg)) ? 'alert("'.$msg.'");' : '';
		$r .= 'location.replace("'.$src.'")';
		$r .= '</script>';
		return $r;
	}

	public static function ajaxSuccess($loc)
	{
		header('Location:'.base_url.'function/func.php?func='.$loc);
	}

	public static function uCheck()
	{
		$logged_in = false;
		//jika session username belum dibuat, atau session username kosong
		if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {	
			//redirect ke halaman login
			// header("Location:index.php?page=login");
			echo Lib::redirectjs(base_url.'login.php');
		} else {
			$logged_in = true;
		}
		
	}

	public static function tblNotFound($jml)
	{
		return "<tr><td align='center' colspan='".$jml."'> -- Data tidak ditemukan -- </td></tr>";
	}

	public static function ind($str = '')
	{
		// if(is_numeric($str)){
			
		// }else{
		// 	return 'Bukan Angka';
		// }
		return 'Rp. '.number_format($str, 0, ',', '.');	
	}

	public static function dateInd($str = '', $s = false) {
        setlocale (LC_TIME, 'id_ID');
        if($s == true){
        	$date = strftime( "%d/%m/%Y", strtotime($str));
        }else{
        	$dt = explode('/', $str);
        	$date = strftime( "%Y-%m-%d", strtotime($dt[0].'-'.$dt[1].'-'.$dt[2]));
        }

        return $date;
    }

	public static function kodeBeli($opt)
	{
		if($opt == 'beli'){
			$cbeli = new CBeli();
			$kd = 'BL';
			$mx = $cbeli->raw("SELECT max(kode_beli) as kd_beli FROM tbl_trans_beli");
			$v = $mx[0]['kd_beli'];
		}

		if($opt == 'jual'){
			$cjual = new CJual();
			$kd = 'JL';
			$mx = $cjual->raw("SELECT max(kode_jual) as kd_jual FROM tbl_trans_jual");
			$v = $mx[0]['kd_jual'];
		}


		if($v == null){
			$kode = $kd.'00001';
		}else{
			$num = (int)substr($v, 0-5);
			$one = $num+1;
			$leng = strlen($one);
			// $kode = $kd.$num+1;
			// $sub = substr($mx[0]['agenda'], 0,4);
			// $one = $sub+1;
			// $leng = strlen($one);
			if($leng == 1){
			$no = '0000';
			}elseif($leng == 2){
			$no = '000';
			}elseif($leng == 3){
			$no = '00';
			}elseif($leng == 4){
			$no = '0';
			}elseif($leng == 5){
			$no = '';
			}
			$kode = $kd.$no.$one;
		}
		return $kode;
	}

	public static function namaKategori($id)
	{
		$j = new Kategori();
		$result = $j->findBy('id_kategori', $id);
		return $result[0]['nama_kategori'];
	}

	public static function namaBarang($id)
	{
		$j = new Barang();
		$result = $j->findBy('kode_barang', $id);
		return $result[0]['nama_barang'];
	}

	public static function namaSupplier($id)
	{
		$j = new Supplier();
		$result = $j->findBy('kode_supplier', $id);
		return $result[0]['nama_supplier'];
	}

	public static function supplier($id, $opt = '')
	{
		$j = new Supplier();
		$result = $j->findBy('kode_supplier', $id);
		if(empty($opt))
		{
			return $result;
		}else{
			return $result[0][$opt];
		}
	}

	public static function dropSupplier($opt = '')
	{
		$s[] = '<option value="">-- Pilih Supplier --</option>';
		$j = new Supplier();
		$result = $j->findAll("order by nama_supplier asc");
		if($result != null){
			foreach($result as $value){
				$s[] = ($value['kode_supplier'] == $opt) ? '<option  selected value="'.$value['kode_supplier'].'">'.$value['nama_supplier'].'</option>' : '<option value="'.$value['kode_supplier'].'">'.$value['nama_supplier'].'</option>';
			}
		}else{
			$s = [];
		}
		return implode('', $s);
	}

	public static function dropBarang($opt = '')
	{
		$s[] = '<option selected value="">-- Pilih Barang --</option>';
		$j = new Barang();
		$result = $j->findAll("order by nama_barang asc");
		if($result != null){
			foreach($result as $value){
				$s[] = ($value['kode_barang'] == $opt) ? '<option  selected value="'.$value['kode_barang'].'">'.$value['nama_barang'].'</option>' : '<option value="'.$value['kode_barang'].'">'.$value['nama_barang'].'</option>';
			}
		}else{
			$s = [];
		}
		return implode('', $s);
	}

	public static function dropKategori($opt = '')
	{
		$s[] = '<option selected value="">-- Pilih Kategori --</option>';
		$j = new Kategori();
		$result = $j->findAll("order by nama_kategori asc");
		if($result != null){
			foreach($result as $value){
				$s[] = ($value['id_kategori'] == $opt) ? '<option  selected value="'.$value['id_kategori'].'">'.$value['nama_kategori'].'</option>' : '<option value="'.$value['id_kategori'].'">'.$value['nama_kategori'].'</option>';
			}
		}else{
			$s = [];
		}
		return implode('', $s);
	}

	public static function getBarang($id)
	{
		$j = new Barang();
		return $j->findBy('kode_barang', $id);
	}

	public static function raw($sql)
	{
		$j = new Barang();
		return $j->raw($sql);
	}

	public static function totalTerbeli($id, $opt = '')
	{
		$j = new CBeli_T();
		$result = $j->raw("SELECT harga_beli*jumlah_beli as jumlah FROM tbl_barang_beli where kode_beli='".$id."'");
		foreach ($result as $key => $value) {
			$d[] = $value['jumlah'];	
		}
		return array_sum($d);
	}

	public static function jumlahBarangTerbeli($id)
	{
		$j = new CBeli_T();
		$result = $j->findBy('kode_beli', $id);
		return count($result);
	}

	public static function totalTerjual($id, $opt = '')
	{
		$j = new CJual_T();
		$result = $j->raw("SELECT harga_jual*jumlah_jual as jumlah FROM tbl_barang_jual where kode_jual='".$id."'");
		foreach ($result as $key => $value) {
			$d[] = $value['jumlah'];	
		}
		return array_sum($d);
	}

	public static function jumlahBarangTerjual($id)
	{
		$j = new CJual_T();
		$result = $j->findBy('kode_jual', $id);
		return count($result);
	}

	public static function count($opt)
	{
		if($opt == 'barang'){
			$j = new Barang();
		}

		if($opt == 'pembelian')
		{
			$j = new CBeli();
		}

		if($opt == 'penjualan'){
			$j = new CJual();
		}
		$result = $j->findAll();
		if($result!=null){
			return count($result);
		}else{
			return null;
		}
	}

	public static function minStock()
	{
		$j = new Barang();
		$result = $j->findAll("where stok<=3");
		return $result;
	}

	public static function laporanStok($type = '', $kategori = '', $barang = '')
	{
		$j = new Barang();
		$result = $j->getLaporan($type, $kategori, $barang);
		return $result;
	}

	public static function laporanPembelian($opt = '', $id_kategori = '', $kode_barang = '', $kode_supplier = '', $dari = '', $sampai = '')
	{
		$j = new CBeli();
		$result = $j->getLaporan($opt, $id_kategori, $kode_barang, $kode_supplier, $dari, $sampai);
		return $result;
	}

	public static function laporanPenjualan($opt = '', $id_kategori = '', $kode_barang = '', $dari = '', $sampai = '')
	{
		$j = new CJual();
		$result = $j->getLaporan($opt, $id_kategori, $kode_barang, $dari, $sampai);
		return $result;
	}




}