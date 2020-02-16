<?php
	class langs extends Application{
		
		public function __construct(){
			parent::__construct();
			$this->loadModel('model_langs');
		}
		
		public function index(){
			$data['title'] = 'Езици';
			$data['langs'] = $this->get();
			
			$this->loadView('langs/view_langs', $data);
		}
		
		public function add(){
			$this->model_langs->add();
		}
		
		
		public function get(){
			return $this->model_langs->get();	
		}
		
		public function updateTables(){
			$this->model_langs->updateTables();
		}
		
		
		////////////LANGS POSITION///////

		public function itemsPosition() {
			$updateRecordsArray = $_POST['recordsArray'];
			$listingCounter = count($updateRecordsArray);
			
			foreach ($updateRecordsArray as $recordId) {
				$this->db->dbQuery('UPDATE langs SET myorder='.$listingCounter.' WHERE id='.$recordId);
				$listingCounter = $listingCounter - 1;	
			}
		}
		

	}
?>