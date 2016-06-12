<?php
class CJual_T extends Core{

	protected $table 		= 'tbl_barang_jual'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_jual';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
		$this->barang = new Barang();
	}

	public function getBarangByJual($id_barang, $id_jual)
	{
		$result = $this->findAll("where kode_barang='".$id_barang."' and kode_jual='".$id_jual."'");
		if($result != null){
			return ['id_jual' => $result[0]['id_jual'], 'jumlah' => $result[0]['jumlah_jual']];
		}else{
			return null;
		}
	}

	public function saveJualBarang($input)
	{
		try {
			$data = [
					'kode_jual'		=> $input['kode_jual'],
					'kode_barang'	=> $input['kode_barang'],
					'harga_jual'	=> $input['harga_jual']
					];
			$d = $this->getBarangByJual($input['kode_barang'], $input['kode_jual']);
			if($d != null){
				$this->minJual($input['kode_barang'], $d['jumlah']);
				$this->deleteBarang($d['id_jual']);
				$data['jumlah_jual'] = $input['jumlah_jual'];
				if($this->save($data)){
					$d2 = $this->getBarangByJual($input['kode_barang'], $input['kode_jual']);
					$this->addJual($input['kode_barang'], $d2['jumlah']);
					return true;
				}else{
					return false;
				}
			}else{
				$data['jumlah_jual'] = $input['jumlah_jual'];
				if($this->save($data)){
					$d2 = $this->getBarangByJual($input['kode_barang'], $input['kode_jual']);
					$this->addJual($input['kode_barang'], $d2['jumlah']);
					return true;
				}else{
					return false;
				}
			}
				
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function listByKodeJual($id)
	{
		return $this->findBy('kode_jual', $id);
	}

	public function deleteBarang($id_jual, $kode_barang, $jumlah)
	{
		$this->minJual($kode_barang, $jumlah);
		if($this->delete($this->primaryKey, $id_jual)){
			Lib::ajaxSuccess('ajax_success');
		}
	}

	// 

	public function minJual($id_barang, $jml)
	{
		return $this->raw_write("UPDATE tbl_barang SET stok=stok+$jml where kode_barang='".$id_barang."'");
	}

	public function addJual($id_barang, $jml)
	{
		return $this->raw_write("UPDATE tbl_barang SET stok=stok-$jml where kode_barang='".$id_barang."'");
	}

}