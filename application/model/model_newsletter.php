<?php
	class model_newsletter extends Application
	{
		public $id;
		public function __construct(){
			parent::__construct();
			$this->id = (int)$_GET['id'];
		}
		
		////
		public function getMails(){
			return $this->db->dbArray('SELECT * FROM newsletter');
		}
		
		public function delete(){
			if($this->id > 0 ){
				$this->db->dbQuery('DELETE FROM newsletter WHERE id='.$this->id);	
			}
		}
		
		
		
	}
?>