<?php
	class model_dobavki extends Application
	{
		public $categoryId;
		
		
		public function __construct(){
			parent::__construct();
			
			if($_POST['post_items'] == 1):
				$this->add();
				
			endif;
			
		}
		
		public function editItem($id){
			return $this->db->dbArray('SELECT * FROM dobavki WHERE id='.$id, true);
		}
		
		public function getAll(){
			$menu = $this->db->dbArray('SELECT * FROM dobavki ORDER BY myorder DESC');
			return 	$menu;
		}
		
		
		public function add(){
			$title_bg = $this->db->input($_POST['title_bg']);
			$title_en = $this->db->input($_POST['title_en']);
			$price  = format_price($_POST['price']);
			$position = $this->db->dbArray('SELECT MAX(myorder) as max FROM dobavki');
			$position = (int)$position['max'];
			$edit_id = (int)$_POST['edit_id'];
			
			if($edit_id > 0){
				$this->db->dbQuery('UPDATE dobavki 
				SET title_bg="'.$title_bg.'", title_en="'.$title_en.'", price = "'.$price.'" WHERE id='.$edit_id);
				header('location:?c=dobavki');
				exit;
			}else{
				$this->db->dbQuery('INSERT INTO dobavki(title_bg, title_en, price, myorder)
				 VALUES("'.$title_bg.'", "'.$title_en.'", "'.$price.'", "'.$position.'")');
				header('location:?c=dobavki');
				exit;
			}
		}
		
		
		public function updatePosition($listingCounter, $recordId){
			$this->db->dbQuery('UPDATE dobavki SET myorder='.$listingCounter.' WHERE id='.$recordId);
		}
		
		
		
	}
?>