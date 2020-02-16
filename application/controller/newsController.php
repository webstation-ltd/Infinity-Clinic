<?php
	class news extends Application
	{
		public function __construct(){
			parent::__construct();
			$this->loadModel('model_news');
			$this->loadModel('model_menu');
			if($this->model_news->menu_id == 0){ header('location:?c=menu'); exit;}
		}

		public function index(){
			$data['menu_id'] = $this->model_news->menu_id;
			$data['title'] = $this->model_menu->menuCurrentName( $this->model_news->menu_id );
			$data['getNews'] = $this->model_news->getNews();
			$this->loadView('news/view_news', $data);
		}


		/////////
		public function addNews(){

			if($_POST['post_news']==1){
				if(empty($data['err'])):
					if($this->model_news->edit_id>0):
						$this->model_news->updateNews();
					else:
						$this->model_news->addNews();
					endif;
				endif;
				$data['menu_id'] = htmlspecialchars($this->model_news->menu_id);
				$data['title'] = $this->model_menu->menuCurrentName($this->model_news->menu_id);

				//връщаме попълнената до момента информация, ако има пропуски в попълването
				foreach( $this->langs as $l):
					$data['title_'.$l['title']] =  stripcslashes($_POST['title_'.$l['title']]);
					$data['content_'.$l['title']] =  stripcslashes($_POST['content_'.$l['title']]);
				endforeach;

				$this->loadView('news/view_news', $data);
			}
		}

		//////////////EDIT NEWS
		public function edit(){
			$data['edit'] = $this->model_news->editNews();
			$data['title'] = $this->model_menu->menuCurrentName($this->model_news->menu_id);
			$data['menu_id'] = $this->model_news->menu_id;
			$data['images'] = $this->model_news->getImages($data['edit']['id']);
			$this->loadView('news/view_news', $data);
		}

		/////////////////DELETE
		public function delete(){
			$this->model_news->deleteNews();
		}


		///////////DELETE IMAGES
		public function deleteGalImg(){
			$id = (int)$this->uri['var'];
			$this->db->dbQuery('DELETE FROM news_img WHERE id ='.$id);
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}

		//////////////IMAGES
		public function addImages(){
			$menu_id = $this->model_news->menu_id;
			$item_id = $this->model_news->id;

			$last_id = $item_id;
			include ROOT.'/library/upload.class.php';
			$upload = new upload("/html/img/news/".$last_id.'/');
			$upload->max_large_thmb_width= 400 ;
			$upload->max_large_crop_width= 230 ;
			$upload->max_large_crop_height= 172 ;
			$upload->runUpload(true, true);
			foreach($upload->data as $img):
				$this->db->dbQuery('INSERT INTO news_img(img, cat_id) VALUES("'.$img.'", '.$last_id.')');
			endforeach;

			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;

		}


		///////////UPDATE POSITIONS
		public function imgPosition(){
			$updateRecordsArray = $_POST['recordsArray'];
			$listingCounter = count($updateRecordsArray);

			foreach ($updateRecordsArray as $recordId) {
				$this->db->dbQuery('UPDATE news_img SET myorder='.$listingCounter.' WHERE id='.$recordId);
				$listingCounter = $listingCounter - 1;
			}
		}

		////
		public function newsPosition(){
			$updateRecordsArray = $_POST['recordsArray'];
			$listingCounter = count($updateRecordsArray);

			foreach ($updateRecordsArray as $recordId) {
				$this->db->dbQuery('UPDATE news SET myorder='.$listingCounter.' WHERE id='.$recordId);
				$listingCounter = $listingCounter - 1;
			}
		}


	}
?>