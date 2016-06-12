<?php
class SampleClass extends Core{

	protected $table 		= 'tes'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function t()
	{
		return $this->findAll();
	}

}