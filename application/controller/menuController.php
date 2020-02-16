<?php
	class menu extends Application
	{
		function __construct()
		{
			parent::__construct();
			$this->loadModel('model_menu');
			$this->loadModel('model_modul');
		}
		
		function index()
		{
			$data['title'] = 'Изграждане на менюта';
			$data['catMenuName'] = $this->model_menu->catMenuName();
			$data['category_menu'] = $this->model_menu->getMenuCategory();
			$data['menu_items'] = $this->getMenuItems();
			$this->loadView('menu/view_menu', $data);
			
		}
		
		public function delete(){
			$id  = (int)$_GET['id'];
			if($id>0):
				$this->model_menu->delete($id);
			endif;
		}
		
		public function editItem(){
			$id = (int)$_GET['id'];
			if($id==0)
				header('location:?c=menu');
			
			$data['title'] = 'Редакция';
			$data['info'] = $this->model_menu->editItem($id);
            $data['menus'] = $this->model_menu->getParentCategories();
			$this->loadView('menu/view_menu', $data);
		}
		
	////////////////////////
	public function addModul(){
		$menu_id = (int)$_GET['menu_id'];
		
		if( $menu_id == 0){
			header('location:?c=menu');	
			exit; 
		}
		
		$data['title'] = 'Тип на страница';
		$data['menuName'] =  $this->menuName($menu_id);
		
		$data['menu_id'] = $menu_id;
		$data['options'] = $this->model_modul->getModuls();
		
		$this->loadView('menu/view_addModul', $data);
	}
	
	public function menuName($id){
		 $test = $this->model_menu->menuName($id);
		 return $test['title_bg'];
	}
		
	/////////////////////////////////////	
		public function addItems(){
			if( strlen($this->model_menu->title_bg)<1 ){
				$data['err'] .= '<p class="err">Не е попълнено българко заглавие</p>';
			}
			
			if(EN == 'true'):
				if( strlen($this->model_menu->title_en)<1 ){
					$data['err'] .= '<p class="err">Не е попълнено английско заглавие</p>';
				}
			endif;
			
			if($this->model_menu->checkExistUrl() != 0){
				$data['err'] .= '<p class="err">Съществува такъв URL адрес</p>';	
			}
			
			if(empty($data['err'])){

				$this->model_menu->edit_id > 0 ?  $this->model_menu->updateItems() : $this->model_menu->addItems();
				
			}else{
				$data['title'] = 'Изграждане на менюта';
				
				$data['info']['title_bg'] = $this->model_menu->title_bg;
				$data['info']['title_en'] = $this->model_menu->title_en;
				$data['info']['site_url'] = $this->model_menu->site_url;
				
				$data['catMenuName'] = $this->model_menu->catMenuName();
				$data['category_menu'] = $this->model_menu->getMenuCategory();
				
				
				$this->model_menu->edit_id > 0 ? $this->loadView('menu/view_menu', $data) : $this->loadView('menu/view_editMenu', $data);
			}
			
		}
		
		
		
		
	/////////////MENU TYPE////////////////
	public function addMenuType(){
		$menu_id = (int)$_POST['menu_id'];
		$menu_type = (int)$_POST['menu_type'];
		
		if( $menu_id>0 && $menu_type>0){
			$this->model_menu->addMenuType($menu_id, $menu_type);
		}
		
		header('location:?c=menu');
		exit;
	}
	
////////////////////////////TREE MENU//////	///////////////
	public function returnModulName($id){
		$modulController = $this->model_modul->modulName($id);	
		return $modulController['controller'];
	}

	public function getMenuItems(){
		$menu = $this->model_menu->getMenuItems();
		
		$html = '<ul id="easymm">'."\n";
		foreach($menu as $m){
			$html .= '<li id="menu-'.$m['id'].'"  class="sortable">
			<div class="ns-row">
                    <div class="ns-title">'.$m['title_bg'].'</div>
                    <div class="ns-url">';
					
					if($m['module'] !=7){
					$html .= $m['module'] != 0 ? 
					'<a href="?c='.$this->returnModulName($m['module']).'&amp;menu_id='.$m['id'].'"><span class="green">Редактирай страницата</span></a>': 
					'<a href="?c=menu&amp;m=addModul&amp;menu_id='.$m['id'].'"><span class="red">Избери тип на страницата</span></a>';
					}
                    $html .= '</div><div class="ns-class"></div>
					
                    <div class="ns-actions">
                    <a href="?c=menu&amp;m=editItem&amp;id='.$m['id'].'" title="Edit Menu"><img src="'.ADMIN.'/html/img/edit.png" alt="Edit">
                    </a>';
					if(DEL_PAGES == 'true'):
                   		$html .='<a href="?c=menu&m=delete&id='.$m['id'].'"><img src="'.ADMIN.'/html/img/cross.png" alt="Delete"></a>';
					endif;
                   $html .= '<input type="hidden" name="menu_id" value="'.$m['id'].'">
                    </div>
                </div>';
				
			$html .= $this->getParentMenuItems( $m['id'] );
			$html .= '</li>'."\n";
		}
		$html .= '</ul>'."\n";
		
		return $html;
	}
	
	
	private function getParentMenuItems($id){
		
		$parent =$this->model_menu->getParentMenuItems($id);
		
		if(!empty ($parent) ){
			$html .= '<ul>'."\n";
			foreach($parent as $m){
				$html .= '<li id="menu-'.$m['id'].'"  class="sortable">
					<div class="ns-row">
                    <div class="ns-title">'.$m['title_bg'].'</div>
                    <div class="ns-url">';
					
					$html .= $m['module'] != 0 ? 
					'<a href="?c='.$this->returnModulName($m['module']).'&amp;menu_id='.$m['id'].'"><span class="green">Редактирай страницата</span></a>':
					 
					'<a href="?c=menu&amp;m=addModul&amp;menu_id='.$m['id'].'"><span class="red">Избери тип на страницата</span></a>';
					
                    $html .= '</div><div class="ns-class"></div>
					
                    <div class="ns-actions">
                    <a href="?c=menu&amp;m=editItem&amp;id='.$m['id'].'" title="Edit Menu"><img src="'.ADMIN.'/html/img/edit.png" alt="Edit">
                    </a>';
					
					if(DEL_PAGES == 'true'):
						$html .='<a href="?c=menu&m=delete&id='.$m['id'].'"><img src="'.ADMIN.'/html/img/cross.png" alt="Delete"></a>';
					endif;
					
                   $html .=' <input type="hidden" name="menu_id" value="'.$m['id'].'">
                    </div>
                </div>';
				
				
				//<a href="#" class="delete-menu"><img src="'.ADMIN.'/html/img/cross.png" alt="Delete"></a>

				$html .= $this->getParentMenuItems( $m['id'] );
				$html .= '</li>'."\n";
			}
			$html .= '</ul>'."\n";
			return $html;
		}
	}
///////////////////SAVE POSITION //////////////////////////////////////
	public function save_position() {
		if (isset($_POST['easymm'])) {
			$easymm = $_POST['easymm'];
			$this->update_position(0, $easymm);
		}
	}

	/**
	 * Recursive function for save menu position
	 */
	private function update_position($parent, $children) {
		$i = 1;
		foreach ($children as $k => $v) {
			$id = (int)$children[$k]['id'];
			
			$this->db->dbQuery('UPDATE menu SET parent_id = '.$parent.', position='.$i.' WHERE id = ' . $id);
			
			if (isset($children[$k]['children'][0])) {
				$this->update_position($id, $children[$k]['children']);
			}
			$i++;
		}
	}
		
	}
?>