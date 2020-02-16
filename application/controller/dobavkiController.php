<?php
	class dobavki extends Application
	{
		function __construct(){
			$this->loadModel('model_dobavki');
		}
		
		function index()
		{
			if($_POST['post_dobavki'] == 1){
				$this->add();	
			}
			
			$data['title'] = 'Добавки';
			$data['dobavki'] = $this->model_dobavki->getAll();
			$this->loadView('dobavki/view_dobavki', $data);
		}
		
		
		///////////////
		public function editItems(){
			$id = $_GET['editId'];
			
			$data['title'] = 'Добавки';
			$data['info'] = $this->model_dobavki->editItem($id);
			$data['dobavki'] = $this->model_dobavki->getAll();
			$this->loadView('dobavki/view_dobavki', $data);
		}
		
		
		
		public function add(){
			$this->model_dobavki->add();
		}
		
		public function itemsPosition() {
		$updateRecordsArray = $_POST['recordsArray'];
		$listingCounter = count($updateRecordsArray);
		
		foreach ($updateRecordsArray as $recordId) {
			$this->model_dobavki->updatePosition($listingCounter, $recordId);
			$listingCounter = $listingCounter - 1;	
		}
	}
		
		
	}
?>