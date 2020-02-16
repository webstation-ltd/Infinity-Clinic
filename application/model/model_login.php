<?php
	class model_login extends Application
	{
	
		function __construct(){
			parent::__construct();
		}
		
		function login(){
			$user = $this->db->input($_POST['user']);
			$pass = trim(md5($_POST['pass']));
			$num = $this->db->dbArray('SELECT COUNT(*) as num FROM users
			WHERE user = "'.$user.'" AND pass="'.$pass.'" AND `type`=4' , true);
			return  (int)$num['num'];
		}
	}
?>