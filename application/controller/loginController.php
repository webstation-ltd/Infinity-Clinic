<?php
	class login extends Application
	{
		
		function index()
		{
			$data['title'] = 'Вход'; 
			$this->loadView('view_login', $data);
		}
		
		public function enter(){
			$this->loadModel('model_login');
			if($this->model_login->login() === 1){
				$_SESSION['login'] = true;
				$_SESSION['type'] = 4;
				header('location:'.PATH.'/admin');
				exit;
			}else{
				
				$data['title'] = 'Вход';
				$data['err']  = '<p class="err" style="text-align:center">Грешно име или парола!</p>';
				$this->loadView('view_login', $data);
			}
		}
		
		public function logout(){
			session_unset();
			session_destroy();
			header('location:'.PATH.'/admin');
			exit;
		}
		
	}
?>