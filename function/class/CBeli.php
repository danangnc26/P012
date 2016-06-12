<?php
class CBeli extends Core{

	protected $table 		= 'tbl_trans_beli'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'kode_beli';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
		$this->belibarang = new CBeli_T();
		$this->barang = new Barang();
	}

	public function index()
	{
		return $this->findAll("order by kode_beli desc");
	}

	public function findBeli($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function saveBeli($input)
	{
		try {
			$data = [
					'tanggal_beli'	=>	Lib::dateInd($input['tanggal_beli']),
					'kode_supplier'	=>	$input['kode_supplier'],
					'id_user'		=>	$_SESSION['id_user']
					];
			if($this->findBeli($input['kode_beli']) != null){
				if($this->update($data, $this->primaryKey, $input['kode_beli'])){
					$this->belibarang->saveBeliBarang($input);
					Lib::ajaxSuccess('ajax_success');
				}
			}else{
				$data['kode_beli'] = $input['kode_beli'];
				if($this->save($data)){
					$this->belibarang->saveBeliBarang($input);
					Lib::ajaxSuccess('ajax_success');
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function doneBeli($id)
	{
		// if($this->belibarang->listByKodeBeli($id) != null){
			// foreach ($this->belibarang->listByKodeBeli($id) as $k => $v) {
			// 	$this->barang->updateStokBeli($v['kode_barang'], $this->belibarang->stokAfterBeli($v['kode_barang'], $id));
			// }
			Lib::ajaxSuccess('ajax_success');
		// }
	}

	public function addBarang($input)
	{
		$this->belibarang->saveBeliBarang($input);
		Lib::ajaxSuccess('ajax_success');
	}

	public function deleteTransPembelian($id)
	{
		$r = $this->belibarang->listByKodeBeli($id);
		if($r != null){
			foreach ($r as $key => $value) {
				$this->belibarang->minBeli($value['kode_barang'], $value['jumlah_beli']);
			}
		}
		if($this->delete($this->primaryKey, $id)){			
			Lib::redirect('index_transaksi_pembelian');
		}else{
			header($this->back);
		}
	}

	// public function saveBeliBarang($input)
	// {
	// 	try {
	// 		$data = [
	// 				'kode_beli'		=> $input['kode_beli'],
	// 				'kode_barang'	=> $input['kode_barang'],
	// 				'jumlah_beli'	=> $input['jumlah_beli'],
	// 				'harga_beli'	=> $input['harga_beli']
	// 				];
	// 		if($this->save($data)){
	// 			return true;
	// 		}else{
	// 			return false;
	// 		}
	// 	} catch (Exception $e) {
	// 		echo $e->getMessage();
	// 	}
	// }

	public function deleteBarangTerbeli($id_beli, $kode_barang, $jumlah)
	{
		$this->belibarang->deleteBarang($id_beli, $kode_barang, $jumlah);
	}

	public function getLaporan($opt, $id_kategori = '', $kode_barang = '', $kode_supplier = '', $dari = '', $sampai = '')
	{
		if($opt == 'semua'){
			$result = $this->raw("SELECT tbl_trans_beli.kode_beli, tbl_trans_beli.tanggal_beli, tbl_trans_beli.kode_supplier, tbl_trans_beli.id_user, tbl_barang_beli.id_beli, tbl_barang_beli.kode_barang, tbl_barang_beli.jumlah_beli, tbl_barang_beli.harga_beli, tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_jual, tbl_barang.stok, tbl_barang.id_kategori FROM tbl_barang_beli INNER JOIN tbl_trans_beli ON tbl_barang_beli.kode_beli = tbl_trans_beli.kode_beli INNER JOIN tbl_barang ON tbl_barang_beli.kode_barang = tbl_barang.kode_barang");
		}
		if($opt == 'kategori'){
			$result = $this->raw("SELECT tbl_trans_beli.kode_beli, tbl_trans_beli.tanggal_beli, tbl_trans_beli.kode_supplier, tbl_trans_beli.id_user, tbl_barang_beli.id_beli, tbl_barang_beli.kode_barang, tbl_barang_beli.jumlah_beli, tbl_barang_beli.harga_beli, tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_jual, tbl_barang.stok, tbl_barang.id_kategori FROM tbl_barang_beli INNER JOIN tbl_trans_beli ON tbl_barang_beli.kode_beli = tbl_trans_beli.kode_beli INNER JOIN tbl_barang ON tbl_barang_beli.kode_barang = tbl_barang.kode_barang where tbl_barang.id_kategori='".$id_kategori."'");
		}
		if($opt == 'barang'){
			$result = $this->raw("SELECT tbl_trans_beli.kode_beli, tbl_trans_beli.tanggal_beli, tbl_trans_beli.kode_supplier, tbl_trans_beli.id_user, tbl_barang_beli.id_beli, tbl_barang_beli.kode_barang, tbl_barang_beli.jumlah_beli, tbl_barang_beli.harga_beli, tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_jual, tbl_barang.stok, tbl_barang.id_kategori FROM tbl_barang_beli INNER JOIN tbl_trans_beli ON tbl_barang_beli.kode_beli = tbl_trans_beli.kode_beli INNER JOIN tbl_barang ON tbl_barang_beli.kode_barang = tbl_barang.kode_barang where tbl_barang_beli.kode_barang='".$kode_barang."'");
		}
		if($opt == 'supplier'){
			$result = $this->raw("SELECT tbl_trans_beli.kode_beli, tbl_trans_beli.tanggal_beli, tbl_trans_beli.kode_supplier, tbl_trans_beli.id_user, tbl_barang_beli.id_beli, tbl_barang_beli.kode_barang, tbl_barang_beli.jumlah_beli, tbl_barang_beli.harga_beli, tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_jual, tbl_barang.stok, tbl_barang.id_kategori FROM tbl_barang_beli INNER JOIN tbl_trans_beli ON tbl_barang_beli.kode_beli = tbl_trans_beli.kode_beli INNER JOIN tbl_barang ON tbl_barang_beli.kode_barang = tbl_barang.kode_barang where tbl_trans_beli.kode_supplier='".$kode_supplier."'");
		}
		if($opt == 'tanggal'){
			$result = $this->raw("SELECT tbl_trans_beli.kode_beli, tbl_trans_beli.tanggal_beli, tbl_trans_beli.kode_supplier, tbl_trans_beli.id_user, tbl_barang_beli.id_beli, tbl_barang_beli.kode_barang, tbl_barang_beli.jumlah_beli, tbl_barang_beli.harga_beli, tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_jual, tbl_barang.stok, tbl_barang.id_kategori FROM tbl_barang_beli INNER JOIN tbl_trans_beli ON tbl_barang_beli.kode_beli = tbl_trans_beli.kode_beli INNER JOIN tbl_barang ON tbl_barang_beli.kode_barang = tbl_barang.kode_barang where (tbl_trans_beli.tanggal_beli BETWEEN '".Lib::dateInd($dari)."' AND '".Lib::dateInd($sampai)."')");
		}
		return $result;
	}

	

}