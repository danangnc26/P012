<?php
class Supplier extends Core{

	protected $table 		= 'tbl_supplier'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'kode_supplier';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->findAll("order by nama_supplier asc");
	}

	public function findSupplier($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function saveSupplier($input)
	{
		try {
			$data = [
					'kode_supplier'			=> $input['kode_supplier'],
					'nama_supplier'			=> $input['nama_supplier'],
					'alamat'				=> $input['alamat']
					];
			if($this->save($data)){
				Lib::redirect('index_supplier');
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function updateSupplier($input)
	{
		try {
			$data = [
					'nama_supplier'			=> $input['nama_supplier'],
					'alamat'				=> $input['alamat']
					];
			if($this->update($data, $this->primaryKey, $input['kode_supplier'])){
				Lib::redirect('index_supplier');
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	

	public function deleteSupplier($id)
	{
		if($this->delete($this->primaryKey, $id)){
			Lib::redirect('index_supplier');
		}else{
			header($this->back);
		}
	}

}