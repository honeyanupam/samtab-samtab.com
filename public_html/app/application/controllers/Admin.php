<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends MY_Controller 
		{
			
			public function __construct()
				{
					parent::__construct();

						$this->load->helper(array('form','language','url'));
						$this->load->model('InformationModel');
						$this->load->model('AdminModel');
												
								$this->load->library('pagination');

							if(isset($_COOKIE['language']))
								{
									$this->lang->load($_COOKIE['language']."_landing" , $_COOKIE['language']);
								} else {
									$this->lang->load('english_landing' , 'english');
								}
				}
					
						
			public function index()
				{
					$data = array();
					$seo  = array();
					$checklogin	=	$this->AdminModel->checkloggedin();
							if($checklogin)
								{
									// echo "<pre>"; print_r($checklogin); echo "</pre>"; exit(0);
									redirect("information/dashboard?token=".md5(time()));	
								}
									$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("building");
						$seo['title']			=	"Login to SamTab for quick access to Admin data - ".WEBSITENAME;
						$seo['metatitle']		=	"Login to SamTab for quick access to Admin data - ".WEBSITENAME;
						$seo['title']			=	"Login to SamTab for quick access to Admin data - ".WEBSITENAME;
						$seo['metadescription']	=	lang('textmetatitle')." - ".WEBSITENAME;
								$data['data']['seo']	=	$seo;

									$data['layout'] = $this->bldAdminLayout($data);

									$this->load->view("admin/login.tpl" ,$data);	
				}
				
				
			public function adminlogin()
				{
					echo $this->AdminModel->adminlogin();
				}
				
			public function addprimise()
				{
					echo $this->AdminModel->addprimise();
				}	
			
			public function changepassword()
				{
					echo $this->AdminModel->changepassword();
				}
		}
		
?>