<?php
	class catalog extends Application
	{
		public $_option;
		public function __construct()
		{
			parent::__construct();
			$this->loadModel('model_catalog');
			
		}
		
		public function index()
		{
			$this->addCategory();
		}
		
/////////////////////////////////CATEGORY////////////////////////////////////////////
		public function addCategory(){
			if($_POST['add_cat']==1){
				$data['err'] = $this->checkCategory();
				if(empty($data['err'])){
					if($this->model_catalog->edit_cat_id>0):
						$this->model_catalog->updateCategory();
						$data['err'] = '<p class="yes">Успешно редактиране на категория</p>';
					else:
						$this->model_catalog->addCategory();
						$data['err'] = '<p class="yes">Успешно добавяне на категория</p>';
					endif;
				}
			}
			$this->build_menu(0, 0);
			$data['menu'] = $this->_option;
			$data['sortable_menu'] = $this->getSortablMenu();
			$data['title'] = 'Каталог - добавяне на категории';
			$this->loadView('catalog/view_catalog', $data);
		}
		
	/////////////////EDIT CAT//////////////		
		public function editCat(){
			$id  = (int)$_GET['id'];
			$data['title'] = 'Редакция';
			$this->build_menu(0, 0);
			$data['menu'] = $this->_option;
			$data['info'] = $this->model_catalog->editCat($id);
			
			$this->loadView('catalog/view_catalog', $data);
		}		
		
		///
		public function checkCategory(){
			if( strlen($this->model_catalog->title_bg)<2){
				$err .= '<p class="err">Не е попълнено заглавие на български!</p>';	
			}
			return $err;
		}
		

		
		//////////////
		public function deleteCat(){
			$id  = (int)$_GET['id'];
			if($id>0):
				$this->model_catalog->deleteCat($id);
			endif;
		}
		



//////////////////PRODUCTS//////////////////////////////////////////

	function addItems(){
			
		if((int)$_GET['editId'] >0){
			$id = (int)$_GET['editId'];
			$data['info'] = $this->model_catalog->editItem($id);
			$data['images'] = $this->model_catalog->getItemImages($id);	
		}
		
		if($_POST['add_product']==1){
			$data['err'] = $this->checkProduct();
			if(empty($data['err'])){
				if($this->model_catalog->edit_product_id>0):
					$this->model_catalog->updateProduct();
					$data['err'] = '<p class="yes">Успешно редактиране на продукт</p>';
				else:
					$this->model_catalog->addProduct();
					$data['err'] = '<p class="yes">Успешно добавяне на продукт</p>';
				endif;
			}
		}
		
		$data['title'] = $this->model_catalog->getCatTitle($this->uri['var']);
		$this->build_menu(0, 0);
		
		$data['marks'] = $this->model_catalog->getMarks();
		$data['menu'] = $this->_option;
		$data['items'] =  $this->model_catalog->getItems($this->uri['var']);
		$data['current_id'] = (int)$this->uri['var'];
		$this->loadView('catalog/view_addProduct', $data);
		
	}
	
	
	/////
	public function deleteItems(){
		$id = (int)$_GET['id'];
		if($id>0){
			$this->model_catalog->deleteItems($id);	
		}
	}
	
	
	//////
	public function checkProduct(){
		if( strlen($this->model_catalog->product_title_bg)<2){
			$err .= '<p class="err">Не е попълнено заглавие на български!</p>';	
		}

		if( $this->model_catalog->category_id == 0){
			$err .= '<p class="err">Не е избрана категория!</p>';	
		}
		
				
		return $err;
	}
	
	
	////ITEM IMAGES
	public function defaultImg(){
		$this->model_catalog->nulledImg();
		$this->model_catalog->setDefaut();
	}
	
	public function deleteImg(){
		$this->model_catalog->deleteImage();
	}
	
	
	///////////////////////////////////////
	
	

//////////MARKS//////////////////
	public function marks(){
		if($_POST['add_marks'] == 1){
			if( strlen($this->model_catalog->mark_title_bg)<2 ){
					$data['err'] = '<p class="err">Въведете име на марката</p>';
			}
						
			if( empty($data['err']) ){
				if($this->model_catalog->edit_mark_id > 0){
					$this->model_catalog->updateMarks();
				}else{
					$this->model_catalog->addMarks();
				}
				
			}
		}
		
		if($_GET['mode'] == 'edit'){
			$data['info'] = $this->model_catalog->editMark();
		}
		
		if($_GET['mode'] == 'delete'){
			$this->model_catalog->deleteMarks();
		}
		
		$data['title'] = 'Марки';
		$data['items'] = $this->model_catalog->getMarks();
		$this->loadView('catalog/view_marks', $data);	
	}
	
////////////////MENU////////////////		
	public function build_menu($current_cat_id, $count){
    static $option_results;
        if (!isset($current_cat_id)){
			$current_cat_id =0;
		}
       
       $count = $count+1;
       $this->db->dbQuery('SELECT id, title_bg, myorder, parent_id FROM cat WHERE parent_id = '.$current_cat_id.' ORDER by myorder DESC');
        $get_menu = $this->db->_resource;
        $num_options = $this->db->_numQueries;
        if ($num_options > 0){
            while (list($cat_id, $cat_name, $myorder, $parent_id) = mysql_fetch_row($get_menu)){
                if ($current_cat_id!=0){
                    $indent_flag = " ";
                    for ($x=2; $x<=$count; $x++){
                        $indent_flag .= '-';
                    }
                }
                $cat_name = $indent_flag.$cat_name;
                $option_results[$cat_id] = array($cat_name, $myorder, $parent_id);
               		$this->build_menu($cat_id, $count);
            }
        }
        mysql_free_result($get_menu);
        $this->_option =  $option_results;
	}
	
	
	public function getProduct($count){
    static $option_results;
        if (!isset($current_cat_id)){
			$current_cat_id =0;
		}
       
       $count = $count+1;
       $this->db->dbQuery('SELECT id, title_bg, myorder, parent_id FROM cat WHERE parent_id = '.$this->uri['var'].' ORDER by myorder DESC');
        $get_menu = $this->db->_resource;
        $num_options = $this->db->_numQueries;
        if ($num_options > 0){
            while (list($cat_id, $cat_name, $myorder, $parent_id) = mysql_fetch_row($get_menu)){
                if ($current_cat_id!=0){
                    $indent_flag = " ";
                    for ($x=2; $x<=$count; $x++){
                        $indent_flag .= '-';
                    }
                }
                $cat_name = $indent_flag.$cat_name;
                $option_results[$cat_id] = array($cat_name, $myorder, $parent_id);
               		$this->build_menu($cat_id, $count);
            }
        }
        mysql_free_result($get_menu);
        $this->_option =  $option_results;
	}
	////////////////////////////////////////////	
////////////PRODUKT POSITION///////

	public function itemsPosition() {
		$updateRecordsArray = $_POST['recordsArray'];
		$listingCounter = count($updateRecordsArray);
		
		foreach ($updateRecordsArray as $recordId) {
			$this->db->dbQuery('UPDATE items SET myorder='.$listingCounter.' WHERE id='.$recordId);
			$listingCounter = $listingCounter - 1;	
		}
	}

	
	
	
///////////////////////////////////
	
////////////CATEGORY POSITION///////
	public function save_position() {
		if (isset($_POST['easymm'])) {
			$easymm = $_POST['easymm'];
			$this->update_position(0, $easymm);
		}
	}

	//////
	private function update_position($parent, $children) {
		$i = 1;
		foreach ($children as $k => $v) {
			$id = (int)$children[$k]['id'];
			$this->db->dbQuery('UPDATE cat SET 	parent_id = '.$parent.', myorder='.$i.' WHERE id = ' . $id);
			if (isset($children[$k]['children'][0])) {
				$this->update_position($id, $children[$k]['children']);
			}
			$i++;
		}
	}
	
		
	///////////////////////SORTABLE MENU	
	public function getSortablMenu(){
		$menu = $this->model_catalog->getSortablMenu();
		
		$html = '<ul id="easymm">'."\n";
		foreach($menu as $m){
			$html .= '<li id="menu-'.$m['id'].'"  class="sortable">
			<div class="ns-row">
                    <div class="ns-title">'.$m['title_bg'].'</div>
                    <div class="ns-url"><a href="?c=catalog&m=addItems&v='.$m['id'].'">Добави продукти</a></div>
                    <div class="ns-class"></div>
                    <div class="ns-actions">
                    <a href="?c=catalog&m=editCat&id='.$m['id'].'" title="Edit Menu"><img src="'.ADMIN.'/html/img/edit.png" alt="Edit">
                    </a>
                    <a href="?c=catalog&m=deleteCat&id='.$m['id'].'" class="confirm"><img src="'.ADMIN.'/html/img/cross.png" alt="Delete"></a>
                    <input type="hidden" name="menu_id" value="'.$m['id'].'">
                    </div>
                </div>';
			
			$html .= $this->getParentortablMenu( $m['id'] );
			$html .= '</li>'."\n";
		}
		$html .= '</ul>'."\n";
		
		return $html;
	}
	
	
	private function getParentortablMenu($id){
		$parent = $this->model_catalog->getParentortablMenu($id);
		if(!empty ($parent) ){
			$parent_menu .= '<ul>'."\n";
			foreach($parent as $m){
				$parent_menu .= '<li id="menu-'.$m['id'].'"  class="sortable">
				<div class="ns-row">
                    <div class="ns-title">'.$m['title_bg'].'</div>
                    <div class="ns-url"><a href="?c=catalog&m=addItems&v='.$m['id'].'">Добави продукти</a></div>
                    <div class="ns-class"></div>
                    <div class="ns-actions">
                    <a href="?c=catalog&m=editCat&id='.$m['id'].'"  title="Edit Menu"><img src="'.ADMIN.'/html/img/edit.png" alt="Edit">
                    </a>
                    <a href="?c=catalog&m=deleteCat&id='.$m['id'].'"  class="confirm"><img src="'.ADMIN.'/html/img/cross.png" alt="Delete"></a>
                    <input type="hidden" name="menu_id" value="'.$m['id'].'">
                    </div>
                </div>'."\n";
				
				$parent_menu .= $this->getParentortablMenu( $m['id'] );
				$parent_menu .= '</li>'."\n";
			}
			$parent_menu .= '</ul>'."\n";
			return $parent_menu;
		}
	}
		
	
	///////////////////OPTIONS///////////////////////////
	public function addCatOption(){
		$item_id = (int)$this->uri['var'];
		if($item_id == 0){//check item id
			header('location:'.ADMIN.'/?catalog');
			exit;
		}
		
		if($_POST['add_optionCat'] == 1){
			$result = $this->model_catalog->addOptionCat($item_id);
			$data['err'] = $result==true ? '<p class="sucess">Успешен запис</p>' : $result;
		}
		
		if($_POST['add_option'] == 1){
			$result = $this->model_catalog->addOption();
			$data['err'] = $result == true ? '<p class="sucess">Успешен запис</p>' : $result.'dsfsdfsd';
		}
		
		$data['editCatInfo'] = $this->model_catalog->editCatInfo();
		$data['editOptions'] = $this->model_catalog->editOptions();
		
		$cat = $this->model_catalog->getOptionCat($item_id);
		
		$arr = array();
		foreach($cat as $c):
			$arr[$c['id']] = array(
				'cat' => $c['title_bg'],
				'id' => $c['id'],
				'cat_items'	=> $this->model_catalog->getOptionItems($c['id'])	
			);
		endforeach;
		
		$data['item_id'] = $item_id;
		$data['optionCat'] = $cat;
		$data['options'] = $arr;
		$item = $this->model_catalog->editItem($item_id);
		$data['item_title'] = $item['title_bg'];
		$this->loadView('catalog/view_options', $data);
	}
	
	public function deleteOptionCat(){
		$item = $this->model_catalog->deleteOptionCat();	
	}
	
/////////////////////////////////////////////////////////////////////
////////////////////////////ЦЕНИ////////////////////////////////////////	
	public function addPrice(){
		$item_id = (int)$_GET['item_id'];
		$edit_id = (int)$_GET['editId'];
		if($_POST['add_price'] == 1){
			$this->model_catalog->addPrice();
		}
		
		if($_GET['mode'] == 'edit'){
			
			$data['info'] = $this->model_catalog->editPrice($edit_id);
		}
		
		if($_GET['mode'] == 'delete'){
			$this->model_catalog->deletePrice($edit_id);
		}
		
		
		$data['item_id'] = $item_id;
		$data['prices'] = $this->model_catalog->getPrices($item_id);
		
		
		$data['title'] = $this->model_catalog->getCatTitle($this->uri['var']) .' | '. $this->model_catalog->getPriceTitle($_GET['item_id']);
		
		$this->loadView('catalog/view_addPrice', $data);
	}
	
	public function pricePosition() {
		$updateRecordsArray = $_POST['recordsArray'];
		$listingCounter = count($updateRecordsArray);
		
		foreach ($updateRecordsArray as $recordId) {
			$this->db->dbQuery('UPDATE item_price SET myorder='.$listingCounter.' WHERE id='.$recordId);
			$listingCounter = $listingCounter - 1;	
		}
	}
		
	}
?>