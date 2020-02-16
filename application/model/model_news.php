<?php
	class model_news extends Application
	{

		public $myorder;
		public $active;
		public $id;
		public $edit_id;
	
		public function __construct(){
			parent::__construct();
			$this->chechFields();
		}
		
		
		/////////////////////
		public function chechFields(){
			$this->menu_id = (int)$_GET['menu_id'];
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$this->$title =  $this->db->input($_POST[$title]);
				$this->$content =  $this->db->input($_POST[$content]);
			endforeach;
			
			
			$this->id = (int)$this->uri['var'];
			$this->edit_id = (int)$_POST['edit_id'];
			$this->myorder = ( (int)myorder::maxOrder('SELECT MAX(myorder) as max FROM news') )+1;
			$this->active = (int)$_POST['active'];
			
			$url = $_POST['youtube'];
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
				$this->youtube = $match[1];
			}else{
				$this->youtube = $this->db->input($_POST['youtube']);
			}
			
			
		}

/////////////////////////////////////////////////		
		public function addNews(){
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$sql_fields .= 'title_'.$l['title'].', content_'.$l['title'].', ';
				$sql_value .= '"'.$this->$title.'", "'.$this->$content.'", '; 
			endforeach;
			
			$this->db->dbQuery(' 	INSERT INTO news('.$sql_fields.' myorder, menu_id, active, youtube)
									VALUES('.$sql_value.' '.$this->myorder.', '.$this->menu_id.', '.$this->active.', "'.$this->youtube.'")');	
			
			$last_id = mysql_insert_id();
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/news/".$last_id.'/');
			$upload->max_large_crop_width= 180 ;
			$upload->max_large_crop_height= 130 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('UPDATE news SET img="'.$img.'" WHERE id='.$last_id);
			endforeach;
			
			$_SESSION['msg'] = '<p class="yes">Успешно добавяне на новини</p>';
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}


/////////////////////////////////////////////////		
		public function updateNews(){
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$sql_value .= 'title_'.$l['title'].' = "'.$this->$title.'", content_'.$l['title'].' = "'.$this->$content.'", ';
			endforeach;
			
			$this->db->dbQuery('UPDATE news SET 
			'.$sql_value.'
			youtube = "'.$this->youtube.'",
			active = '.$this->active.'
			WHERE id='.$this->edit_id);	
			
			$last_id = $this->edit_id;
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/news/".$last_id.'/');
			$upload->max_large_crop_width= 180 ;
			$upload->max_large_crop_height= 130 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('UPDATE news SET img="'.$img.'" WHERE id='.$last_id);
			endforeach;
			
			$_SESSION['msg'] = '<p class="yes">Успешно редактиране</p>';
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		
///////////////////////////////////////////////////		
		public function getNews(){
			return $this->db->dbArray('SELECT * FROM news WHERE menu_id='.$this->menu_id.' ORDER BY myorder DESC');
		}
		
		public function editNews(){
			return $this->db->dbArray('SELECT * FROM news WHERE id='.$this->id, true);
		}
		
		public function deleteNews(){
			$this->db->dbQuery('DELETE FROM news WHERE id='.$this->id, true);
			
			deleteFolder(ROOT.'/html/img/news/'.$this->id.'/');
			
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		
		
		
		public function getImages($id){
			return $this->db->dbArray('SELECT * FROM news_img WHERE cat_id = '.$id.' ORDER BY myorder DESC');
		}
		
	}
?>