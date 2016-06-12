<?php
class Users extends Core{

	protected $table 		= 'tbl_users'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_user';		// Primary key suatu tabel.
	protected $back 		= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function doLogin($input)
	{
		try {
			$username = $this->con()->real_escape_string($input['username']);
			$password = $this->con()->real_escape_string($input['password']);

			$result = $this->findAll("where username='".$username."' and password='".md5($password)."'");
			if(!empty($result) or $result != false){
				foreach ($result as $key => $value) {
					$_SESSION['username'] = $value['username'];
					$_SESSION['id_user'] = $value['id_user'];
					$_SESSION['nama']	= $value['nama'];
					$_SESSION['level_user']		= $value['level_user'];
					$_SESSION['is_active']	= $value['is_active'];
				}
				if($_SESSION['level_user'] == 'Super Admin' || $_SESSION['level_user'] == 'Admin'){
					if($_SESSION['is_active'] == 1){
						Lib::redirect('show_welcome');
					}else{
						echo Lib::redirectjs(app_base.'logout', "Login gagal, Akun anda tidak aktif.");	
					}
				}else{
					echo Lib::redirectjs(app_base.'logout', "Login gagal.");
				}
			}else{
				echo Lib::redirectjs(base_url.'login.php', "Login gagal, username / password yang anda masukkan salah.");
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function indexUser()
	{
		return $this->findAll("where level_user='Admin' order by nama asc");
	}

	

	public function checkLevel()
	{

		if(isset($_SESSION)){
			if($_SESSION['level_user'] != 'admin'){
				header("Location:login.php");
			}
		}

	}

	public function doLogout()
	{
		session_destroy();
		echo Lib::redirectjs(base_url.'login.php');
	} 

	public function saveUser($post)
	{
		try{
				$data = [
					'username' 		=> $post['username'],
					'password' 		=> md5($post['password']),
					'nama'			=> $post['nama'],
					'is_active'		=> $post['status'],
					'level_user'	=> 'Admin'
					];
				if($this->save($data)){
					Lib::redirect('index_user');
				}else{
					header($this->back);
				}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function updateUser($post)
	{
		try{
				$data = [
					'nama'			=> $post['nama'],
					'is_active'		=> $post['status'],
					];
				if(!empty($post['password'])){
					$data['password'] = md5($post['password']);
				}
				if($this->update($data, $this->primaryKey, $post['id_user'])){
					Lib::redirect('index_user');
				}else{
					header($this->back);
				}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function getCustomer()
	{
		return $this->findAll("where level_user='customer' order by nama_lengkap asc");
	}

	public function getUser()
	{
		return $this->findBy($this->primaryKey, $_SESSION['id_user']);
	}

	public function findUser($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function updateProfil($input)
	{
		try {
			$data = [
					'name'	=> $input['name'],
					'phone'			=> $input['phone'],
					'email'		=> $input['email'],
					];
			if($this->update($data, $this->primaryKey, $_SESSION['id_user'])){
				echo Lib::redirectjs(app_base.'logout', 'Your profile has been successfully changed, please log in to continue.');
			}else{
				header($this->back);
			}
		} catch (Exception $e) {	
			echo $e->getMessage();
		}
	}

	public function updatePassword($input)
	{
		try {
			$data = ['password' => md5($input['password'])];
			if($this->update($data, $this->primaryKey, $_SESSION['id_user'])){
				echo Lib::redirectjs(app_base.'logout', 'Your password has been successfully changed, please log in to continue.');
			}else{
				header($this->back);
			}

		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteUser($id)
	{
		if($this->delete($this->primaryKey, $id)){
			Lib::redirect('index_user');
		}else{
			header($this->back);
		}
	}

}
