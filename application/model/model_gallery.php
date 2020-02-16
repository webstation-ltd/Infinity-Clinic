<?php
	class model_gallery extends Application
	{
	
		public function __construct(){
			parent::__construct();
			//category//
			$this->menu_id = (int)$_GET['menu_id'];
		}
		
		
////////////////		
		public function addGalerry(){
			$return['success']=false;
			$return['err'] = NULL;
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$this->$title =  $this->db->input($_POST[$title]);
				$this->$content =  $this->db->input($_POST[$content]);
			endforeach;
			
			
			$site_url =  $this->db->input($_POST['site_url']);
			$edit_id =  (int)$_POST['edit_id'];
			$active =  (int)$_POST['active'];
			$myorder = $this->maxOrderCat();
			
			$site_url = trim($_POST['site_url']);
			$site_url = strlen(utf8_decode($site_url)) == 0 ? transliteration($this->title_en) : transliteration($site_url);
			$site_url = strlen(utf8_decode($site_url)) == 0 ? transliteration($this->title_bg) : $site_url;
			
			if( strlen(utf8_decode($this->title_bg)) < 2){
				$return['err']['title_bg'] = 'Не е попълнено заглавие на галерията!';
			}
			
			if( $return['err'] == NULL ){
				if($edit_id > 0){
					
					foreach( $this->langs as $l):
						$title = 'title_'.$l['title'];
						$content = 'content_'.$l['title'];
						$sql_value .= 'title_'.$l['title'].' = "'.$this->$title.'", content_'.$l['title'].' = "'.$this->$content.'", ';
					endforeach;
					

					
					$this->db->dbQuery('UPDATE gallery SET
						'.$sql_value.'
						active = '.$active.',
						site_url = "'.$site_url.'" 
						WHERE id='.$edit_id );
				}else{
					
					foreach( $this->langs as $l):
						$title = 'title_'.$l['title'];
						$content = 'content_'.$l['title'];
						$sql_fields .= 'title_'.$l['title'].', content_'.$l['title'].', ';
						$sql_value .= '"'.$this->$title.'", "'.$this->$content.'", '; 
					endforeach;
					$this->db->dbQuery('
					INSERT INTO gallery('.$sql_fields.' 
					active, myorder, menu_id, site_url)
					VALUES('.$sql_value.' '.$active.','.$myorder.', 
					'.$this->menu_id.', "'.$site_url.'" )');
				}
				return $return['success'] = true;
			}else{
				return $return;	
			}
		}
		
/////////////DEL GAL
		public function deleteCat($id){
			$this->db->dbquery('DELETE FROM gallery WHERE id = '.$id);
			$this->db->dbQuery('DELETE FROM gallery_img WHERE cat_id = '.$id);
		}

////////EDIT INFO		
		public function editInfo(){
			$id = (int)$_GET['editId'];
			return $this->db->dbArray('SELECT * FROM gallery WHERE id='.$id, true);	
		}
		///MAX CAT myorder
		public function maxOrderCat(){
			$max = $this->db->dbArray('SELECT MAX(myorder) as max FROM gallery', true);
			$max = $max['max']+1;
			return (int)$max;
		}
		
		
		//GET CAT
		public function getCat(){
			return $this->db->dbArray('SELECT * FROM gallery ORDER BY myorder DESC');	
		}
		
		//GET CAT NAME
		public function catName($id){
			$name = $this->db->dbArray('SELECT title_bg FROM gallery WHERE id = '.$id, true);
			return $name['title_bg'];
		}
////////////////////////////////

		//ADD IMAGES
		public function addImages($cat_id){
			
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/gallery/".$cat_id.'/');
			$upload->max_large_thmb_width= 800 ;
			$upload->max_large_crop_width= 120;
			$upload->max_large_crop_height= 80;
			$upload->runUpload(true, true);
			
			$max = $this->db->dbArray('SELECT MAX(myorder) as max FROM gallery_img WHERE cat_id='.$cat_id, true);
			$myorder = $max['max'] + 1;
			foreach($upload->data as $img):
				$this->db->dbQuery('INSERT INTO gallery_img(cat_id, img, myorder) VALUES('.$cat_id.', "'.$img.'", '.$myorder.')');
				$myorder ++;
			endforeach;	
		}
		
		
		
		////////////
		public function getImages($cat_id){
			return $this->db->dbArray('SELECT * FROM gallery_img WHERE cat_id='.$cat_id.' ORDER BY myorder DESC');	
		}
		
		
		////////DELETE IMAGES
		public function deleteImages($id){
			$this->db->dbQuery('DELETE FROM gallery_img WHERE id='.$id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;	
		}
		
	}
?>