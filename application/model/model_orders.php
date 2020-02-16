<?php
class model_orders extends Application
{
	
	
	public function __construct(){
		parent::__construct();
	}
	
/////////////////////////////
	public function getOrders(){
		$count = $this->db->dbArray('SELECT COUNT(*) as num FROM orders', true);
			$current = (int)$this->uri['method'];
			$perpage = 50;
			$total = $count['num'];
			$this->pagination = new pagination($total, $perpage, $current, 2, 10);
			
			$this->pagination->createLinks(ADMIN.'/?c='.$this->uri['controller'].'&m=');
			
			$data['items'] = $this->db->dbArray('SELECT * FROM orders ORDER BY id DESC LIMIT '.$this->pagination->_offset.','.$perpage);
			$data['pagination'] =  $this->pagination->printLinks();
			return $data; 	
	}

//////////////	
	public function getSingleOrder(){
		$id = (int)$_GET['id'];
		return $this->db->dbArray('SELECT * FROM orders WHERE id='.$id, true);
	}

////////////	
	public function getfisc(){
		$id = (int)$_GET['id'];
		return $this->db->dbArray('SELECT * FROM fisk WHERE i_id='.$id, true);
		
	}

///////////	
	public function updateOrder($paid){
		$id = (int)$_GET['id'];
		$this->db->dbQuery('UPDATE orders SET paid='.$paid.' WHERE id='.$id);
		header('location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
//////////////

	public function deleteOrder($id){
		$id = (int)$id;
		$this->db->dbQuery('DELETE FROM orders WHERE id='.$id);
		header('location:'.$_SERVER['HTTP_REFERER']);
		exit;	
	}
	

}
?>