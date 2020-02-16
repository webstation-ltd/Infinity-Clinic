<?php
	class model_index extends Application
	{
		public $content;
		public function __construct(){
			parent::__construct();
			$this->content_bg = $this->db->input($_POST['content_bg']);
			$this->content_en = $this->db->input($_POST['content_en']);
		}
		
		public function get(){
			$about = $this->db->dbArray('SELECT * FROM about', true);
			return 	$about;
		}
		
		public function update(){
			$this->db->dbQuery('UPDATE home SET content_bg="'.$this->content_bg.'", content_en="'.$this->content_en.'"');
			header('location:?c=index');
			exit;
		}
		
	}
?>