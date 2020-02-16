<?php
	class model_menu extends Application
	{
		public $categoryId;
		
		
		public function __construct(){
			parent::__construct();
			
			$this->categoryId = (int)$_GET['cat_id'];
			$this->categoryId = $this->categoryId == 0 ? 1 : $this->categoryId;
			
			if($_POST['post_items'] == 1):
			
				foreach( $this->langs as $l):
					$title = 'title_'.$l['title'];
					$custom_title = 'custom_title_'.$l['title'];
					$description = 'description_'.$l['title'];
					$this->$title =  $this->db->input($_POST[$title]);
					$this->$custom_title =  $this->db->input($_POST[$custom_title]);
					$this->$description =  $this->db->input($_POST[$description]);
					
					if( $this->$custom_title == ""){
						$this->$custom_title = $this->$title;
					}
				endforeach;
				
				$this->cat_id = (int)$_POST['cat_id'];
				$this->edit_id = (int)$_POST['edit_id'];
				
				$this->site_url = transliteration($_POST['site_url']);
				$this->site_url = strlen($this->site_url) < 1 ? transliteration($this->title_en) : $this->site_url;
				$this->site_url = strlen($this->site_url) < 1 ? transliteration($this->title_bg) : $this->site_url;
				
				$this->position = ( (int)myorder::maxOrder('SELECT MAX(position) as max FROM menu 
				WHERE group_id='.$this->categoryId.' AND parent_id='.(int)$this->category_id) )+1;
			endif;
			
		}
		
		public function editItem($id){
			return $this->db->dbArray('SELECT * FROM menu WHERE id='.$id, true);
		}
		
		public function getMenuCategory(){
			$menu = $this->db->dbArray('SELECT * FROM menu_group');
			return 	$menu;
		}
		
		public function catMenuName(){
			$cat = $this->db->dbArray('SELECT * FROM menu_group WHERE id='.$this->categoryId, true);
			return 	$cat;
		}
		
		
		public function addItems(){
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$custom_title = 'custom_title_'.$l['title'];
				$description = 'description_'.$l['title'];
				$sql_fields .= 'title_'.$l['title'].', custom_title_'.$l['title'].', description_'.$l['title'].', ';
				$sql_value .= '"'.$this->$title.'", "'.$this->$custom_title.'", "'.$this->$description.'", '; 
			endforeach;
			
			$this->db->dbQuery('INSERT INTO menu('.$sql_fields.' site_url, position, group_id)
			VALUES('.$sql_value.' "'.$this->site_url.'", '.$this->position.', '.$this->cat_id.') ');
			
			header('location:?c=menu&cat_id='.$this->cat_id);
			exit;
		}
		
		public function updateItems(){
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$custom_title = 'custom_title_'.$l['title'];
				$description = 'description_'.$l['title'];
				
				$sql_value .= 'title_'.$l['title'].' = "'.$this->$title.'",
							 custom_title_'.$l['title'].' = "'.$this->$custom_title.'",
							 description_'.$l['title'].' = "'.$this->$description.'",
							 ';
			endforeach;
            if(isset($_POST['parent_id'])) {
                $parent_id = (int)$_POST['parent_id'];
                $sql_value .= "d_parent_id = '{$parent_id}',";
            }
			
			$this->db->dbQuery('UPDATE menu SET 
			'.$sql_value.'
			site_url="'.$this->site_url.'"
			WHERE id ='.$this->edit_id);
			
			
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		
		public function delete($id){
			$this->db->dbQuery('DELETE FROM menu WHERE id='.$id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		////tree menu///
		public function getMenuItems(){
			return $this->db->dbArray('SELECT * FROM  menu  WHERE parent_id=0 AND group_id='.$this->categoryId.' ORDER BY position ASC');
		}
		
		public function getParentMenuItems($id){
			return $this->db->dbArray('
			SELECT * FROM  menu 
			WHERE  parent_id='.$id.' 
			AND parent_id!=0 ORDER BY position ASC');
		}
		
		public function menuName($id){
			return $this->db->dbArray('SELECT * FROM  menu  WHERE id='.$id, true);	
		}
		
		public function menuCurrentName($id){
			$menu = $this->db->dbArray('SELECT * FROM  menu  WHERE id='.$id, true);
			return $menu['title_bg'];
		}
		
		public function addMenuType($menu_id, $menu_type){
			$this->db->dbQuery('UPDATE menu SET module='.$menu_type.' WHERE id='.$menu_id);	
		}
		
		public function checkExistUrl(){
			$num = $this->db->dbArray('SELECT COUNT(*) as num FROM menu WHERE site_url="'.$this->site_url.'" AND id!='.$this->edit_id, true);
			return $num['num'];	
		}
        
        function getParentCategories() {
            return $this->db->dbArray("SELECT * FROM  menu  WHERE 1 ORDER BY id ASC");
        }
		
	}
?>