<?php
	class services extends Application
	{
		function __construct()
		{
			$this->loadModel('model_services');
		}
		
		function index()
		{
			$data['title'] = 'Промоции';
			
			$services = $this->model_services->get();
			
			$data['content_bg'] = $services['content_bg'];
			$data['content_en'] = $services['content_en'];
			$this->loadView('services/view_services', $data);
		}
		
		public function update(){
			$this->model_services->update();
		}
		
	}
?>