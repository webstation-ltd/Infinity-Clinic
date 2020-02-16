<?php
	class textPages extends Application
	{
		function __construct()
		{
			parent::__construct();
			$this->loadModel('model_textPages');
			$this->loadModel('model_menu');
			
			//chek for menu id
			#if($this->model_textPages->menu_id == 0){ header('location:?c=menu'); exit;}
			
			
		}
		
		function index()
		{
			$title = $this->model_menu->menuName($this->model_textPages->menu_id);
			$data['title'] = $title['title_bg'];
			
			
			$data['menu_id'] = $this->model_textPages->menu_id;
			
			$data['edit'] = $this->model_textPages->getInfo();

			
			$this->loadView('text_pages/view_textPage', $data);
		}
		
		
		//създаваме запис или редактираме страница
		public function add(){
			if($_POST['post_page'] != 1){ header('location:?c=menu'); exit; }
			
			if($this->model_textPages->existPage()==0){
				$this->model_textPages->add($this->model_textPages->menu_id);
			}
			else{
				$this->model_textPages->update();
			}
		}
        
        function editPrices() {
            $menu_id = (int)$_GET['menu_id'];
            $id = (int)$_GET['id'];
            $data = $this->model_textPages->getInfoForServiceById($id);
            $parent_service = $this->model_textPages->getParentService($menu_id);
            $data = $data[0];
            $data['title'] = ($id) ? "Редакция" : "Добавяне";
            $data['title'] = $data['title']." цени за услуга - ".$data['title_bg'];
            $data['titles'] = array("bg" => $data['title_bg'], "ru" => $data['title_ru'], "en" => $data['title_en']);
            if($_POST) {
                $new_id = $this->model_textPages->updatePrices($id);
                header("location:".$_SERVER['HTTP_REFERER']."&id=".$new_id); exit;
            }
            /*
            echo '<pre>';
            print_r($data);
            */
            $this->loadView('text_pages/view_editPrices', $data);
            
        }
        
        function viewPrices() {
            $id = (int)$_GET['menu_id'];
            $data = $this->model_textPages->getInfoForService($id);
            $data['services'] = $data;
            $parent_service = $this->model_textPages->getParentService($id);
            $data['title'] = "Редакция цени за услуга - ".$parent_service[0]['title_bg'];
            $data['titles'] = array("bg" => $data['title_bg'], "ru" => $data['title_ru'], "en" => $data['title_en']);            
            $this->loadView('text_pages/view_viewPrices', $data);
            
        }
        
        function deletePrice() {
            $id = (int)$_GET['id'];
            $menu_id = (int)$_GET['menu_id'];
            $this->model_textPages->deletePriceItem($id);
            header("location:".$_SERVER['HTTP_REFERER']."&menu_id=".$menu_id); exit;
        }
		
        
        function viewFaq() {
            $id = (int)$_GET['menu_id'];
            $data = $this->model_textPages->getInfoForFaq($id);
            $data['faq'] = $data;
            $parent_service = $this->model_textPages->getParentService($id);
            $data['title'] = "Редакция FAQ за услуга - ".$parent_service[0]['title_bg'];
            $data['titles'] = array("bg" => $data['title_bg'], "ru" => $data['title_ru'], "en" => $data['title_en']);            
            $this->loadView('text_pages/view_viewFaq', $data);
            
        }
        
        function editFaq() {
            $menu_id = (int)$_GET['menu_id'];
            $id = (int)$_GET['id'];
            $data = $this->model_textPages->getInfoForFaqById($id);
            $parent_service = $this->model_textPages->getParentService($menu_id);
            $data = $data[0];
            $data['title'] = ($id) ? "Редакция" : "Добавяне нов";
            $data['title'] = $data['title']." въпрос за услуга - ".$parent_service[0]['title_bg'];
            $data['questions'] = array("bg" => $data['question_bg'], "ru" => $data['question_ru'], "en" => $data['question_en']);
            $data['answers'] = array("bg" => $data['answer_bg'], "ru" => $data['answer_ru'], "en" => $data['answer_en']);
            if($_POST) {
                $new_id = $this->model_textPages->updateFaq($id);
                header("location:".$_SERVER['HTTP_REFERER']."&id=".$new_id); exit;
            }
            /*
            echo '<pre>';
            print_r($data);
            */
            $this->loadView('text_pages/view_editFaq', $data);
            
        }
        
	}
?>