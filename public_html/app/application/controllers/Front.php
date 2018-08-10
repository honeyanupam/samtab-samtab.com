<?php date_default_timezone_set('asia/kolkata');
		defined('BASEPATH') OR exit('No direct script access allowed');

	class Front extends MY_Controller 
		{

			public function __construct()
				{
					parent::__construct();
						$this->load->helper(array('form','language','url'));
						$this->load->model('CommonModel');
						$this->load->model('InformationModel');
							if(isset($_COOKIE['language']))
								{
									$this->lang->load($_COOKIE['language']."_landing" , $_COOKIE['language']);
								} else {
									$this->lang->load('english_landing' , 'english');
								}
				}
				
			public function index()
				{
					$data  = array();
					$data['layout'] = $this->webLayout($data);
					$this->load->view("webpage/index.tpl",$data);

				}

			public function enquiry()
				{
					echo $this->InformationModel->enquiry();
				}	
				
			public function contactus()
				{
					echo $this->InformationModel->contactus();
				}	
					

			
		}		
?>