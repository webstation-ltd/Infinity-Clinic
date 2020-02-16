<?php
	class model_contact extends Application
	{
		public function __construct(){
			parent::__construct();
			$this->menu_id = (int)$_GET['menu_id'];
			$this->edit_id = (int)$_POST['edit_id'];
			
			foreach( $this->langs as $l):
				$content = 'content_'.$l['title'];
				$this->$content =  $this->db->input($_POST[$content]);
			endforeach;
		}
		
		
		//съществува ли такава страница в базата
		public function existPage(){
			$num = $this->db->dbArray('SELECT COUNT(*) as num FROM contact WHERE menu_id='.$this->menu_id, true);
			return $num['num'];	
		}
		
		//взимаме съдържанието на страницата
		public function getInfo(){
			return $this->db->dbArray('SELECT * FROM contact WHERE menu_id='.$this->menu_id, true);	
		}
		
		
		//създаваме запис в базата, ако все още няма такъв
		public function add($menu_id){

			foreach( $this->langs as $l):
				$content = 'content_'.$l['title'];
				$sql_fields .= 'content_'.$l['title'].', ';
				$sql_value .= '"'.mysql_real_escape_string($this->$content).'", '; 
			endforeach;
			
			$this->db->dbQuery('INSERT INTO 
			contact('.$sql_fields.' menu_id) 
			VALUES('.$sql_value.' '.$menu_id.')');
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		//редактираме запис в базата
		public function update(){
			foreach( $this->langs as $l):
				$content = 'content_'.$l['title'];
				$sql_value .= 'content_'.$l['title'].' = "'.$this->$content.'",';
			endforeach;
			
			$sql_value = substr($sql_value,0,-1);
			
			$this->db->dbQuery('UPDATE contact SET 
			'.$sql_value.'
			WHERE id='.$this->edit_id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}
?>