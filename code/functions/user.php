<?php

class user
{
	private static $_instance = null;
	
/*	private $_pdo;*/
	
	public $def_un = '';
	public $wrong_detail = 'Invalid User/Password';
		
	public function __construct()
	{
		self::get_instance();
	}
	
	public static function get_instance()
	{
		if (!isset(self::$_instance))
		{
			self::$_instance = new connect();
			
			try
			{
				self::$_instance = self::$_instance->db_connect('127.0.0.1', 'root', '', 'west_coast_auto');
			}
			catch (PDOException $error)
			{
				die($error->getMessage().'<br>');
			}
	
		}
		
		return self::$_instance;
	}
	
	public function login($username, $password)
	{
		if (!empty($username) || !empty($password))
		{
			/*The prepare statements avoid the need for escaping and prevent 1st order injection on my code*/
			$sql = self::get_instance()->prepare("SELECT staff_id FROM staff WHERE username = ? AND password = ?");
			
			$hash_password = md5($password);
			
			$sql->bindParam(1, $username);
			$sql->bindParam(2, $hash_password);
			
			$sql->execute();
			
			if ($sql->rowCount() == 1)
			{
				$this->def_un = 'login success';
				
/*				The following code sets $_SESSION['id'] = staff_id */
				$result = $sql->fetchObject();
				$_SESSION['id'] = $result->staff_id;
				
				return true;
			}
			else
			{
				$this->def_un = $this->wrong_detail;
				
				return false;
			}
		}
		else
		{
			$this->def_un = $this->wrong_detail;
		}
	}
}

?>