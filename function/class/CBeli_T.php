<?php
class CBeli_T extends Core{

	protected $table 		= 'tbl_barang_beli'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_beli';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
		$this->barang = new Barang();
	}

	public function getBarangByBeli($id_barang, $id_beli)
	{
		$result = $this->findAll("where kode_barang='".$id_barang."' and kode_beli='".$id_beli."'");
		if($result != null){
			return ['id_beli' => $result[0]['id_beli'], 'jumlah' => $result[0]['jumlah_beli']];
		}else{
			return null;
		}
	}

	public function saveBeliBarang($input)
	{
		// $this->barang->updateStokBeli($input['kode_barang'], $this->stokAfterBeli($input['kode_barang'], $input['kode_beli']));
		try {
			$data = [
					'kode_beli'		=> $input['kode_beli'],
					'kode_barang'	=> $input['kode_barang'],
					'harga_beli'	=> $input['harga_beli']
					];
			$d = $this->getBarangByBeli($input['kode_barang'], $input['kode_beli']);
			if($d != null){
				$this->minBeli($input['kode_barang'], $d['jumlah']);
				$this->deleteBarang($d['id_beli']);
				$data['jumlah_beli'] = $input['jumlah_beli'];
				if($this->save($data)){
					$d2 = $this->getBarangByBeli($input['kode_barang'], $input['kode_beli']);
					$this->addBeli($input['kode_barang'], $d2['jumlah']);
					return true;
				}else{
					return false;
				}
			}else{
				$data['jumlah_beli'] = $input['jumlah_beli'];
				if($this->save($data)){
					$d2 = $this->getBarangByBeli($input['kode_barang'], $input['kode_beli']);
					$this->addBeli($input['kode_barang'], $d2['jumlah']);
					return true;
				}else{
					return false;
				}
			}
			// if($this->getBarangByBeli($input['kode_barang'], $input['kode_beli']) == null){
			// 	$data['jumlah_beli'] = $input['jumlah_beli'];
			// 	if($this->save($data)){
			// 		return true;
			// 	}else{
			// 		return false;
			// 	}
			// }else{
			// 	$data['jumlah_beli'] = $input['jumlah_beli'];
			// 	if($this->update($data, $this->primaryKey, $this->getBarangByBeli($input['kode_barang'], $input['kode_beli']))){
			// 		return true;
			// 	}else{
			// 		return false;
			// 	}
			// }
				
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function listByKodeBeli($id)
	{
		return $this->findBy('kode_beli', $id);
	}

	public function stokAfterBeli($id_barang, $id_beli)
	{
		$result = $this->raw("SELECT sum(jumlah_beli) as jml FROM tbl_barang_beli where kode_barang='".$id_barang."' and kode_beli='".$id_beli."'");
		if($result != null){
			return $result[0]['jml'];
		}
	}

	public function deleteBarang($id_beli, $kode_barang, $jumlah)
	{
		$this->minBeli($kode_barang, $jumlah);
		if($this->delete($this->primaryKey, $id_beli)){
			Lib::ajaxSuccess('ajax_success');
		}
	}

	// 

	public function minBeli($id_barang, $jml)
	{
		return $this->raw_write("UPDATE tbl_barang SET stok=stok-$jml where kode_barang='".$id_barang."'");
	}

	public function addBeli($id_barang, $jml)
	{
		return $this->raw_write("UPDATE tbl_barang SET stok=stok+$jml where kode_barang='".$id_barang."'");
	}


}