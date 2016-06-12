<?php
class CJual extends Core{

	protected $table 		= 'tbl_trans_jual'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'kode_jual';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
		$this->jualbarang = new CJual_T();
	}

	public function index()
	{
		return $this->findAll();
	}

	public function findJual($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function saveJual($input)
	{
		try {
			$data = [
					'tanggal_jual'	=>	Lib::dateInd($input['tanggal_jual']),
					'id_user'		=>	$_SESSION['id_user']
					];
			if($this->findJual($input['kode_jual']) != null){
				if($this->update($data, $this->primaryKey, $input['kode_jual'])){
					$this->jualbarang->saveJualBarang($input);
					Lib::ajaxSuccess('ajax_success');
				}
			}else{
				$data['kode_jual'] = $input['kode_jual'];
				if($this->save($data)){
					$this->jualbarang->saveJualBarang($input);
					Lib::ajaxSuccess('ajax_success');
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function doneJual($id)
	{
			Lib::ajaxSuccess('ajax_success');
	}

	public function deleteTransPenjualan($id)
	{
		$r = $this->jualbarang->listByKodeJual($id);
		if($r != null){
			foreach ($r as $key => $value) {
				$this->jualbarang->minJual($value['kode_barang'], $value['jumlah_jual']);
			}
		}
		if($this->delete($this->primaryKey, $id)){			
			Lib::redirect('index_transaksi_penjualan');
		}else{
			header($this->back);
		}
	}

	public function deleteBarangTerjual($id_jual, $kode_barang, $jumlah)
	{
		$this->jualbarang->deleteBarang($id_jual, $kode_barang, $jumlah);
	}

	public function getLaporan($opt, $id_kategori = '', $kode_barang = '',  $dari = '', $sampai = '')
	{
		if($opt == 'semua'){
			$result = $this->raw("SELECT tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_beli, tbl_barang.stok, tbl_barang.id_kategori, tbl_barang_jual.id_jual, tbl_barang_jual.kode_barang, tbl_barang_jual.jumlah_jual, tbl_barang_jual.harga_jual, tbl_trans_jual.kode_jual, tbl_trans_jual.tanggal_jual, tbl_trans_jual.id_user FROM tbl_barang INNER JOIN tbl_barang_jual ON tbl_barang_jual.kode_barang = tbl_barang.kode_barang INNER JOIN tbl_trans_jual ON tbl_barang_jual.kode_jual = tbl_trans_jual.kode_jual");
		}
		if($opt == 'kategori'){
			$result = $this->raw("SELECT tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_beli, tbl_barang.stok, tbl_barang.id_kategori, tbl_barang_jual.id_jual, tbl_barang_jual.kode_barang, tbl_barang_jual.jumlah_jual, tbl_barang_jual.harga_jual, tbl_trans_jual.kode_jual, tbl_trans_jual.tanggal_jual, tbl_trans_jual.id_user FROM tbl_barang INNER JOIN tbl_barang_jual ON tbl_barang_jual.kode_barang = tbl_barang.kode_barang INNER JOIN tbl_trans_jual ON tbl_barang_jual.kode_jual = tbl_trans_jual.kode_jual where tbl_barang.id_kategori='".$id_kategori."'");
		}
		if($opt == 'barang'){
			$result = $this->raw("SELECT tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_beli, tbl_barang.stok, tbl_barang.id_kategori, tbl_barang_jual.id_jual, tbl_barang_jual.kode_barang, tbl_barang_jual.jumlah_jual, tbl_barang_jual.harga_jual, tbl_trans_jual.kode_jual, tbl_trans_jual.tanggal_jual, tbl_trans_jual.id_user FROM tbl_barang INNER JOIN tbl_barang_jual ON tbl_barang_jual.kode_barang = tbl_barang.kode_barang INNER JOIN tbl_trans_jual ON tbl_barang_jual.kode_jual = tbl_trans_jual.kode_jual where tbl_barang_jual.kode_barang='".$kode_barang."'");
		}
		if($opt == 'tanggal'){
			$result = $this->raw("SELECT tbl_barang.nama_barang, tbl_barang.satuan, tbl_barang.harga_beli, tbl_barang.stok, tbl_barang.id_kategori, tbl_barang_jual.id_jual, tbl_barang_jual.kode_barang, tbl_barang_jual.jumlah_jual, tbl_barang_jual.harga_jual, tbl_trans_jual.kode_jual, tbl_trans_jual.tanggal_jual, tbl_trans_jual.id_user FROM tbl_barang INNER JOIN tbl_barang_jual ON tbl_barang_jual.kode_barang = tbl_barang.kode_barang INNER JOIN tbl_trans_jual ON tbl_barang_jual.kode_jual = tbl_trans_jual.kode_jual where (tbl_trans_jual.tanggal_jual BETWEEN '".Lib::dateInd($dari)."' AND '".Lib::dateInd($sampai)."')");
		}
		return $result;
	}


}