<?php if (!defined('PATH')) exit('Not allowed.');
	
	class Application
	{
		public $uri=array();
		public $langs = array();
		private $model;
		protected $db;
		protected $user_id;
		
		function __construct()
		{
			$this->uri['controller'] 	= $_GET['c']; //class
			$this->uri['method']		= $_GET['m']; //method
			$this->uri['var']			= $_GET['v']; //varible
			$this->uri['var1']			= $_GET['sv']; //second varible
			
			if(empty($this->uri['controller'])){
				$this->uri['controller'] = 'index';	//index controller
			}

			$this->db =  db::getInstance();
			
			$this->langs = $this->getLangs();
			
		}
		
		function loadController(){
			
			if(LOGIN == 'true'){
				if($_SESSION['login'] != true && $_SESSION['type'] != 4){
					require_once('application/controller/loginController.php');
					$controller = new login();
					if(method_exists($controller, $this->uri['method']))
					{
						$controller->{$this->uri['method']}($this->uri['var']);
					} else {
						$controller->index();	
					}
					
					exit;
				}
			}
			
			
			
			$file = "application/controller/".$this->uri['controller']."Controller.php";
				
			if(!file_exists($file)):
				require_once('application/controller/errorController.php');
				$controller = new index();
				$controller->index();
				
			else:
				require_once($file);
				$controller = new $this->uri['controller']();
				
				if(method_exists($controller, $this->uri['method']))
				{
					$controller->{$this->uri['method']}($this->uri['var']);
				} else {
					$controller->index();	
				}
			endif;
		}
		
		function loadView($view,$vars="")
		{
			if(is_array($vars) && count($vars) > 0)
				extract($vars, EXTR_PREFIX_SAME, "wddx");
			include 'view/header.php';	
			require_once('view/'.$view.'.php');
			include 'view/footer.php';
		}
		
		function loadModel($model)
		{
			require_once('model/'.$model.'.php');
			$this->$model = new $model;
		}
		
		/////////
		public function checkUrl($url){
			$num_menu = $this->db->dbArray('SELECT COUNT(*) as num FROM menu WHERE site_url="'.$url.'"');
			$num_cat = $this->db->dbArray('SELECT COUNT(*) as num FROM cat WHERE site_url="'.$url.'"');
			$num_items = $this->db->dbArray('SELECT COUNT(*) as num FROM items WHERE site_url="'.$url.'"');
			
			$num_controller = $this->db->dbArray('SELECT COUNT(*) as num FROM moduls WHERE controller="'.$url.'"');
			
			if( ($num_menu['num'] + $num_cat['num'] + $num_items['num']+ $num_controller['num']) != 0 ){
				return ($num_menu['num'] + $num_cat['num'] + $num_items['num']+ $num_controller['num']);	
			}else{
				return true;	
			}
		}
		
		
		/////////////public function GET_LANGS/////////////
		public function getLangs(){
			$lang = $this->db->dbArray('SELECT * FROM langs ORDER BY myorder DESC');
			
			foreach($lang as $k=>$t){
				$langs[$k] = $t;	
			}
			
			return $langs;
		} 
		
}

?>