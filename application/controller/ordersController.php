<?php
class orders extends Application
{
	
	public function __construct(){
		parent::__construct();
		$this->loadModel('model_orders');
	}

//////////////////	
	public function index(){
		$data['title'] = 'Поръчки';
		
		$items = $this->model_orders->getOrders();
		
		foreach($items['items'] as $i):
			$arr[$i['id']] = array(
				'invoice' => $i['id']+100000,
				'date' => date('d.m.Y', $i['dateAdded']),
				'payment_method' => $i['payment_method'] == 1 ? 'Банков път' : 'В брой',
				'paid' => $i['paid'] == 1 ? 'Платена' : 'Чака плащане',
				'paid_class' => $i['paid'] == 1 ? 'td_green' : 'td_red',
			);
		endforeach;
		
		$data['orders'] = $arr;
		$data['pagination'] = $items['pagination'];
		$this->loadView('orders/view_allOrders', $data);
	}

/////////////	
	public function view_order(){
		$data['title'] = 'Поръчки';
		$data['info'] = $this->model_orders->getSingleOrder();
		
		$fisc =$data['info']['paid'];
		$data['isPaid'] = $fisc == 0 ? 'платена' : 'неплатена'; 
		$data['class'] = $fisc == 0 ? 'bred' : 'bgreen';
		
		$this->loadView('orders/view_singleOrder', $data);
	}

//////////////	
	public function updateOrder(){
		$data['info'] = $this->model_orders->getSingleOrder();
		$fisc = $data['info']['paid'];
		$isPaid = $fisc == 0 ? 1 : 0;
		$this->model_orders->updateOrder($isPaid);
	}
	
////////////////
	////////////////////	
	public function deleteOrder(){
		$id = (int)$_GET['id'];
		$this->model_orders->deleteOrder($id);
	}

	
}
?>