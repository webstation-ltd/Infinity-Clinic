<?php
	class index extends Application
	{
		function __construct()
		{
		}
		
		function index()
		{
			$data['title'] = 'Страницата не съществува!';
			$this->loadView('view_index', $data);
		}
		
	}
?>