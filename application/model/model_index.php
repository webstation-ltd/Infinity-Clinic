<?php
	class model_index extends Application
	{
		public $content;
		
		public function __construct(){
			parent::__construct();
			$this->content_bg = $this->db->input($_POST['content_bg']);
			$this->content_en = $this->db->input($_POST['content_en']);
			$this->description = $this->db->input($_POST['description']);
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$description = 'description_'.$l['title'];
				$box_left = 'box_left_'.$l['title'];
				$box_right = 'box_right_'.$l['title'];
				
				$this->$title =  $this->db->input($_POST[$title]);
				$this->$content =  $this->db->input($_POST[$content]);
				$this->$description = $this->db->input($_POST[$description]);
				
				$this->$box_left = $this->db->input($_POST[$box_left]);
				$this->$box_right = $this->db->input($_POST[$box_right]);
				
			endforeach;
			
			
		}
		
		public function get(){
			return $this->db->dbArray('SELECT * FROM home', true);
		}
		
		public function update(){
			$home_num_rows = $this->get();
			if( empty($home_num_rows ) ){
				$this->db->dbQuery('INSERT INTO home(title_bg) VALUES("")');
			}
			
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$description = 'description_'.$l['title'];
				$box_left = 'box_left_'.$l['title'];
				$box_right = 'box_right_'.$l['title'];
				
				$sql_value .= 'title_'.$l['title'].' = "'.$this->$title.'", 
							content_'.$l['title'].' = "'.$this->$content.'",
							description_'.$l['title'].' = "'.$this->$description.'",
							box_left_'.$l['title'].' = "'.$this->$box_left.'",
							box_right_'.$l['title'].' = "'.$this->$box_right.'",';
			endforeach;
			
			$sql_value = substr($sql_value,0,-1);

			
			$this->db->dbQuery('UPDATE home 
								SET 
								'.$sql_value.'
								');
			header('location:?c=index');
			exit;
		}
		
	}
?>