<?php
class Barang extends Core{

	protected $table 		= 'tbl_barang'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'kode_barang';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->findAll("order by nama_barang");
	}

	public function findBarang($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function saveBarang($input)
	{
		try {
			$data = [
					'kode_barang'			=> $input['kode_barang'],
					'nama_barang'			=> $input['nama_barang'],
					'satuan'				=> $input['satuan'],
					'harga_beli'			=> $input['harga_beli'],
					'harga_jual'			=> $input['harga_jual'],
					'id_kategori'			=> $input['id_kategori']
					];
			if($this->save($data)){
				Lib::redirect('index_barang');
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function updateBarang($input)
	{
		try {
			$data = [
					'nama_barang'			=> $input['nama_barang'],
					'satuan'				=> $input['satuan'],
					'harga_beli'			=> $input['harga_beli'],
					'harga_jual'			=> $input['harga_jual'],
					'id_kategori'			=> $input['id_kategori']
					];
			if($this->update($data, $this->primaryKey, $input['kode_barang'])){
				Lib::redirect('index_barang');
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteBarang($id)
	{
		if($this->delete($this->primaryKey, $id)){
			Lib::redirect('index_barang');
		}else{
			header($this->back);
		}
	}

	// // // // // // // // 

	public function updateStokBeli($id_barang, $jml)
	{
		return $this->raw_write("UPDATE ".$this->table." SET stok_awal=stok_awal+$jml where kode_barang='".$id_barang."'");
	}

	public function getLaporan($opt, $id_kategori = '', $kode_barang = '')
	{
		if($opt == 'semua'){
			$result = $this->findAll();
		}
		if($opt == 'kategori'){
			$result = $this->findBy('id_kategori', $id_kategori);	
		}
		if($opt == 'kode'){
			$result = $this->findBy('kode_barang', $kode_barang);
		}
		return $result;
	}

}