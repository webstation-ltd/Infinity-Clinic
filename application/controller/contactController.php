<?php
	class contact extends Application
	{
		function __construct()
		{
			parent::__construct();
			$this->loadModel('model_contact');
			$this->loadModel('model_menu');
			
			//chek for menu id
			if($this->model_contact->menu_id == 0){ header('location:?c=menu'); exit;}
		}
		
		function index()
		{
			$title = $this->model_menu->menuName($this->model_contact->menu_id);
			$data['title'] = $title['title_bg'];
			
			$data['menu_id'] = $this->model_contact->menu_id;
			
			$info = $this->model_contact->getInfo();
			$data['edit'] = $info;
			$data['edit_id'] = $info['id'];
			$data['content_bg'] = $info['content_bg'];
			$data['content_en'] = $info['content_en'];
			$this->loadView('contact/view_contact', $data);
            
		}
		
		public function update(){
			$this->model_contact->update();
		}
		
		public function add(){
			if($_POST['post_contact'] != 1){ header('location:?c=menu'); exit; }
			
			if($this->model_contact->existPage()==0){
				$this->model_contact->add($this->model_contact->menu_id);
			}
			else{
				$this->model_contact->update();
			}
		}
		
	}
?>