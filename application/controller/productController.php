<?php
	class product extends Application
	{
		public $_option;
		public function __construct()
		{
			parent::__construct();
			
			if($_GET['mode']== 'down'){
				//myorder::down( (int)$_GET['myorder'], 'cat', ' AND parent_id='.(int)$_GET['parent_id']);
			}
			
			if($_GET['mode']== 'up'){
				//myorder::up((int)$_GET['myorder'], 'cat', ' AND parent_id='.(int)$_GET['parent_id']);
			}
		}
		
		public function index()
		{
			$this->loadModel('model_catalog');
			
			
			$data['title'] = 'Каталог - добавяне продукти';
			$this->loadView('catalog/view_product', $data);
		}
		
/////////////////////////////////CATEGORY////////////////////////////////////////////
				

////////////////menu////////////////		
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
	////////////////////////////////////////////	
		
	}
?>