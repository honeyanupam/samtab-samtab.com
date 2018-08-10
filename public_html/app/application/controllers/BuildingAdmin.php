<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

	class BuildingAdmin extends MY_Controller 
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
					
			
			public function activities($page)
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
								
						$config['base_url'] = base_url("building/activities/");
							$token					=	$this->session->userdata('token');
							$token					=	base64_decode($token);
							$config['total_rows'] = $this->InformationModel->countallrowwhereclouse("tbl_notify","user_id",$token,'added');
							//echo "<pre>"; print_r($config['total_rows']); echo "</pre>";
							$config['per_page'] = 10;
							if(empty($page))
									{
										$page = 1;
									}	
							$data['notification']	=	$this->InformationModel->getactivities("tbl_notify","user_id",$token,$config['per_page'],$page);  
							$config['use_page_numbers'] = TRUE;
											$config['full_tag_open'] 	= 	"<ul class='pagination'>";
											$config['full_tag_close'] 	= 	'</ul>';
											$config['num_tag_open'] 	= 	'<li>';
											$config['num_tag_close'] 	= 	'</li>';
											$config['cur_tag_open'] 	= 	'<li class="active"><a>';
											$config['cur_tag_close'] 	= 	'</a></li>';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['first_tag_open'] 	= 	'<li>';
											$config['first_tag_close'] 	= 	'</li>';
											$config['last_tag_open'] 	= 	'<li>';
											$config['last_tag_close'] 	= 	'</li>';
											$config['prev_link'] 		= 	'<i class="fa fa-long-arrow-left"></i>Previous Page';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['next_link'] 		= 	'Next Page<i class="fa fa-long-arrow-right"></i>';
											$config['next_tag_open'] 	=	'<li>';
											$config['next_tag_close'] 	=	'</li>';
										
										
										
							$this->pagination->initialize($config);
							$data['pagination']		=	$this->pagination->create_links(); 
							$data['checklogin']		=	$checklogin;
							$seo['url']				=	site_url("Admin/notification");
							$seo['title']			=	"Activities on ".WEBSITENAME;
							$seo['metatitle']		=	"Activities on ".WEBSITENAME;
							$seo['metadescription']	=	"Activities on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/notification.tpl" ,$data );
				}	

			public function allflats($page)
				{
				
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
									$data['checklogin']		=	$checklogin;
								// echo "<pre>"; print_r($data['latestvisitors']); echo "</pre>";
								$config['base_url'] = base_url("building/allflats/");
								
									$config['total_rows'] = $this->InformationModel->countallflats();
									//echo "<pre>"; print_r($config['total_rows']); echo "</pre>";
										$config['per_page'] = 6;
										
											if(empty($page))
												{
													$page = 1;
												}
											if(isset($_GET['searchkeyword']))
												{
													$search = $_GET['searchkeyword'];
												}else{
													$search ='';
												}
					
											
											$data['getallflats']		=	$this->InformationModel->getallflats($config['per_page'],$page,$search); 
											$data['uploadflatdata']		=	$this->InformationModel->uploadflatdata(); 
										
											$config['use_page_numbers'] = TRUE;
											$config['full_tag_open'] 	= 	"<ul class='pagination'>";
											$config['full_tag_close'] 	= 	'</ul>';
											$config['num_tag_open'] 	= 	'<li>';
											$config['num_tag_close'] 	= 	'</li>';
											$config['cur_tag_open'] 	= 	'<li class="active"><a>';
											$config['cur_tag_close'] 	= 	'</a></li>';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['first_tag_open'] 	= 	'<li>';
											$config['first_tag_close'] 	= 	'</li>';
											$config['last_tag_open'] 	= 	'<li>';
											$config['last_tag_close'] 	= 	'</li>';
											$config['prev_link'] 		= 	'<i class="fa fa-long-arrow-left"></i>Previous Page';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['next_link'] 		= 	'Next Page<i class="fa fa-long-arrow-right"></i>';
											$config['next_tag_open'] 	=	'<li>';
											$config['next_tag_close'] 	=	'</li>';
										
										
										
							$this->pagination->initialize($config);
							$data['pagination']		=	$this->pagination->create_links();
								
							$seo['url']				=	site_url("building/allflats");
							$seo['title']				=	"All Flat";
							$seo['metatitle']			=	"All Flat";
							$seo['metadescription']	=	"All Flat";
							$data['data']['seo'] 		= 	$seo;
							$data['layout'] 			= $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/allflats.tpl" ,$data );  
				}
				
			public function allgatekeepers($page)
				{
				  
				$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
									$data['checklogin']		=	$checklogin;
								// echo "<pre>"; print_r($data['latestvisitors']); echo "</pre>";
								$config['base_url'] = base_url("building/allgatekeepers/");
								
									$config['total_rows'] = $this->InformationModel->countgatekeepers();
									//echo "<pre>"; print_r($config['total_rows']); echo "</pre>";
										$config['per_page'] = 6;
										
											if(empty($page))
												{
													$page = 1;
												}
											if(isset($_GET['searchkeyword']))
												{
													$search = $_GET['searchkeyword'];
												}else{
													$search ='';
												}
											
											$data['getgatekeepers']		=	$this->InformationModel->getgatekeepers($config['per_page'],$page,$search); 
										
											$config['use_page_numbers'] = TRUE;
											$config['full_tag_open'] 	= 	"<ul class='pagination'>";
											$config['full_tag_close'] 	= 	'</ul>';
											$config['num_tag_open'] 	= 	'<li>';
											$config['num_tag_close'] 	= 	'</li>';
											$config['cur_tag_open'] 	= 	'<li class="active"><a>';
											$config['cur_tag_close'] 	= 	'</a></li>';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['first_tag_open'] 	= 	'<li>';
											$config['first_tag_close'] 	= 	'</li>';
											$config['last_tag_open'] 	= 	'<li>';
											$config['last_tag_close'] 	= 	'</li>';
											$config['prev_link'] 		= 	'<i class="fa fa-long-arrow-left"></i>Previous Page';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['next_link'] 		= 	'Next Page<i class="fa fa-long-arrow-right"></i>';
											$config['next_tag_open'] 	=	'<li>';
											$config['next_tag_close'] 	=	'</li>';
										
										
										
											$this->pagination->initialize($config);
												
												
												$data['pagination']		=	$this->pagination->create_links();
								
								
								$data['resetdevicedetail']	=	$this->InformationModel->resetdevicedetail();  
								
						$seo['url']				=	site_url("building/allgatekeepers");
						$seo['title']			=	"All Gate Keeper";
						$seo['metatitle']		=	"All Gate Keeper";
						$seo['metadescription']	=	"All Gate Keeper";
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/allgatekeepers.tpl" ,$data ); 

					
				}
				
			public function visitorslog($page)
				{
					// visitorslogs.tpl
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
									$data['checklogin']		=	$checklogin;
									$config['base_url'] = base_url("building/visitors-logs/");
									$config['total_rows'] = $this->InformationModel->countvisitorlogs();
										$config['per_page'] = 9; 
										
											if(empty($page))
												{
													$page = 1;
												}
											if(isset($_GET['searchkeyword']))
												{
													$search = $_GET['searchkeyword'];
												}else{
													$search ='';
												}	
										$data['getvisitorlogs']		=	$this->InformationModel->getvisitorlogs($config['per_page'],$page,$search); 
											$config['use_page_numbers'] = TRUE;
											$config['full_tag_open'] 	= 	"<ul class='pagination'>";
											$config['full_tag_close'] 	= 	'</ul>';
											$config['num_tag_open'] 	= 	'<li>';
											$config['num_tag_close'] 	= 	'</li>';
											$config['cur_tag_open'] 	= 	'<li class="active"><a>';
											$config['cur_tag_close'] 	= 	'</a></li>';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['first_tag_open'] 	= 	'<li>';
											$config['first_tag_close'] 	= 	'</li>';
											$config['last_tag_open'] 	= 	'<li>';
											$config['last_tag_close'] 	= 	'</li>';
											$config['prev_link'] 		= 	'<i class="fa fa-long-arrow-left"></i>Previous Page';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['next_link'] 		= 	'Next Page<i class="fa fa-long-arrow-right"></i>';
											$config['next_tag_open'] 	=	'<li>';
											$config['next_tag_close'] 	=	'</li>';
										
											$this->pagination->initialize($config);
												
												$data['pagination']		=	$this->pagination->create_links();
								
								
								
								
						$seo['url']				=	site_url("building/dashboard");
						$seo['title']			=	"All Visitors Log";
						$seo['metatitle']		=	"All Visitors Log";
						$seo['metadescription']	=	"All Visitors Log";
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/visitorslogs.tpl" ,$data ); 
				}
				
			public function editgatekeeper($gkid) 
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
						$data['checklogin']		=	$checklogin;
						
						$data['selectdata']		=	$this->InformationModel->getdataoftablewhereclose('gatekeeper','gkid',$gkid);
						$seo['url']				=	site_url("building/editgatekeeper");
						$seo['title']			=	"Edit Gate Keeper";
						$seo['metatitle']		=	"Edit Gate Keeper";
						$seo['metadescription']	=	"Edit Gate Keeper";
						$data['data']['seo'] = $seo; 
						$data['layout'] = $this->bldAdminLayout($data); 
						$this->load->view("buildingadmin/editgatekeeper.tpl" ,$data );
				}
				
			public function editflat($fltid) 
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
						$data['checklogin']		=	$checklogin;
						
						$data['selectdata']		=	$this->InformationModel->getdataoftablewhereclose('flats','fltid',$fltid);
						$seo['url']				=	site_url("building/editflat");
						$seo['title']			=	"Edit Flat Details";
						$seo['metatitle']		=	"Edit Flat Details";
						$seo['metadescription']	=	"Edit Flat Details";
						$data['data']['seo'] = $seo; 
						$data['layout'] = $this->bldAdminLayout($data);
						$this->load->view("buildingadmin/editflat.tpl" ,$data );
				}
				
			public function dashboard() 
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
						$data['checklogin']		=	$checklogin;
						
						$data['latestvisitors']		=	$this->InformationModel->latestvisitors(6); 
						
						
								// echo "<pre>"; print_r($data['latestvisitors']); echo "</pre>";
						
						$seo['url']				=	site_url("building/dashboard");
						$seo['title']			=	lang('welcometext')." - ".WEBSITENAME;
						$seo['metatitle']		=	lang('welcomemetatitle')." - ".WEBSITENAME;
						$seo['metadescription']	=	lang('welcomemetadescription')." - ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/dashboard.tpl" ,$data );
				}
			
			public function settings() 
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
						$data['checklogin']		=	$checklogin;
						
						$data['resetlocation']	=	$this->InformationModel->resetlocation();   
						$data['selectdata']		=	$this->InformationModel->selectsingledataprisme();   
						
						$seo['url']				=	site_url("building/settings");
						$seo['title']			=	"Settings on ".WEBSITENAME;
						$seo['metatitle']		=	"Settings on ".WEBSITENAME;
						$seo['metadescription']	=	"Settings on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/settings.tpl" ,$data );
				}
			
	  
			public function visitorflat($id,$page) 
				{      
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
								
						$config['base_url'] = base_url("building/visitorflat/$id/");
								 
									$config['total_rows'] = $this->InformationModel->countvisitorflat($id);
										$config['per_page'] = 9;
										
											if(empty($page))
												{
													$page = 1;  
												}		
								  
						$data['visitorflat']		=	$this->InformationModel->visitorflat($id,$config['per_page'],$page); 
						$config['use_page_numbers'] = TRUE;
						$config['full_tag_open'] 	= 	"<ul class='pagination'>";
						$config['full_tag_close'] 	= 	'</ul>';
						$config['num_tag_open'] 	= 	'<li>';
						$config['num_tag_close'] 	= 	'</li>';
						$config['cur_tag_open'] 	= 	'<li class="active"><a>';
						$config['cur_tag_close'] 	= 	'</a></li>';
						$config['prev_tag_open'] 	= 	'<li>';
						$config['prev_tag_close'] 	= 	'</li>';
						$config['first_tag_open'] 	= 	'<li>';
						$config['first_tag_close'] 	= 	'</li>';
						$config['last_tag_open'] 	= 	'<li>';
						$config['last_tag_close'] 	= 	'</li>';
						$config['prev_link'] 		= 	'<i class="fa fa-long-arrow-left"></i>Previous Page';
						$config['prev_tag_open'] 	= 	'<li>';
						$config['prev_tag_close'] 	= 	'</li>';
						$config['next_link'] 		= 	'Next Page<i class="fa fa-long-arrow-right"></i>';
						$config['next_tag_open'] 	=	'<li>';
						$config['next_tag_close'] 	=	'</li>';
						$this->pagination->initialize($config);
						$data['pagination']		=	$this->pagination->create_links();
						$data['checklogin']		=	$checklogin;  
						$seo['url']				=	site_url("building/visitorflat");      
						$seo['title']			=	"Visit Flats";
						$seo['metatitle']		=	"Visit Flats";
						$seo['metadescription']	=	"Visit Flats";
							$data['data']['seo'] = $seo; 
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/visitorflat.tpl" ,$data );
				}
			
			public function visitordetails($id) 
				{      
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
								
						$data['visitordetails']	 =	$this->InformationModel->getdataoftablewhereclose('visitors','visid',$id); 
						$data['checklogin']		 =	$checklogin;  
						$seo['url']				 =	site_url("building/visitorflat");      
						$seo['title']			 =	"Visitor Information";
						$seo['metatitle']		 =	"Visitor Information";
						$seo['metadescription']	 =	"Visitor Information";
						$data['data']['seo'] =  $seo; 
						$data['layout'] 	 = 	$this->bldAdminLayout($data);
						$this->load->view("buildingadmin/visitordetails.tpl" ,$data );
				}
				
			public function flatdet($id,$page)
				{      
					$data = array();
					$seo  = array();
						$checklogin	=	$this->InformationModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("building?token=invalid");	
								}
						$data['checklogin']		=	$checklogin; 
						$config['base_url'] = base_url("building/flatdet/$id/");
								 
									$config['total_rows'] = $this->InformationModel->countvisitorlogs1($id);
										$config['per_page'] = 9;
										
											if(empty($page))
												{
													$page = 1;  
												}
						$data['flatdetails']		=	$this->InformationModel->flatdetails($id,$config['per_page'],$page); 
						$data['flatdetailsbyId']	=	$this->InformationModel->flatdetailsbyId($id);  
						
						$config['use_page_numbers'] = TRUE;
											$config['full_tag_open'] 	= 	"<ul class='pagination'>";
											$config['full_tag_close'] 	= 	'</ul>';
											$config['num_tag_open'] 	= 	'<li>';
											$config['num_tag_close'] 	= 	'</li>';
											$config['cur_tag_open'] 	= 	'<li class="active"><a>';
											$config['cur_tag_close'] 	= 	'</a></li>';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['first_tag_open'] 	= 	'<li>';
											$config['first_tag_close'] 	= 	'</li>';
											$config['last_tag_open'] 	= 	'<li>';
											$config['last_tag_close'] 	= 	'</li>';
											$config['prev_link'] 		= 	'<i class="fa fa-long-arrow-left"></i>Previous Page';
											$config['prev_tag_open'] 	= 	'<li>';
											$config['prev_tag_close'] 	= 	'</li>';
											$config['next_link'] 		= 	'Next Page<i class="fa fa-long-arrow-right"></i>';
											$config['next_tag_open'] 	=	'<li>';
											$config['next_tag_close'] 	=	'</li>';
										
										
										
											$this->pagination->initialize($config);
												
												
												$data['pagination']		=	$this->pagination->create_links();
								
								
								
						$seo['url']				=	site_url("building/flatdet");      
						$seo['title']			=	"Flat Details";
						$seo['metatitle']		=	"Flat Details";
						$seo['metadescription']	=	"Flat Details";
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("buildingadmin/flatdetails.tpl" ,$data );
				}
						
			public function index()
				{
					$data = array();
					$seo  = array();
					$checklogin	=	$this->InformationModel->checkloggedin();
							if($checklogin)
								{
									// echo "<pre>"; print_r($checklogin); echo "</pre>"; exit(0);
									redirect("building/dashboard?token=".md5(time()));	
								} else {
									$checkforadmin	=	$this->session->userdata('logintype');
										if($checkforadmin=="admin")
											redirect("admin?token=".md5(time()));	
								}
								
								
									$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("building");
						$seo['title']			=	"Login to SamTab for quick access to Premises data - ".WEBSITENAME;
						$seo['metatitle']			=	"Login to SamTab for quick access to Premises data - ".WEBSITENAME;
						$seo['title']			=	"Login to SamTab for quick access to Premises data - ".WEBSITENAME;
						$seo['metadescription']		=	lang('textmetatitle')." - ".WEBSITENAME;
								$data['data']['seo']	=	$seo;

									$data['layout'] = $this->bldAdminLayout($data);

									$this->load->view("buildingadmin/login.tpl" ,$data);	
				}
				
				
			public function dobldlogin()
				{
					echo $this->InformationModel->dologin();
				}
			
			public function addgatekeeper()
				{
					echo $this->InformationModel->addgatekeeper();    
				}
				
			public function editgatekeeperdetails()
				{
					echo $this->InformationModel->editgatekeeperdetails();
				}
				
			public function addflat()
				{
					echo $this->InformationModel->addflat();
				}
			public function updateprofile()
				{
					echo $this->InformationModel->updateprofile();
				}
				
			public function changepassword()
				{
					echo $this->InformationModel->changepassword();
				}
			
			public function resetmypassword() 
				{
					echo $this->InformationModel->resetmypassword();
				}	
				
			public function flatstatus()
				{
					echo $this->InformationModel->flatstatus();
				}
				
			public function gatekeeperstatus()
				{
					echo $this->InformationModel->gatekeeperstatus();
				}	
				
			public function editflatdetail() 
				{
					echo $this->InformationModel->editflatdetail();
				}	
				
				
		}
		
?>