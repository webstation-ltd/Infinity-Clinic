<?php
	class model_catalog extends Application
	{
		public $category_title_bg;
		public $category_title_en;
		public $category_content_bg;
		public $category_content_en;
		public $category_id;
		public $cat_id;
		public $edit_cat_id;
		public $site_url;
		public $mark_id;
		
		
		public function __construct(){
			parent::__construct();
			
			//category//
			if($_POST['add_cat']==1):
				foreach( $this->langs as $l):
					$title = 'title_'.$l['title'];//title
					$content = 'content_'.$l['title'];//description
					$description = 'description_'.$l['title'];//content
					$custom_title = 'custom_title_'.$l['title'];//custom title
					$this->$title =  $this->db->input($_POST[$title]);
					$this->$content =  $this->db->input($_POST[$content]);
					$this->$description = $this->db->input($_POST[$description]); 
					$this->$custom_title = $this->db->input($_POST[$custom_title]);
					$this->$custom_title = $this->$custom_title == '' ? $this->$title : $this->$custom_title;
				endforeach;

				
				$this->edit_cat_id = (int)$_POST['edit_cat_id'];
				$this->cat_id = (int)$_GET['id'];
				$this->category_id = (int)$_POST['category_id'];
				
				//build URL
				$this->site_url = trim($_POST['site_url']);
				$this->site_url = strlen($this->site_url) == 0 ? transliteration($this->category_title_en) : transliteration($this->site_url);
				$this->site_url = strlen($this->site_url) == 0 ? transliteration($this->category_title_bg) : $this->site_url;
				
				$this->myorder_cat = ( (int)myorder::maxOrder('SELECT MAX(myorder) as max FROM cat WHERE parent_id='.$this->category_id) )+1;
				
			elseif($_POST['add_product']==1):
				
				foreach( $this->langs as $l):
					$product_title = 'product_title_'.$l['title'];//title
					$product_content = 'product_content_'.$l['title'];//description
					$description = 'description_'.$l['title'];//content
					$custom_title = 'custom_title_'.$l['title'];//custom title
					
					$this->$product_title =  $this->db->input( $_POST[$product_title] );
					$this->$product_content =  $this->db->input($_POST[$product_content]);
					$this->$description = $this->db->input($_POST[$description]); 
					$this->$custom_title = $this->db->input($_POST[$custom_title]);
					$this->$custom_title = $this->$custom_title == '' ? $this->$product_title : $this->$custom_title;
				endforeach;
				
			//product//
		
				$this->promotion = (int)$_POST['promotion'];
				$this->sold = (int)$_POST['sold'];
				$this->category_id = (int)$_POST['category_id'];
				$this->edit_product_id = (int)$_POST['edit_product_id'];
				$this->product_id = (int)$_GET['id'];
				$this->mark_id = (int)$_POST['mark_id'];
				$this->catalog_number = $this->db->input($_POST['catalog_number']);
				$this->youtube = $this->db->input($_POST['youtube']);
				$this->price = format_price($_POST['price']);
				$this->second_price = format_price($_POST['second_price']);
	
			
				//build URL
				$this->site_url = trim($_POST['site_url']);
				$this->site_url = strlen($this->site_url) == 0 ? transliteration($this->product_title_en) : transliteration($this->site_url);
				$this->site_url = strlen($this->site_url) == 0 ? transliteration($this->product_title_bg) : $this->site_url;
				
				$this->myorder_product = ( (int)myorder::maxOrder('SELECT MAX(myorder) as max 
				FROM items WHERE cat_id='.$this->category_id) )+1;
				
			elseif($_POST['add_marks']==1 ):
				$this->mark_title_bg = $this->db->input($_POST['mark_title_bg']);
				$this->mark_title_en = $this->db->input($_POST['mark_title_en']);
				$this->edit_mark_id = (int)$_POST['edit_mark_id'];
				
			endif;
			
			
			
			
		}
		
		
////////////////		
		public function addCategory(){
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$custom_title = 'custom_title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$description = 'content_'.$l['title'];
				
				$sql_fields .= 'title_'.$l['title'].', content_'.$l['title'].', custom_title_'.$l['title'].', description_'.$l['title'].', ';
				$sql_value .= '"'.$this->$title.'", "'.$this->$content.'", "'.$this->$custom_title.'", "'.$this->$description.'", '; 
			endforeach;
			
			$this->db->dbQuery('INSERT INTO cat( '.$sql_fields.' site_url, parent_id, myorder)							
			VALUES( '.$sql_fields.' "'.$this->site_url.'", '.$this->category_id.',  '.$this->myorder_cat.'  )');
			
			$last_id = mysql_insert_id();
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/cat/");
			$upload->max_large_thmb_width= 600 ;
			$upload->max_large_crop_width= 230 ;
			$upload->max_large_crop_height= 172 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('UPDATE cat SET img="'.$img.'" WHERE id = '.$last_id);
			endforeach;
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}


////////////////		
		public function updateCategory(){
			
			if($this->checkUpdateMyorderCategory() == 1){
				$m = $this->db->dbArray('SELECT myorder FROM cat WHERE id='.$this->edit_cat_id, true);
				$myorder = $m['myorder'];
			}else{
				$myorder = ( (int)myorder::maxOrder('SELECT MAX(myorder) as max FROM cat WHERE parent_id='.$this->edit_cat_id) )+1;;
			}
			
			foreach( $this->langs as $l):
				$title = 'title_'.$l['title'];
				$custom_title = 'custom_title_'.$l['title'];
				$content = 'content_'.$l['title'];
				$description = 'description_'.$l['title'];
				
				$sql_value .= 'title_'.$l['title'].' = "'.$this->$title.'", content_'.$l['title'].' = "'.$this->$content.'", 
				custom_title_'.$l['title'].' = "'.$this->$custom_title.'", description_'.$l['title'].' = "'.$this->$description.'", ';
			endforeach;
			
		
			$this->db->dbQuery('
			UPDATE cat SET
				'.$sql_value.'
				site_url = "'.$this->site_url.'",
				parent_id = '.$this->category_id.', 
				myorder = '.$myorder.'
				WHERE id='.$this->edit_cat_id
			);
			
			$last_id = $this->edit_cat_id;
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/cat/");
			$upload->max_large_thmb_width= 600 ;
			$upload->max_large_crop_width= 230 ;
			$upload->max_large_crop_height= 172 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('UPDATE cat SET img="'.$img.'" WHERE id = '.$last_id);
			endforeach;
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}


////////////////		
		public function getParentCat(){
			$parent = $this->db->dbArray('SELECT parent_id FROM cat WHERE id='.$this->category_id, true);
			return (int)$parent['parent_id'];
		}


////////////////		
		public function checkUpdateMyorderCategory(){
			$num = $this->db->dbArray(' SELECT COUNT(*) as cnt FROM cat WHERE 
			parent_id='.$this->getParentCat().' AND id='.$this->edit_cat_id, true);
			return $num['cnt'];
		}
		


////////////////		
		public function editCat($id){
			return $this->db->dbArray('SELECT * FROM cat WHERE id='.$id, true);	
		}
		


////////////////		
		public function deleteCat($id){
			$this->db->dbQuery('DELETE FROM cat WHERE id='.$id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}


////////////////		
		public function update(){
			$this->db->dbQuery('UPDATE about SET content_bg="'.$this->content_bg.'", content_en="'.$this->content_en.'"');
			header('location:?c=about');
			exit;
		}


////////////////		
		public function getCatTitle($id){
			$title = $this->db->dbArray('SELECT title_bg FROM cat WHERE id='.(int)$id, true);
			return $title['title_bg'];
		}
		
		
		
		
////PRODUCT///////////////////////////////////////////////////////////////
		
		public function addProduct(){
			
			foreach( $this->langs as $l):
				$product_title = 'product_title_'.$l['title'];
				$custom_title = 'custom_title_'.$l['title'];
				$content = 'product_content_'.$l['title'];
				$description = 'description_'.$l['title'];
				
				$sql_fields .= 'title_'.$l['title'].', content_'.$l['title'].', custom_title_'.$l['title'].', description_'.$l['title'].', ';
				$sql_value .= '"'.$this->$product_title.'", "'.$this->$content.'", "'.$this->$custom_title.'", "'.$this->$description.'", '; 
			endforeach;
			
			
			
			$this->db->dbQuery('INSERT INTO items
			(
			'.$sql_fields.'
			
			price, second_price, mark_id, site_url, cat_id, catalog_number, youtube, sold, promotion, myorder) 
			VALUES(
				'.$sql_value.'
				"'.$this->price.'",
				"'.$this->second_price.'",
				'.$this->mark_id.',
				"'.$this->site_url.'", 
				'.$this->category_id.',
				"'.$this->catalog_number.'",
				"'.$this->youtube.'",
				'.$this->sold.',
				'.$this->promotion.',
				'.$this->myorder_product.'
			 )');
			 
			$last_id = mysql_insert_id();
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/product/".$last_id.'/');
			$upload->max_large_thmb_width= 400 ;
			$upload->max_large_crop_width= 230 ;
			$upload->max_large_crop_height= 172 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('INSERT INTO items_img(img, item_id) VALUES("'.$img.'", '.$last_id.')');
			endforeach;
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}

////////////////		
		public function updateProduct(){
			if($this->checkUpdateMyorderItems() == 1){
				$m = $this->db->dbArray('SELECT myorder FROM items WHERE id='.$this->edit_product_id, true);
				$myorder = $m['myorder'];
			}else{
				$myorder = ( (int)myorder::maxOrder('SELECT MAX(myorder) as max FROM items WHERE cat_id='.$this->category_id) )+1;;
			}
			
			
			foreach( $this->langs as $l):
				$product_title = 'product_title_'.$l['title'];
				$custom_title = 'custom_title_'.$l['title'];
				$content = 'product_content_'.$l['title'];
				$description = 'description_'.$l['title'];
				
				$sql_value .= 'title_'.$l['title'].' = "'.$this->$product_title.'", 
								content_'.$l['title'].' = "'.$this->$content.'", 
								custom_title_'.$l['title'].' = "'.$this->$custom_title.'", 
								description_'.$l['title'].' = "'.$this->$description.'", ';
			endforeach;
			
			$this->db->dbQuery('
			UPDATE items SET
				'.$sql_value.' 
				price = "'.$this->price.'",
				second_price = "'.$this->second_price.'",
				mark_id = '.$this->mark_id.',
				cat_id = '.$this->category_id.', 
				catalog_number = "'.$this->catalog_number.'",
				youtube = "'.$this->youtube.'",
				sold = '.$this->sold.',
				
				
				promotion = '.$this->promotion.',
				site_url = "'.$this->site_url.'",
				
				myorder = '.$myorder.'
				WHERE id='.$this->edit_product_id
			);
			
			$last_id = $this->edit_product_id;
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/product/".$last_id.'/');
			$upload->max_large_thmb_width= 400 ;
			$upload->max_large_crop_width= 230 ;
			$upload->max_large_crop_height= 172 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('INSERT INTO items_img(img, item_id) VALUES("'.$img.'", '.$last_id.')');
			endforeach;
			
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
/////////////
		public function getSortablMenu(){
			return $this->db->dbArray(' SELECT * FROM  cat WHERE parent_id=0 ORDER BY myorder ASC');	
		}
		
		public function getParentortablMenu($id){
			return $this->db->dbArray(' SELECT * FROM  cat WHERE  parent_id='.$id.' AND parent_id!=0 ORDER BY myorder ASC');
		}
		
////////////////		
		public function checkUpdateMyorderItems(){
			$num = $this->db->dbArray(' SELECT COUNT(*) as cnt FROM items WHERE 
			cat_id='.$this->category_id.' AND id='.$this->edit_product_id, true);
			return $num['cnt'];
		}
		
////////////////		
		public function getItems($id){
			return $this->db->dbArray('SELECT * FROM items WHERE cat_id = '.$id.' ORDER BY myorder DESC');	
		}
		
////////////////		
		public function editItem($id){
			return $this->db->dbArray('SELECT * FROM items WHERE id='.$id, true);	
		}

////////////////		
		public function deleteItems($id){
			$this->db->dbQuery('DELETE FROM items WHERE id='.$id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;	
		}
		
		
/////////////ITEM IMAGES
		public function getItemImages($id){
			return $this->db->dbArray('SELECT * FROM items_img WHERE item_id='.$id);
		}
		
		public function nulledImg(){
			$item_id = (int)$_GET['v'];
			$this->db->dbQuery('UPDATE items_img SET first=0 WHERE item_id ='.$item_id);
			
		}
		
		public function setDefaut(){
			$id = (int)$_GET['v'];
			$imgId = (int)$_GET['imgId'];
			$this->db->dbQuery('UPDATE items_img SET first=1 WHERE id ='.$imgId);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		public function deleteImage(){
			$imgId = (int)$_GET['imgId'];
			$this->db->dbQuery('DELETE FROM items_img WHERE id ='.$imgId);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	
/****************************MARKS****************************/
	public function getMarks(){
		return $this->db->dbArray('SELECT * FROM marks');	
	}
	
/////////////////////////////////
	public function editMark(){
		$this->mark_id = (int)$_GET['edit_mark_id'];
		return $this->db->dbArray('SELECT * FROM marks WHERE id='.$this->mark_id, true);
	}	
	
/////////////////////////////////
	public function addMarks(){
			$this->db->dbQuery('INSERT INTO marks (title_bg, title_en) VALUES( "'.$this->mark_title_bg.'", "'.$this->mark_title_en.'")');
			$last_id = mysql_insert_id();
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/marks/");
			$upload->max_large_thmb_width= 200 ;
			$upload->max_large_crop_width= 200 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('UPDATE marks SET img = "'.$img.'" WHERE id='.$last_id);
			endforeach;
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}

/////////////////////////////		
		public function updateMarks(){
			
			$this->db->dbQuery('UPDATE marks SET 
			title_bg  = "'.$this->mark_title_bg.'",
			title_en  = "'.$this->mark_title_en.'"
			WHERE id='.$this->edit_mark_id );
			
			$last_id = $this->edit_mark_id;
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/marks/");
			$upload->max_large_thmb_width= 200 ;
			$upload->max_large_crop_width= 200 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('UPDATE marks SET img = "'.$img.'" WHERE id='.$last_id);
			endforeach;
			
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	
	
////////////////////////////////	
		public function deleteMarks(){
			$this->mark_id = (int)$_GET['edit_mark_id'];
			$this->db->dbQuery('DELETE FROM marks WHERE id='.$this->mark_id);	
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		
/****************************OPTIONS****************************/
		public function addOptionCat($item_id){
			$title_bg = $this->db->input($_POST['OptionCat_title_bg']);
			$title_en = $this->db->input($_POST['OptionCat_title_en']);
			$id = (int)$_POST['edit_CatOption_id'];
			
			if( strlen(utf8_decode($title_bg)) < 2 ){
				$err['err'] = 'Не е попълнено заглавие';	
			}
			if( empty($err) ){
				
				if($id == 0){
					$this->db->dbQuery('INSERT INTO items_optionCategory (cat_id, title_bg, title_en)
					VALUES('.$item_id.', "'.$title_bg.'", "'.$title_en.'")');
					return true;
					exit;
				}else{
					$this->db->dbQuery('UPDATE  items_optionCategory SET
					title_bg = "'.$title_bg.'", 
					title_en = "'.$title_en.'" 
					WHERE id='.$id); 
					return true;
					exit;	
				}
			}
			return $err;
		}
		
		//////////////////////////////
		public function getOptionCat($id){
			return $this->db->dbArray('SELECT * FROM items_optionCategory WHERE cat_id='.$id); 
		}
		
		public function getOptionItems($id){
			return $this->db->dbArray('SELECT * FROM items_option WHERE cat_id='.$id); 
		}
		/////////////////////////////
		public function addOption(){
			$cat_id = (int)$_POST['options'];
			$title_bg = $this->db->input($_POST['option_title_bg']);
			$title_en = $this->db->input($_POST['option_title_en']);
			
			if( strlen(utf8_decode($title_bg)) < 2 ){
				$err['err'] = 'Не е попълнено заглавие';	
			}
			
			if( $cat_id == 0){
				$err['err'] = 'Не е избрана категория.';	
			}
			
			if( empty($err) ){
				$this->db->dbQuery('INSERT INTO items_option (cat_id, title_bg, title_en, price)
				VALUES('.$cat_id.', "'.$title_bg.'", "'.$title_en.'", 11)');
				return true;
				exit;
			}
			return $err['err'];
		}
		
		
		///////////////
		public function editCatInfo(){
			if($_GET['mode'] == 'editCat'){
				$id = $_GET['editId'];
				return $this->db->dbArray('SELECT * FROM items_optionCategory WHERE id='.$id, true);	
			}
		}
		
		////////////////
		public function deleteOptionCat(){
				$id = $this->uri['var'];
				$this->db->dbQuery('DELETE FROM items_optionCategory WHERE id='.$id, true);	
				$this->db->dbQuery('DELETE FROM items_option WHERE cat_id='.$id, true);	
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
		}
		
		///////////////
		public function editOptions(){
			if($_GET['mode'] == 'editOption'){
				$id = $_GET['editId'];
				return $this->db->dbArray('SELECT * FROM items_option WHERE id='.$id, true);	
			}
		}
		
		
		///////////////
		public function addPrice(){
			
			foreach( $this->langs as $l):
				$title = 'price_name_'.$l['title'];
				$this->$title = $this->db->input($_POST['price_name_'.$l['title']]);
			endforeach;
			
			
			
			$price = format_price($_POST['price']);
			$cat = (int)$this->uri['var'];
			$item_id = (int)$_GET['item_id'];
			$edit_id = (int)$_POST['edit_price_id'];
			
			
			if($edit_id>0){
				foreach( $this->langs as $l):
					$title = 'price_name_'.$l['title'];
					$sql .= 'title_'.$l['title'].' = "'.$this->$title.'",';
				endforeach;
				
				$this->db->dbQuery('UPDATE item_price 
									SET '.$sql.' price="'.$price.'"
									WHERE id='.$edit_id);
									header('location:?c=catalog&m=addPrice&v='.$cat.'&item_id='.$item_id);
									exit;
			}else{
				$data['item_id'] = $item_id;
				
				foreach( $this->langs as $l):
					$title = 'price_name_'.$l['title'];
					$sql_fields .= 'title_'.$l['title'].',';
					$sql_values .= '"'.$this->$title.'",';
				endforeach;
				
				$this->db->dbQuery('INSERT INTO item_price('.$sql_fields.' price, item_id)
									VALUES('.$sql_values.' "'.$price.'", '.$item_id.')
									');
									
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;
			}
		}
		
		
		
		public function getPrices($id){
			$id = (int)$id;
			return $this->db->dbArray('SELECT * FROM item_price WHERE item_id='.$id.' ORDER BY myorder DESC');			
		}
		
		public function editPrice($id){
			$id = (int)$id;
			return $this->db->dbArray('SELECT * FROM item_price WHERE id='.$id, true);
		}
		
		public function getPriceTitle($id){
			$id = (int)$id;
			$name =  $this->db->dbArray('SELECT * FROM items WHERE id='.$id, true);
			return $name['title_bg'];	
		}
		
		public function deletePrice($id){
			$id = (int)$id;
			$this->db->dbArray('DELETE FROM item_price WHERE id='.$id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}
?>