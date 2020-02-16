<?php
	class model_textPages extends Application
	{
		
		public function __construct(){
			parent::__construct();
			$this->menu_id = (int)$_GET['menu_id'];
			$this->edit_id = (int)$_POST['edit_id'];
			
			$url = $_POST['youtube'];
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
				$this->youtube = $match[1];
			}else{
				$this->youtube = $this->db->input($_POST['youtube']);
			}
            $this->own_table = $_POST['own_table'];
			
			foreach( $this->langs as $l):
				$content = 'content_'.$l['title'];
                $this->$content =  $this->db->input($_POST[$content]);
			endforeach;
		}
		

		//съществува ли такава страница в базата
		public function existPage(){
			$num = $this->db->dbArray('SELECT COUNT(*) as num FROM text_pages WHERE menu_id='.$this->menu_id, true);
			return $num['num'];	
		}
		
		
		//създаваме запис в базата, ако все още няма такъв
		public function add($menu_id){

			foreach( $this->langs as $l):
				$content = 'content_'.$l['title'];
				$sql_fields .= 'content_'.$l['title'].', ';
				$sql_value .= '"'.$this->$content.'", '; 
			endforeach;
			
			$this->db->dbQuery('INSERT INTO 
			text_pages('.$sql_fields.' menu_id, youtube) 
			VALUES('.$sql_value.' '.$menu_id.', "'.$this->youtube.'")');
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		//редактираме запис в базата
		public function update(){
			foreach( $this->langs as $l):
				$content = 'content_'.$l['title'];
                $content_foot = 'content_foot_'.$l['title'];
                $sql_value .= 'content_'.$l['title'].' = "'.$this->$content.'", ';
                $sql_value .= 'content_foot_'.$l['title'].' = "'.$_POST['content_foot_'.$l['title']].'", ';
                $sql_value .= 'special_h1_'.$l['title'].' = "'.$_POST['special_h1_'.$l['title']].'", ';
                $sql_value .= 'special_text_'.$l['title'].' = "'.$_POST['special_text_'.$l['title']].'", ';
                $sql_value .= 'video_'.$l['title'].' = "'.$_POST['video_'.$l['title']].'", ';
                $sql_value .= 'related_products_'.$l['title'].' = "'.$_POST['related_products_'.$l['title']].'", ';
				$sql_value .= 'own_table_'.$l['title'].' = "'.$_POST['own_table_'.$l['title']].'", ';
			endforeach;
			$this->db->dbQuery('UPDATE text_pages SET 
			'.$sql_value.' youtube = "'.$this->youtube.'" 
			WHERE id='.$this->edit_id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		//взимаме съдържанието на страницата
		public function getInfo(){
			return $this->db->dbArray('SELECT * FROM text_pages WHERE menu_id='.$this->menu_id, true);	
		}
        
        function updatePrices($id) {
            for($i = 2; $i <= 15; $i++) {
                $color = mysql_real_escape_string($_POST['color_'.$i.'_procedures']);
                $price = mysql_real_escape_string($_POST['price_'.$i.'_procedures']);
                $percent = mysql_real_escape_string($_POST['percent_'.$i.'_procedures']);
                $sql_update .= "color_".$i."_procedures = '{$color}', price_".$i."_procedures = '{$price}', percent_".$i."_procedures = '{$percent}'";
                if($i != 15) { $sql_update .= ', '; }
            }
            if($d = $this->db->dbArray("SELECT id FROM services WHERE id = '{$id}'")) {
                foreach( $this->langs as $l):
                $sql_value .= 'title_'.$l['title'].' = "'.mysql_real_escape_string($_POST['title_'.$l['title']]).'", ';
                endforeach; 
                $this->db->dbQuery("UPDATE services SET {$sql_value} price = '".mysql_real_escape_string($_POST['price'])."', color = '".mysql_real_escape_string($_POST['color'])."' 
                WHERE id = '{$id}'
                ");
                $this->db->dbQuery("UPDATE services SET {$sql_update} WHERE id = '{$id}'");
            } else {
                $title_bg = mysql_real_escape_string($_POST['title_bg']);
                $title_ru = mysql_real_escape_string($_POST['title_ru']);
                $title_en = mysql_real_escape_string($_POST['title_en']);
                $price = mysql_real_escape_string($_POST['price']);
                $color = mysql_real_escape_string($_POST['color']);
                
                
                $this->db->dbQuery("INSERT into services (`text_pages_id`,`title_bg`,`title_ru`,`title_en`,`price`,`color`) VALUES
                ('".$_GET['menu_id']."', '{$title_bg}', '{$title_ru}', '{$title_en}', '{$price}', '{$color}')
                ");
                $new_id = mysql_insert_id();
                $this->db->dbQuery("UPDATE services SET {$sql_update} WHERE id = '{$new_id}'");
            }
            
            return ($new_id) ? $new_id : $id;
        }
        
        function getInfoForService($id) {
            return $this->db->dbArray("SELECT * FROM services WHERE text_pages_id = '{$id}' ORDER BY id DESC");
        }
		
        function getInfoForServiceById($id) {
            return $this->db->dbArray("SELECT * FROM services WHERE id = '{$id}' ORDER BY id DESC");
        }
        
        function getParentService($id) {
            $menu_id = $this->db->dbArray("SELECT menu_id FROM text_pages WHERE id = '{$id}'");
            return $this->db->dbArray("SELECT * FROM menu WHERE id = '{$menu_id[0]['menu_id']}'");
        }
        
        function getChildrenServices($id) {
            return $this->db->dbArray("SELECT * FROM services WHERE text_pages_id = '{$id}'");
        }
            
        function updateFaq($id) {
            if($d = $this->db->dbArray("SELECT id FROM faq WHERE id = '{$id}'")) {
                foreach( $this->langs as $l):
                $sql_value .= 'question_'.$l['title'].' = "'.mysql_real_escape_string($_POST['question_'.$l['title']]).'", ';
                if($l['title'] == "ru") {
                    $sql_value .= 'answer_'.$l['title'].' = "'.mysql_real_escape_string($_POST['answer_'.$l['title']]).'"';
                } else {
                    $sql_value .= 'answer_'.$l['title'].' = "'.mysql_real_escape_string($_POST['answer_'.$l['title']]).'", ';
                }
                endforeach;
                $this->db->dbQuery("UPDATE faq SET {$sql_value} WHERE id = '{$id}'");
            } else {
                $title_bg = mysql_real_escape_string($_POST['question_bg']);
                $title_ru = mysql_real_escape_string($_POST['question_ru']);
                $title_en = mysql_real_escape_string($_POST['question_en']);
                $answer_bg = mysql_real_escape_string($_POST['answer_bg']);
                $answer_ru = mysql_real_escape_string($_POST['answer_ru']);
                $answer_en = mysql_real_escape_string($_POST['answer_en']);
                
                
                $this->db->dbQuery("INSERT into faq (`text_pages_id`,`question_bg`,`question_ru`,`question_en`, `answer_bg`, `answer_ru`, `answer_en`) VALUES
                ('".$_GET['menu_id']."', '{$title_bg}', '{$title_ru}', '{$title_en}', '{$answer_bg}', '{$answer_ru}', '{$answer_en}')
                ");
                $new_id = mysql_insert_id();
            }
            
            return ($new_id) ? $new_id : $id;
        }
     
     function getInfoForFaqById($id) {
         return $this->db->dbArray("SELECT * FROM faq WHERE id = '{$id}' ORDER BY id DESC");
     }
     
     function getInfoForFaq($id) {
            return $this->db->dbArray("SELECT * FROM faq WHERE text_pages_id = '{$id}' ORDER BY id DESC");
     }
    
     function deletePriceItem($id) {
         $this->db->dbQuery("DELETE FROM services WHERE id = '{$id}'");
     }
            
	}
?>