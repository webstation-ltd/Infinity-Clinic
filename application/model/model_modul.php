<?php
	class model_modul extends Application
	{
		public function __construct(){
			parent::__construct();
		}
		
		public function modulName($id){
			return $this->db->dbArray('SELECT * FROM moduls WHERE id='.$id, 1);
		}
		
		public function getModuls(){
			return $this->db->dbArray('SELECT * FROM moduls');
		}
		
		
	}
?>