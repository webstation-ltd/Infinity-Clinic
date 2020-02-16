<?php
	class model_langs extends Application
	{
		public function __construct(){
			parent::__construct();
		}
		
		public function get(){
			return  $this->db->dbArray('SELECT * FROM langs ORDER BY myorder DESC');
		}
		
		public function add(){
			$title = $this->db->input($_POST['title']);
			$content = $this->db->input($_POST['content']);
			$edit_id = (int)$_POST['edit_id'];
			
			if($edit_id == 0){
				$this->db->dbQuery('INSERT INTO langs(title, content) VALUES("'.$title.'", "'.$content.'")');
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;	
			}else{
				$this->db->dbQuery('UPDATE langs SET title="'.$title.'", content = "'.$content.'" WHERE id='.$edit_id);
				header('location:'.$_SERVER['HTTP_REFERER']);
				exit;	
			}
		}
		
		
		public function updateTables(){
			
			
			///CREATE NEWS LANGS
			$newsTables = $this->db->dbArray('SHOW COLUMNS FROM `news`');
			foreach($newsTables as $k=>$t){
				$arrNews[$k] = $t["Field"];
			}
			
			////MENU
			$menuTables = $this->db->dbArray('SHOW COLUMNS FROM `menu`');
			foreach($menuTables as $k=>$t){
				$menu[$k] = $t["Field"];
			}
			
			////CAT 
			$catTables = $this->db->dbArray('SHOW COLUMNS FROM `cat`');
			foreach($catTables as $k=>$t){
				$cat[$k] = $t["Field"];
			}
			
			////ITEMS
			$itemsTables = $this->db->dbArray('SHOW COLUMNS FROM `items`');
			foreach($itemsTables as $k=>$t){
				$items[$k] = $t["Field"];
			}
			
			///ITEM PRICES
			$priceTables = $this->db->dbArray('SHOW COLUMNS FROM `item_price`');
			foreach($priceTables as $k=>$t){
				$price[$k] = $t["Field"];
			}
			
			////CONTACT 
			$contactTables = $this->db->dbArray('SHOW COLUMNS FROM `contact`');
			foreach($contactTables as $k=>$t){
				$contact[$k] = $t["Field"];
			}
			
			
			////HOME
			$homeTables = $this->db->dbArray('SHOW COLUMNS FROM `home`');
			foreach($homeTables as $k=>$t){
				$home[$k] = $t["Field"];
			}
			
			
			////TEXTPAGES
			$textPagesTables = $this->db->dbArray('SHOW COLUMNS FROM `text_pages`');
			foreach($textPagesTables as $k=>$t){
				$text[$k] = $t["Field"];
			}
			
			
			////GALLERY
			$galleryPagesTables = $this->db->dbArray('SHOW COLUMNS FROM `gallery`');
			foreach($galleryPagesTables as $k=>$t){
				$gallery[$k] = $t["Field"];
			}
			
			
			
			$langs = $this->getLangs();
			foreach( $langs as $l){
				
				///MENU
				if( !in_array( 'title_'.$l['title'], $menu) ){
					$this->db->dbQuery('ALTER TABLE `menu` ADD  title_'.$l['title'].' VARCHAR( 100 ) NOT NULL AFTER `title_bg`');
				}
				
				if( !in_array( 'content_'.$l['title'], $menu) ){
					$this->db->dbQuery('ALTER TABLE `menu` ADD  content_'.$l['title'].' VARCHAR( 500 ) NOT NULL AFTER `content_bg`');
				}
				
				if( !in_array( 'custom_title_'.$l['title'], $menu) ){
					$this->db->dbQuery('ALTER TABLE `menu` ADD  custom_title_'.$l['title'].' 
										VARCHAR( 150 ) NOT NULL AFTER `custom_title_bg`');
				}
				
				if( !in_array( 'description_'.$l['title'], $menu) ){
					$this->db->dbQuery('ALTER TABLE `menu` ADD  description_'.$l['title'].' 
										VARCHAR( 150 ) NOT NULL AFTER `description_bg`');
				}
				
				///NEWS
				if( !in_array( 'title_'.$l['title'], $arrNews) ){ 
					$this->db->dbQuery('ALTER TABLE `news` ADD  title_'.$l['title'].' VARCHAR( 100 ) NOT NULL AFTER `title_bg`');
				}
				if( !in_array( 'content_'.$l['title'], $arrNews) ){ 
					$this->db->dbQuery('ALTER TABLE `news` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}	
				
				///CAT
				if( !in_array( 'title_'.$l['title'], $cat) ){
					$this->db->dbQuery('ALTER TABLE `cat` ADD  title_'.$l['title'].' VARCHAR( 100 ) NOT NULL AFTER `title_bg`');
				}
				if( !in_array( 'custom_title_'.$l['title'], $cat) ){
					$this->db->dbQuery('ALTER TABLE `cat` ADD  custom_title_'.$l['title'].' VARCHAR( 100 ) NOT NULL AFTER `custom_title_bg`');
				}
				if( !in_array( 'content_'.$l['title'], $cat) ){
					$this->db->dbQuery('ALTER TABLE `cat` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}
				if( !in_array( 'description_'.$l['title'], $cat) ){
					$this->db->dbQuery('ALTER TABLE `cat` ADD  description_'.$l['title'].' VARCHAR( 500 ) NOT NULL AFTER `description_bg`');
				}
				
				
				///ITEMS
				if( !in_array( 'title_'.$l['title'], $items) ){
					$this->db->dbQuery('ALTER TABLE `items` ADD  title_'.$l['title'].' VARCHAR( 100 ) NOT NULL AFTER `title_bg`');
				}
				if( !in_array( 'custom_title_'.$l['title'], $items) ){
					$this->db->dbQuery('ALTER TABLE `items` ADD  custom_title_'.$l['title'].' VARCHAR( 100 ) NOT NULL AFTER `custom_title_bg`');
				}
				if( !in_array( 'content_'.$l['title'], $items) ){
					$this->db->dbQuery('ALTER TABLE `items` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}
				if( !in_array( 'description_'.$l['title'], $items) ){
					$this->db->dbQuery('ALTER TABLE `items` ADD  description_'.$l['title'].' VARCHAR( 500 ) NOT NULL AFTER `description_bg`');
				}
				
				
				///ITEMS PRICE
				if( !in_array( 'title_'.$l['title'], $price) ){
					$this->db->dbQuery('ALTER TABLE `item_price` ADD  title_'.$l['title'].' VARCHAR( 250 ) NOT NULL AFTER `title_bg`');
				}
				
				///CONTACT
				if( !in_array( 'content_'.$l['title'], $contact) ){
					$this->db->dbQuery('ALTER TABLE `contact` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}
				
				///HOME PAGE
				if( !in_array( 'content_'.$l['title'], $home) ){
					$this->db->dbQuery('ALTER TABLE `home` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}
				
				if( !in_array( 'title_'.$l['title'], $home) ){
					$this->db->dbQuery('ALTER TABLE `home` ADD  title_'.$l['title'].' VARCHAR( 250 ) NOT NULL AFTER `title_bg`');
				}
				
				if( !in_array( 'description_'.$l['title'], $home) ){
					$this->db->dbQuery('ALTER TABLE `home` ADD  description_'.$l['title'].' VARCHAR( 500 ) NOT NULL AFTER `description_bg`');
				}
				
				
				
				
				
				
				///TEXT PAGES
				if( !in_array( 'content_'.$l['title'], $text) ){
					$this->db->dbQuery('ALTER TABLE `text_pages` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}
				
				///GALLERY
				if( !in_array( 'title_'.$l['title'], $gallery) ){ 
					$this->db->dbQuery('ALTER TABLE `gallery` ADD  title_'.$l['title'].' VARCHAR( 150 ) NOT NULL AFTER `title_bg`');
				}
				if( !in_array( 'content_'.$l['title'], $gallery) ){ 
					$this->db->dbQuery('ALTER TABLE `gallery` ADD  content_'.$l['title'].' text NOT NULL AFTER `content_bg`');
				}
				
			}
			
			
			
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}

		
		
	}
?>