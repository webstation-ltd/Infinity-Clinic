<?php
	class gallery extends Application
	{
		function __construct()
		{
			parent::__construct();
			$this->loadModel('model_gallery');
			$this->catId = (int)$this->uri['var'];
			if($this->model_gallery->menu_id == 0){ header('location:?c=menu'); exit;}
			
		}
		

/////////////////////
		function index()
		{
			
			/*header('location:?c=gallery&m=addImages&v=3&menu_id=5');
			exit;*/
			
			if($_POST['post_gallery'] == 1){
				
				$add = $this->model_gallery->addGalerry();
				
				if($add != true){
					foreach($add['err'] as $err):
						$data['err'] .= $err;
					endforeach;	
				}else{
					$data['sucess'] = 'Успешно добавяне на категория';	
				}
			}
			
			$data['info'] = $this->model_gallery->editInfo( );
			$data['items'] =  $this->model_gallery->getCat();
			$data['menu_id'] = $this->model_gallery->menu_id;
			$this->loadView('gallery/view_gallery', $data);
		}
		
		
/////////////DELETE CAT
		public function deleteCat(){
			$id = (int)$_GET['id'];
			$this->model_gallery->deleteCat($id);
			header('location:'.$_SERVER['HTTP_REFERER']);
		}
		
//////////////UPDATE GALLERY POSITION
		public function catPosition() {
			$updateRecordsArray = $_POST['recordsArray'];
			$listingCounter = count($updateRecordsArray);
			
			foreach ($updateRecordsArray as $recordId) {
				$this->db->dbQuery('UPDATE gallery SET myorder='.$listingCounter.' WHERE id='.$recordId);
				$listingCounter = $listingCounter - 1;	
			}
		}


///////////////////ADD IMAGES////////////
		public function addImages(){
			if($_POST['add_img'] == 1){
				$this->model_gallery->addImages($this->catId);
			}
			
			$data['items'] = $this->model_gallery->getImages($this->catId);
			$data['menu_id'] = $this->model_gallery->menu_id;
			$data['gal_id'] = $this->catId;
			$data['catName'] = $this->model_gallery->catName($this->catId);
			$this->loadView('gallery/view_addImages', $data);	
		}
		
		
///////////////////DELETE IMAGES////////////////////
		public function deleteImages(){
			$id = (int)$this->uri['var'];
			$this->model_gallery->deleteImages($id);
		}
		
///////////////////UPDATE IMAGE POSITION
		public function imgPosition() {
			$updateRecordsArray = $_POST['recordsArray'];
			$listingCounter = count($updateRecordsArray);
			foreach ($updateRecordsArray as $recordId) {
				$this->db->dbQuery('UPDATE gallery_img SET myorder='.$listingCounter.' WHERE id='.$recordId);
				$listingCounter = $listingCounter - 1;
			}
		}
		
		
	}
?>