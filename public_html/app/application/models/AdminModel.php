<?php

	Class AdminModel extends CI_Model
		{
	
			public function checkpostinput($index)
				{
						$return = $this->input->post($index);
						$return = $this->security->xss_clean($return);
					return trim($return); 
				}

			public function checkgetinput($index)
				{
						$return = $this->input->get($index);
						$return = $this->security->xss_clean($return);
					return trim($return); 
				}
	
			public function insertdataontable($table,$data)
				{
					$query	=	$this->db->insert($table,$data);
						return "Data inserted successfully.";
				}
				
			public function getdataoftable($table)
				{
					$this->db->select('*');
						$this->db->from($table);
							$query	=	$this->db->get();
								return $result =	$query->result_array();
				}
				
			public function getdataoftablewhereclose($table,$column,$id)
				{
						$this->db->select('*');
						$this->db->where($column,$id);
						$this->db->from($table);
							$query	=	$this->db->get();
								return $result =	$query->result();
				}
	
			public function getcountoftable($table,$for)
				{
					$this->db->select("count(`$for`) as trows");
						$this->db->from($table);
							$query	=	$this->db->get();
								$result =	$query->result_array();
									return $result[0]['trows']; 
				}
	
			public function checkloggedin()
				{
					if($this->session->userdata('token') && $this->session->userdata('username') && $this->session->userdata('email') && $this->session->userdata('logintype'))
						{
							$token			=	$this->session->userdata('token');
							$username		=	$this->session->userdata('username');
							$email			=	$this->session->userdata('email');
							$logintype		=	$this->session->userdata('logintype');
								if(trim($logintype)=="admin")
									{
										$temp = array();
											$temp['token']		=	base64_decode($token);
											$temp['username']	=	$username;
											$temp['email']		=	$email;
											$temp['logintype']	=	$logintype;
										return $temp;
									} else {
										return 0;
									}
						} else {
							return 0;
						}
				}
			
			public function adminlogin() 
				{	
					$data = array();
						$data['refresh'] = 0;
							$email 	   =  $this->checkpostinput('email');
							$password  =  $this->checkpostinput('password');
						
						if($email=="")
							{
								$data['status']		=	0;
								$data['message']	=	"email is not correct";
								return json_encode($data);
							}
						if($password=='')
							{
								$data['status']		=	0;
								$data['message']	=	"password is not correct";
								return json_encode($data); 
							}
						
									
						if(trim($email != "") && trim($password != ""))				
							{
									$password = md5($password);
									$this->db->select('*');
									$this->db->from('admin');
									$this->db->or_where('email',$email);
									$this->db->where('password',$password);
									$query	=	$this->db->get();
									$result =	$query->result();
									
										// echo $this->db->last_query();	 exit(0); 

								if(!empty($result))
									{
										$token 		= base64_encode($result[0]->admid); 
										$username 	= $result[0]->name;
										$email	 	= $result[0]->email;
										$logintype	= "admin"; 
											/* setting session data */
											$session = array(
																'email' 		=>	$email,
																'token' 		=>	$token,
																'username'		=>	$username,
																'logintype' 	=>	$logintype
															);
															//	print_r($session); exit(0);
												$this->session->set_userdata($session);
												$data['refresh']	=	1;
											/* setting session data */
										$data['status']		=	1;
										$data['message']	= 	" Login Succesfully.";
										return json_encode($data);
									} else {
										$data['status']		=	0;
										$data['message']	=	"Wrong Email or Password.";
										return json_encode($data);
									}
									
							} else {
									$data['status']		=	0;
									$data['message']	=	"Please check the entered details.";
								return json_encode($data);
							}
									$data['status']		=	0;
									$data['message']	=	"Something went Wrong.";
								return json_encode($data);
				}
				
			
			public function premisedata($token)
				{
					$data = array();
						if (strpos($token, '#') !== false) 
								{
									$token	=	explode("#",$token);
										$index = $token[0];
										$value = $token[1];
										
											$this->db->select('*');
											$this->db->from('bld_admin');
											$this->db->where($index,$value);
											$query=$this->db->get();
											$result = $query->result_array();
												
												if(empty($result))
													{
														$data['status']	=	0;
														$data['data']	=	"";
													} else {
														$data['status']	=	1;
														$data['data']	=	$result[0];	
													}
								} else {
									$data['status']	=	0;
									$data['data']	=	"";
								}
					return $data;			
				}
				
			
			
			public function addprimise() 
				{
				$data = array();
						$data['refresh'] = 0;
						
							$bldid 	   		=  $this->checkpostinput('bldid');
							$username 	   	=  $this->checkpostinput('username');
							$email		    =  $this->checkpostinput('email');
							$password		=  $this->checkpostinput('password');
							$mobile		    =  $this->checkpostinput('mobile');
							$buldingname	=  $this->checkpostinput('buldingname');
							$address 	    =  $this->checkpostinput('address');
							$radious 	    =  $this->checkpostinput('radious');
							$image  	    =  $this->checkpostinput('imagess');
							
						if($username=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Username";
								return json_encode($data);
							}
						
						if (!preg_match("/^[a-zA-Z ]*$/",$username))
							{
								$data['status']		=	0;
								$data['message']	=	"Only letters and white space allowed on Name.";
								return json_encode($data);
							} 
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Mobile Number";
								return json_encode($data);
							}
						if($email=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Email-ID";
								return json_encode($data);
							}
						if($password=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Password";
								return json_encode($data);
							}
						 if(!empty($image))
							{
								$image=$image;
							}else{
								$image = 0;
							}	
							
							 
						if(empty($bldid)){
						$checkpoint = $this->premisedata("email#$email");
							if($checkpoint['status']==1)
								{
										$data['status']		=	0;
										$data['message']	=	"<b>Already Registered!</b> Email $email already has an account in our portal.";
									return json_encode($data);
								} 
						}	
						if(trim($username != "") && trim($mobile != "") && trim($email != "") && trim($password != ""))				
							{
								$insertdatabuld['name']			=	$buldingname; 
								$insertdatabuld['address']		=	$address; 
								$insertdatabuld['lati']			=	0;
								$insertdatabuld['longi']		=	0; 
								$insertdatabuld['radious']		=	$radious;
								$insertdatabuld['status']		=	1;
								$insertdatabuld['added']		=	gettime4db();
								$password 						=	md5($password);
								$insertdata['name']				=	$username; 
								$insertdata['mobile']			=	$mobile;
								$insertdata['email']			=	$email;
								$insertdata['password']			=	$password;
								$insertdata['image']			=	$image; 
								$insertdata['lastlogin']		= 	gettime4db();
									if(empty($bldid))
											{
												$this->db->insert("buildings",$insertdatabuld);
												$bldinsertid = $this->db->insert_id();
												$insertdata['bldid'] =	$bldinsertid; 
												$this->db->insert("bld_admin",$insertdata);
												$data['refresh']	=	1;
												$data['status']		=	1;
												$data['message']	= 	"Added Succesfully!!!";
											} else {													
												$this->db->where('bldid',$bldid);
												$id=$this->db->update('buildings', $insertdatabuld);
												$this->db->where('bldid',$bldid);
												$this->db->update("bld_admin",$insertdata);
												$data['refresh']	=	1;
												$data['status']		=	1;
												$data['message']	= 	"Update Succesfully!!!";
											}
								return json_encode($data);
							}
				}
		

			public function allgetvisitorlogs($counter,$page) 
				{ $page--;
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					$this->db->select('visitors.photo_vis as photo , visitors.name as visname , visitors.mobile as vismobile , flats.number as flatno , flats.stayby as stayby , flats.mobile as flatmobile , vislogs.added , vislogs.fltid,vislogs.visid');
						$this->db->from('vislogs');
							$this->db->join('visitors', 'visitors.visid = vislogs.visid');
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								$this->db->where('flats.bldid', $bldid);
									$this->db->limit($counter,$page*$counter);
										$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();
						return $query->result();	
				}
						
			
			public function allgetvisitor($counter,$page,$search) 
				{ $page--;
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					$this->db->select('visitors.photo_vis as photo , visitors.name as visname , visitors.mobile as vismobile , visitors.added');
						$this->db->from('visitors');
						if(!empty($search))
										{
											$keyword = strtolower($search);
											$srhnewskeyword	=	" 
																	(
																		visitors.name like '%$keyword%'
																		OR 
																		visitors.mobile  like '%$keyword%'
																	)
																";
												$this->db->where($srhnewskeyword);
										}
							$this->db->join('images', 'images.img_id = visitors.photo_vis','left');
							$this->db->limit($counter,$page*$counter);
							$this->db->order_by("added","DESC"); 
							$query	=	$this->db->get();
						return $query->result();	
				}
			
			
			public function countgetvisitor() 
				{
				
					$this->db->select('count(visitors.added) as total');
						$this->db->from('visitors');
						$query	=	$this->db->get();											
						$result =	$query->result_array();	
						if(!empty($result))
								{
								return $result[0]['total'];
								}
							return 0;
											
				}			
						
		//Change password Admin Start
			public function changepassword()
				{
					$data = array();
					$data['refresh'] = 0;
					
					$token						=	$this->session->userdata('token');
					$admid  					= 	base64_decode($token);
					$currentpassword	 	  	=	$this->checkpostinput('currentpassword');
					$newpassword	 	  		=	$this->checkpostinput('newpassword');
					$confirmpassword	 	  	=	$this->checkpostinput('confirmpassword');
					
					if($newpassword != $confirmpassword){
						$data['status']		=	0;
						$data['message']	=	'No Match Found !!!';
						return json_encode($data);
						
					} elseif($currentpassword == $confirmpassword){
						
							$data['status']		=	0;
							$data['message']	=	'Old Password And New Password Are Same !!!';
							return json_encode($data);
							
					} else {
							if($currentpassword!="" && $newpassword!="" && $confirmpassword!="" && $admid!="" ) 
								{
									$this->db->select('*');
									$this->db->from('admin');
									$this->db->where('admid',$admid);
									$this->db->where('password',md5($currentpassword));
									$query=$this->db->get();
									$result = $query->result();
									if(!empty($result))
									{
										$values						=	array();
										$values['password']			=	md5($newpassword); 
										$this->db->where('admid', $admid); 
										$this->db->where('password', md5($currentpassword)); 
										$check = $this->db->update('admin', $values);
										//$sql = $this->db->last_query();
										$data['refresh']	=	0;
										$data['status']		=	1;
										$data['message']	=	"<b>Successfully !!</b> Update Your Password!";
									}else{
									$data['refresh']		=	0;
									$data['status']			=	0;
									$data['message']		=	"<b>Sorry !! </b>old password does not match. We are not able to update the password";
									}
									
									return json_encode($data); 	 
								
							 } else {
									$data['status']		=	0;
									$data['message']	=	"Something Wents Wrong !!! ";
									return json_encode($data);
							}
					}			  
									$data['status']		=	0;
									$data['message']	=	'Something Wents Wrong !!!';
									return json_encode($data);
				}
			//Change password Admin End	
			
			public function bldstatus()
				{ 	
					$data = array();
					$data['refresh']	=	0;	
					
					$statusid	=	$this->checkpostinput('statusid');
					$bldid		=	$this->checkpostinput('bldid');
						
						$data['status']		=	1;
					
						if($statusid == 1)
								{
									$this->db->where('bldid',$bldid);
									$id=$this->db->update('buildings', array('status'=>'0'));
									$data['message']	=	'Status update successfully';
									$data['refresh']	=	1;
								} else {
									$this->db->where('bldid',$bldid);
									$id=$this->db->update('buildings', array('status'=>'1'));
									$data['message']	=	'Status update successfully';
									$data['refresh']	=	1;
								}
					return json_encode($data);
				}
				
		}

?>