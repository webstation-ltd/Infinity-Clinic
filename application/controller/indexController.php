<?php
	class index extends Application
	{
		function __construct()
		{
			$this->loadModel('model_index');
			parent::__construct();
		}
		
		function index()
		{
			
			$data['title'] = 'Начало';
			$data['menu_id'] = $this->model_index->menu_id;
			$data['edit'] = $this->model_index->get();

			
			$this->loadView('view_index', $data);
		}
		
		
		//създаваме запис или редактираме страница
		public function add(){
			if($_POST['post_page'] != 1){ header('location:?c=menu'); exit; }
				$this->model_index->update();
		}
		
	}
?>