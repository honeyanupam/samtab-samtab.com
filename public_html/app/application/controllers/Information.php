<?php date_default_timezone_set('asia/kolkata');
		defined('BASEPATH') OR exit('No direct script access allowed');

	class Information extends MY_Controller 
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

			public function dashboard()
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
						$data['checklogin']			=	$checklogin;
						$data['flats']				=	$this->InformationModel->getcountoftable("flats","fltid");
						$data['visitors']			=	$this->InformationModel->getcountoftable("visitors","visid");
						$data['vislogs']			=	$this->InformationModel->getcountoftable("vislogs","visid");
						$data['buildings']			=	$this->InformationModel->getcountoftable("bld_admin","bldid");
						$data['allbldadmin']		=	$this->InformationModel->selectdataprisme(6,1,0);		
						$data['allvisitors']		=	$this->InformationModel->getdataoftablelimit('visitors',6,1);
						$seo['url']					=	site_url("Admin/dashboard");
						$seo['title']				=	lang('welcometext')." - ".WEBSITENAME;
						$seo['metatitle']			=	lang('welcomemetatitle')." - ".WEBSITENAME;
						$seo['metadescription']		=	lang('welcomemetadescription')." - ".WEBSITENAME;  
						$data['data']['seo']		= 	$seo;
						$data['layout'] 			= 	$this->frontLayout($data);
						$this->load->view("front/dashboard.tpl" ,$data ); 
				} 

			
			public function settings() 
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
						$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("information/settings");
						$seo['title']			=	"Settings on ".WEBSITENAME;
						$seo['metatitle']		=	"Settings on ".WEBSITENAME;
						$seo['metadescription']	=	"Settings on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("front/setting.tpl" ,$data );
				}
			
			public function premise($page)
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
							$config['base_url'] = base_url("information/premise/");
							$config['total_rows'] = $this->InformationModel->countallpremise();
							//echo "<pre>"; print_r($config['total_rows']); echo "</pre>";
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
							
						$data['allbldadmin']	=	$this->InformationModel->selectdataprisme($config['per_page'],$page,$search);
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
						$seo['url']				=	site_url("Admin/testimonials");
						$seo['title']			=	"Premise on ".WEBSITENAME;
						$seo['metatitle']		=	"Premise on ".WEBSITENAME;
						$seo['metadescription']	=	"Premise on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/premise.tpl" ,$data ); 
				}
			
				
			public function visitorslog($page)
				{
					// visitorslogs.tpl
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
									$data['checklogin']		=	$checklogin;
									$config['base_url'] = base_url("information/visitorslog/");
									$config['total_rows'] = $this->AdminModel->countgetvisitor();
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
												
											$data['allgetvisitor']		=	$this->AdminModel->allgetvisitor($config['per_page'],$page,$search); 
											$config['use_page_numbers'] = 	TRUE;
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
						$seo['title']			=	"All Visitors";
						$seo['metatitle']		=	"All Visitors";
						$seo['metadescription']	=	"All Visitors";
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->bldAdminLayout($data);
							$this->load->view("front/visitors.tpl" ,$data ); 
				}
			
			
			public function testimonials()
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
								
								// for database
									
									$testiid = $this->input->post("testiid");
									$delete = $this->input->post("delete");
										if(!empty($testiid) && !empty($delete))
												{
													$this->db->where('id', $testiid);
														$this->db->delete('testimonials');
												}
									
									$title = $this->input->post("title");
									$description = $this->input->post("description");
										$submit = $this->input->post("submit");
											if(!empty($title) && !empty($description))
												{
													$insdata = array();
														$insdata['title'] = $title;
														$insdata['description'] = $description;
														$insdata['added'] = date("Y-m-d H:i:s");
														$insdata['ip'] 		=	get_client_ip();
													$this->InformationModel->insertdataontable("testimonials",$insdata);	
												}
									$data['alltestimonials']	=	$this->InformationModel->getdataoftable("testimonials");
								
								// for database
								
						$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("Admin/testimonials");
						$seo['title']			=	"Testimonials on ".WEBSITENAME;
						$seo['metatitle']		=	"Testimonials on ".WEBSITENAME;
						$seo['metadescription']	=	"Testimonials on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/testimonials.tpl" ,$data );
				}

			public function news()
				{ 
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
								
								// for database
									
									$testiid = $this->input->post("testiid");
									$delete = $this->input->post("delete");
										if(!empty($testiid) && !empty($delete))
												{
													$this->db->where('id', $testiid);
														$this->db->delete('news');
												}
									
									$title = $this->input->post("title");
									$description = $this->input->post("description");
										$submit = $this->input->post("submit");
											if(!empty($title) && !empty($submit))
												{
													$insdata = array();
														$insdata['title'] = $title;
														$insdata['description'] = $description;
														$insdata['added'] = date("Y-m-d H:i:s");
														$insdata['ip'] 		=	get_client_ip();
													$this->InformationModel->insertdataontable("news",$insdata);	
												}
									$data['alltestimonials']	=	$this->InformationModel->getdataoftable("news");
								
								// for database
								
						$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("Admin/news");
						$seo['title']			=	"NEWS on ".WEBSITENAME;
						$seo['metatitle']		=	"NEWS on ".WEBSITENAME;
						$seo['metadescription']	=	"NEWS on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/news.tpl" ,$data );
				}

			public function gallery()
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
								
									$imageid = $this->input->post("imageid");
									$filename = $this->input->post("filename");
									$delete = $this->input->post("delete");
										if(!empty($imageid) && !empty($delete))
												{
													$filename = str_replace("admin/","",$filename);
													$filename = FCPATH.$filename;
													if (file_exists($filename))
														{
															unlink($filename);
															 // echo "deleted";
														} else {
															// echo "deleted no";
														}
															$this->db->where('id', $imageid);
																$this->db->delete('gallery');
												}
									$title = $this->input->post("title");
										$submit = $this->input->post("submit");
											if(!empty($title) && !empty($submit))
												{
													
													$check = uploadimgfile("image",$folder="images",$prefix="gel_");
													
														if(isset($check['status']))
															{
																if($check['status']=="1")
																	{
																		$insdata = array();
																			$insdata['title'] 	=	$title;
																			$insdata['link'] 	=	"admin/".$check['data']['name'];
																			$insdata['orgname'] =	$check['data']['realname'];
																			$insdata['added'] 	=	date("Y-m-d H:i:s");
																			$insdata['ip'] 		=	get_client_ip();
																				$this->InformationModel->insertdataontable("gallery",$insdata);	
																	} else {
																		echo $check['message'];
																	}
															}
													
												}	
									
									
									
									$data['allgallery']	=	$this->InformationModel->getdataoftable("gallery");
						$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("Admin/gallery");
						$seo['title']			=	"Images on Gallery in ".WEBSITENAME;
						$seo['metatitle']		=	"Images on Gallery in ".WEBSITENAME;
						$seo['metadescription']	=	"Images on Gallery in ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/gallery.tpl" ,$data );
				}

			public function videos()
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
									$videoid = $this->input->post("videoid");
									$delete = $this->input->post("delete");
										if(!empty($videoid) && !empty($delete))
												{
													$this->db->where('id', $videoid);
														$this->db->delete('videos');
												}
									
									$ytlink = $this->input->post("ytlink");
										$submit = $this->input->post("submit");
											if(!empty($ytlink) && !empty($submit))
												{
													$insdata = array();
														$insdata['ytlink'] = $ytlink;
														$insdata['added'] = date("Y-m-d H:i:s");
														$insdata['ip'] 		=	get_client_ip();
													$this->InformationModel->insertdataontable("videos",$insdata);	
												}
									$data['allvideos']	=	$this->InformationModel->getdataoftable("videos");
						$data['checklogin']		=	$checklogin;
						$seo['url']				=	site_url("Admin/videos");
						$seo['title']			=	"Video on ".WEBSITENAME;
						$seo['metatitle']		=	"Video on ".WEBSITENAME;
						$seo['metadescription']	=	"Video on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/videos.tpl" ,$data );
				}

			public function notification($page)
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
						$config['base_url'] = base_url("information/notification/");
							$config['total_rows'] = $this->InformationModel->countallrow("tbl_notify");
							//echo "<pre>"; print_r($config['total_rows']); echo "</pre>";
							$config['per_page'] = 10;
							if(empty($page))
									{
										$page = 1;
									}
								$data['notification']	=	$this->InformationModel->getdataoftablelimit("tbl_notify",$config['per_page'],$page); 
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
						$seo['title']			=	"Notification received on ".WEBSITENAME;
						$seo['metatitle']		=	"Notification received on ".WEBSITENAME;
						$seo['metadescription']	=	"Notification received on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/notification.tpl" ,$data );
				}

			public function enquiry($page)
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
								
							$config['base_url'] = base_url("information/enquiry/");
							$config['total_rows'] = $this->InformationModel->countallrow("enquiry");
							$config['per_page'] = 9;
							if(empty($page))
									{
										$page = 1;
									}
						   $data['enquiry']	=	$this->InformationModel->getdataoftablelimit("enquiry",$config['per_page'],$page); 
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
						$seo['url']				=	site_url("Admin/contact");
						$seo['title']			=	"Enquiry request received on ".WEBSITENAME;
						$seo['metatitle']		=	"Enquiry request received on ".WEBSITENAME;
						$seo['metadescription']	=	"Enquiry request received on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/enquiry.tpl" ,$data );
				}
			
			public function contact($page)
				{
					$data = array();
					$seo  = array();
						$checklogin	=	$this->AdminModel->checkloggedin();
							if(!$checklogin)
								{
									redirect("information?token=invalid");	
								}
								
						$config['base_url'] = base_url("information/contact/");
							$config['total_rows'] = $this->InformationModel->countallrow("contactus");
							$config['per_page'] = 2;
							if(empty($page))
									{
										$page = 1;
									}
						   $data['allcontactus']	=	$this->InformationModel->getdataoftablelimit("contactus",$config['per_page'],$page); 
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
						$seo['url']				=	site_url("Admin/contact");
						$seo['title']			=	"Contact request received on ".WEBSITENAME;
						$seo['metatitle']		=	"Contact request received on ".WEBSITENAME;
						$seo['metadescription']	=	"Contact request received on ".WEBSITENAME;
							$data['data']['seo'] = $seo;
							$data['layout'] = $this->frontLayout($data);
							$this->load->view("front/contact.tpl" ,$data );
				}
			
			public function bldstatus()
				{
					echo $this->AdminModel->bldstatus();
				}
			
			public function logout()  
				{
					$this->session->sess_destroy();
					header("Location: ".base_url());
				}

		}		
?>