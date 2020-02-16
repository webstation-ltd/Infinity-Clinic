<?php
	class newsletter extends Application
	{
		public $title;
		public $content;
		
		public function __construct()
		{
			parent::__construct();
			$this->title = $this->db->input($_POST['title']);
			$this->content = $_POST['content'];
			$this->content = str_replace('src="/html/upload/', 'src="'.PATH.'/html/upload/', $this->content);
			$this->loadModel('model_newsletter');
		}
		
		public function index()
		{
			if($_POST['post_newsletter'] == 1){
				$this->sendNewsletter();
			}
			$data['title'] = 'Бюлетин';
			$this->loadView('newsletter/view_newsletter', $data);
		}
		
		
		public function emailList(){
			$data['title'] = 'Списък с емайл адреси';
			$data['emails'] = $this->model_newsletter->getMails();
			$this->loadView('newsletter/view_list', $data);
		}
		
		///
		public function delete(){
			$this->model_newsletter->delete();
			
			header('location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
		
		//////
		private function sendNewsletter(){
			require_once ROOT.'/library/Swift/lib/swift_required.php';
			$transport = Swift_MailTransport::newInstance();
			// Create the Mailer using your created Transport
			$mailer = Swift_Mailer::newInstance($transport);
			// Create a message
			$message = Swift_Message::newInstance($this->title)
			  ->setFrom(array('newsletter@mudar-m.com' => 'Mudar-M'))
			  ->setTo(array( $this->getMails() => 'Mudar - M'))
			  ->setBody( $this->content, 'text/html');

			// Send the message
			$result = $mailer->send($message); 
			//echo $result;
			header('location:?c=newsletter&m=successNewsletter');
			exit;
		}
		
		/////
		
		public function successNewsletter(){
			$this->loadView('newsletter/view_success', $data);
		}
		////
	public function getMails(){
		$mails = $this->model_newsletter->getMails();
		foreach($mails as $m){
			$new_mail .= $m['email'].', ';
		}
		$new_mail = substr($new_mail,0,-2); 
		return $new_mail;
	}
		
	
}
?>