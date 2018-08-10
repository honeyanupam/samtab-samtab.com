<?php

/*
	function get_client_ip()
		{
			$ipaddress = '';
				if (getenv('HTTP_CLIENT_IP'))
					$ipaddress = getenv('HTTP_CLIENT_IP');
				else if(getenv('HTTP_X_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
				else if(getenv('HTTP_X_FORWARDED'))
					$ipaddress = getenv('HTTP_X_FORWARDED');
				else if(getenv('HTTP_FORWARDED_FOR'))
					$ipaddress = getenv('HTTP_FORWARDED_FOR');
				else if(getenv('HTTP_FORWARDED'))
				   $ipaddress = getenv('HTTP_FORWARDED');
				else if(getenv('REMOTE_ADDR'))
					$ipaddress = getenv('REMOTE_ADDR');
				else
					$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}
*/		


	Class InformationModel extends CI_Model
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
				
			public function getdataoftablelimit($table,$counter,$page)
				{
							$page--;	if($page<0) $page=0;
							$this->db->select('*');
							$this->db->from($table);
							$this->db->limit($counter,$page*$counter);  
							$this->db->order_by("added","DESC");
							$query	=	$this->db->get();
							$result =	$query->result_array();
								// echo $this->db->last_query();
							return $result;
				}
				
			public function countallrow($table) 
				{
					$this->db->select('count('.$table.'.added) as total');
						$this->db->from($table);
						$query	=	$this->db->get();											
						$result =	$query->result_array();	
						if(!empty($result))
								{
									return $result[0]['total'];
								}
						return 0;
											
				}
				
			public function countallrowwhereclouse($table,$column,$id,$added) 
				{
					$this->db->select('count('.$table.'.'.$added.') as total');
						$this->db->from($table);
						$this->db->where($column,$id);
						$query	=	$this->db->get();											
						$result =	$query->result_array();	
						if(!empty($result))
								{
									return $result[0]['total'];
								}
						return 0;
											
				}
				
			public function getdataoftablewhereclose($table,$column,$id)
				{
						$this->db->select('*');
						$this->db->where($column,$id);
						$this->db->from($table);
							$query	=	$this->db->get();
								return $result =	$query->result();
				}
				
			public function getactivities($table,$column,$id,$counter,$page)
				{
						$page--;	if($page<0) $page=0;
						$this->db->select('*');
						$this->db->where($column,$id);
						$this->db->from($table);
						$this->db->limit($counter,$page*$counter);  
						$this->db->order_by("added","DESC");
						$query	=	$this->db->get();
								return $result =	$query->result_array();
				}
	
			public function getcountoftable($table,$for)
				{
					$this->db->select("count(`$for`) as trows");
						$this->db->from($table);
							$query	=	$this->db->get();
								$result =	$query->result_array();
									return $result[0]['trows']; 
				}
			
			
			public function flatdata($token,$building)
				{
					$data = array();
						if (strpos($token, '#') !== false) 
								{
									$token	=	explode("#",$token);
										$index = $token[0];
										$value = $token[1];
										
									$building	=	explode("#",$building);
										$buildingindex = $building[0];
										$buildingvalue = $building[1];
										
											$this->db->select('*');
											$this->db->from('flats');
											$this->db->where($index,$value);
											$this->db->where($buildingindex,$buildingvalue);
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
			
			
			public function selectdataprisme($counter,$page,$search) 
				{ $page--;
					$this->db->select('*,buildings.name as buldingname');
					
					$this->db->select('buildings.bldid as bldid ,buildings.name as buldingname ,buildings.address as address , buildings.radious as radious , buildings.added as added , bld_admin.name as name , bld_admin.email as email , bld_admin.mobile as mobile,bld_admin.image as image, bld_admin.lastlogin as lastlogin'); 
						$this->db->from('bld_admin');
									if(!empty($search))
										{
											$keyword = strtolower($search);
											$srhnewskeyword	=	" 
																	(
																		buildings.name like '%$keyword%'
																		OR 
																		buildings.address  like '%$keyword%'
																		OR
																		bld_admin.name  like '%$keyword%'
																		OR
																		bld_admin.email like '%$keyword%'
																		OR
																		bld_admin.mobile like '%$keyword%'
																	)
																";
												$this->db->where($srhnewskeyword);
										}
							$this->db->join('buildings', 'bld_admin.bldid = buildings.bldid');
							$this->db->limit($counter,$page*$counter);  
										$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();
						return $query->result_array();	
				}
			
			public function selectsingledataprisme() 
				{ 
					$token			=	$this->session->userdata('token');
					$token			=	base64_decode($token);
					$this->db->select('buildings.bldid as bldid ,buildings.lati as lati,buildings.longi as longi ,buildings.name as buldingname ,buildings.address as address , buildings.radious as radious , buildings.added as added , bld_admin.name as name , bld_admin.image as image ,bld_admin.email as email , bld_admin.mobile as mobile, bld_admin.lastlogin as lastlogin');
						$this->db->from('bld_admin');
							$this->db->join('buildings', 'bld_admin.bldid = buildings.bldid');
							$this->db->where('bld_admin.bldid',$token);   
											$query	=	$this->db->get();
						return $query->result_array();	
				}
			
			public function checkloggedin()
				{
					if($this->session->userdata('token') && $this->session->userdata('username') && $this->session->userdata('logintype'))
						{
							$token			=	$this->session->userdata('token');
							$username		=	$this->session->userdata('username');
							$logintype		=	$this->session->userdata('logintype');
								if(trim($logintype)=="bldadmin")
									{
										$temp = array();
											$temp['token']		=	base64_decode($token);
											$temp['username']	=	$username;
											$temp['logintype']	=	$logintype;
										return $temp;
									} else {
										return 0;
									}
						} else {
							return 0;
						}
				}

			// Get All Flat SQL Start  
			   
	  
			public function countallflats() 
				{
					$token			=	$this->session->userdata('token');
					$token			=	base64_decode($token);
					$this->db->select('count(flats.added) as total');
						$this->db->from('flats');
						$this->db->where('flats.bldid',$token);
						$query	=	$this->db->get();											
						$result =	$query->result_array();	
						if(!empty($result))
								{
									return $result[0]['total'];
								}
						return 0;
											
				}
				
	  
			public function countallpremise() 
				{
					$token			=	$this->session->userdata('token');
					$token			=	base64_decode($token);
					$this->db->select('count(buildings.added) as total');
						$this->db->from('buildings');
						$query	=	$this->db->get();											
						$result =	$query->result_array();	
						if(!empty($result))
								{
									return $result[0]['total'];
								}
						return 0;
											
				}
				
			public function getallflats($counter,$page,$search) 
				{ $page--;
					
					$token			=	$this->session->userdata('token');
					$token			=	base64_decode($token);
					$this->db->select('flats.fltid as fltid , flats.email as email , flats.number as number , flats.contact_2 as contact_2 , flats.contact_3 as contact_3 , flats.status as status , flats.stayby as stayby , flats.mobile as mobile ,  flats.added');
						$this->db->from('flats');
						
									if(!empty($search))
										{
											$keyword = strtolower($search);
											$srhnewskeyword	=	"
																	(
																		flats.email like '%$keyword%'
																		OR 
																		flats.number  like '%$keyword%'
																		OR
																		flats.contact_2  like '%$keyword%'
																		OR
																		flats.contact_3 like '%$keyword%'
																		OR
																		flats.stayby like '%$keyword%'
																		OR
																		flats.mobile like '%$keyword%'
																	)
																";
												$this->db->where($srhnewskeyword);
										} 
							
						
							$this->db->where('flats.bldid',$token);
									$this->db->limit($counter,$page*$counter);
										$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get(); 
						return $query->result();	
				}
			 
			public function countvisitorflat($id)  
				{ 
					$this->db->select('count(vislogs.added) as total');
						$this->db->from('vislogs'); 
								$this->db->join('visitors', 'visitors.visid = vislogs.visid');						
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								$this->db->where('vislogs.visid',$id); 
								$query	=	$this->db->get();
								$result =	$query->result_array();	
								if(!empty($result))
										{
											return $result[0]['total'];
										}
								return 0;  
				} 
			
			public function visitorflat($id,$counter,$page)  
				{ $page--;
					$this->db->select('visitors.photo_vis as photo , visitors.name as visname , visitors.mobile as vismobile ,  vislogs.added as vislogsadded , vislogs.fltid ,flats.stayby as stayby, flats.number as flatnumber,vislogs.visid  ');
						$this->db->from('vislogs'); 
								$this->db->join('visitors', 'visitors.visid = vislogs.visid');						
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								$this->db->where('vislogs.visid',$id); 
								$this->db->limit($counter,$page*$counter); 								
								$this->db->order_by("vislogsadded","DESC"); 
								$query	=	$this->db->get();
						return $query->result();	  
				} 
				
			public function flatdetails($id,$counter,$page)  
				{ 
				$page--;
					$this->db->select('visitors.photo_vis as photo , visitors.name as visname , visitors.mobile as vismobile ,  vislogs.added as vislogsadded , vislogs.fltid,vislogs.visid ');
						$this->db->from('vislogs'); 
								$this->db->join('visitors', 'visitors.visid = vislogs.visid');						
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								$this->db->where('flats.fltid',$id);
								$this->db->limit($counter,$page*$counter); 
								$this->db->order_by("vislogsadded","DESC"); 
								$query	=	$this->db->get();
						return $query->result();	
				} 
				  
			public function flatdetailsbyId($id) 
				{
					$this->db->select('flats.number as number ,flats.fltid as flatis , flats.email as email, flats.contact_2 as contact_2 , flats.contact_3 as contact_3 , flats.stayby as stayby , flats.mobile as mobile, flats.added as added');
						$this->db->from('flats');  
									$this->db->where('flats.fltid',$id);
										$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();
						return $query->result();	  
				}
			
			
			public function uploadflatdata()
			{
				if(isset($_POST['submitcsv']))	
				{					
					$csv = array();

					// check there are no errors
					if($_FILES['csv']['error'] == 0){
						$name = $_FILES['csv']['name'];
						$ext = explode('.', $_FILES['csv']['name']);
						// print_r($ext[1]);
						// echo $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
						// exit();
						$type = $_FILES['csv']['type'];
						$tmpName = $_FILES['csv']['tmp_name'];
 
						// check the file is a csv
						if($ext[1] == 'csv'){
							if(($handle = fopen($tmpName, 'r')) !== FALSE) {
								// necessary if a large csv file
								set_time_limit(0);

								$row = 0;

								while(($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
									// number of fields in the csv
									$col_count = count($data);

									// get the values from the csv
									$csv[$row]['stayby'] 	= $data[0];
									$csv[$row]['email'] 	= $data[1];
									$csv[$row]['mobile'] 	= $data[2];
									$csv[$row]['number']    = $data[3];
									$csv[$row]['contact_2'] = $data[4];
									$csv[$row]['contact_3'] = $data[5];

									// inc the row 
									$row++;
								}
								$token			=  $this->session->userdata('token');
								$token			=  base64_decode($token);
								
								//$this->db->insert("flats",$csv);
								$resu = $this->getdataoftablewhereclose('buildings','bldid',$token);
								$building = $resu[0]->bldid;	
								$run = 0; 
								foreach($csv as $single){
										$run++;
									$number = $single['number'];
								$checkpoint = $this->flatdata("number#$number","bldaid#$building");
								if($checkpoint['status']==1)
									{
											$data['status']		=	0;
											$data['message']	=	"<b>Already Registered!! </b> $number Flat number in our portal.";
											return $data;
									}
										
								$insertdata['bldid']			=	$token;
								$insertdata['stayby']			=	$single['stayby']; 
								$insertdata['email']			=	$single['email'];
								$insertdata['mobile']			=	$single['mobile'];
								$insertdata['number']			=	$single['number'];
								$insertdata['contact_2']		=	$single['contact_2'];
								$insertdata['contact_3']		=	$single['contact_3'];
								$insertdata['status']			=	1;
								$insertdata['bldaid']			=	$resu[0]->bldid;
								$insertdata['added'] 			=	gettime4db();
								$insertdata['ip']				= 	get_client_ip();
									// if(strtolower(trim($single['stayby']))!="name")
											if($run!="1")
													$this->db->insert("flats",$insertdata); 
								}
								$data['refresh']	=	1;
								$data['status']		=	1;
								$data['message']	= 	"Upload CSV Data Insert Succesfully!!!"; 
								$username			=   $this->session->userdata('username'); 
									$title			=  "$username upload csv file for building flats.";
									$bldid			=  $token;
									notification($title,$username,$bldid);	 
								return $data;
								fclose($handle);
							}
						}else{
								$data['refresh']	=	0;
								$data['status']		=	0;
								$data['message']	= 	"Opps! Your File IS Not Correctly, Only Upload Csv Sample Format File!!!";
								return $data;
								
						}
					}
				
				}	 
			} 
			
			public function addflat() 
				{
				$data = array();
						$data['refresh'] = 0;
							$stayby 	   	=  $this->checkpostinput('stayby');
							$mobile		    =  $this->checkpostinput('mobile');
							$number		    =  $this->checkpostinput('number');
							$email		    =  $this->checkpostinput('email');
							$contact_2	    =  $this->checkpostinput('contact_2');
							$contact_3 	    =  $this->checkpostinput('contact_3');
							$token			=  $this->session->userdata('token');
							$token			=  base64_decode($token);
							
					if (!preg_match("/^[a-zA-Z ]*$/",$stayby))
							{
								$data['status']		=	0;
								$data['message']	=	"Only letters and white space allowed on Name.";
								return json_encode($data);
							} 
							
						if($stayby=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill First Name";
								return json_encode($data);
							}
							
							
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Mobile Number";
								return json_encode($data);
							}
						if($number=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Flat Number";
								return json_encode($data);
							}
							
						$resu = $this->getdataoftablewhereclose('buildings','bldid',$token);	
					    $building = $resu[0]->bldid;						
						$checkpoint = $this->flatdata("number#$number","bldaid#$building");
							if($checkpoint['status']==1)
								{
										$data['status']		=	0;
										$data['message']	=	"<b>Already Registered!</b> Flat number in our portal.";
									return json_encode($data);
								}
									
						if(trim($stayby) != "" && trim($mobile) != "" &&  trim($number) != "")				
							{
														
								$insertdata['bldid']			=	$token;
								$insertdata['stayby']			=	$stayby; 
								$insertdata['mobile']			=	$mobile;
								$insertdata['email']			=	$email; 
								$insertdata['number']			=	$number;
								$insertdata['contact_2']		=	$contact_2;
								$insertdata['contact_3']		=	$contact_3;
								$insertdata['status']			=	1;
								$insertdata['bldaid']			=	$resu[0]->bldid;
								$insertdata['added'] 			=	gettime4db();
								$insertdata['ip']				= 	get_client_ip();
								$this->db->insert("flats",$insertdata);
								$data['refresh']	=	1;
								$data['status']		=	1;
								$data['message']	= 	"Insert Succesfully!!!";
								$username		=  $this->session->userdata('username');
								$title			= "Add flat for $username";
								$bldid			= $token;
								notification($title,$username,$bldid);		
								return json_encode($data);
							}
							
							
								$data['refresh']	=	0;
								$data['status']		=	0;
								$data['message']	= 	"<b>Oops!</b> Something went wrong ";
								return json_encode($data);
							
				}
			
			
	public function resetmypassword()
		{
			$senddata = array();
					$senddata['status'] = 0;
					$senddata['message'] = "<b>Error!</b> Something went wrong, Please try again later.";
					
					
						if(isset($_POST['frg_email']))
							{
								$frg_email = $_POST['frg_email'];
							} else {
								return (json_encode($senddata));
							}
					
					if (!filter_var($frg_email, FILTER_VALIDATE_EMAIL))
						{
							// echo("$email is a valid email address");
							$senddata['message'] = "<b>Error!</b> Email <b>$frg_email</b> is not valid.";
							return (json_encode($senddata));
						}
						
						// send the email 
						
						
									$result	=	$this->getdataoftablewhereclose('bld_admin','email',$frg_email);
									
									
										if(count($result)>0)
											{
												$name = $result[0]->name;
												$bldaid = $result[0]->bldid;
												
																		
													// update on database
													
														$str = "";
															$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
															$max = count($characters) - 1;
															for ($i = 0; $i < 6; $i++) {
																$rand = mt_rand(0, $max);
																$str .= $characters[$rand];
															}
															$newpassword = $str;
													
														$uarray = array();
															$uarray['password'] = md5($newpassword);
														$this->db->where('bldaid',$bldaid);
														$this->db->update('bld_admin', $uarray);				
													// update on database
													
													$to = $frg_email;
													$subject = "Reset Password on samTab Premise Panel";

													// Always set content-type when sending HTML email
														$headers = "MIME-Version: 1.0" . "\r\n";
														$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

													// More headers
														$headers .= 'From: <noreply@sjainventures.com>' . "\r\n";
													// $headers .= 'Cc: myboss@example.com' . "\r\n";
													
														$loginlink	=	base_url(); 
													
														$message = "
																			Hi $name,
																			<br/>
																			<br/>
																			<div style='line-height: 30px;'>
																			 You have just made a request to reset your password. <br/>
																			 Your new password is <b><u> $str</u></b><br/>
																			 If it was not you who made this request, then please send an email to <a href='mailto:admin@samtab.com'>admin@samtab.com</a> 
																			 </div>
																			<br/>
																			Regards,
																			<br/><br/>
																			Admin
																			<br/>
																		";
													
														
														
														$emailtheme = file_get_contents_curl(base_url()."assets/email.theme");
														$senddata['status'] = 1;
														$senddata['message'] = "<b>Success!</b> We have sent you an email on <b>$frg_email</b> with Password. <script> $('.frg_email').val(''); </script> ";
														$message = str_replace("{{emailcontent}}",$message,$emailtheme); 
														mail($to,$subject,$message,$headers);						
											// send the email 
												
												
											} else {
												$senddata['message'] = "<b>Oops!</b> Email <b>$frg_email</b> is not registered with us.";
												return (json_encode($senddata));
											}
						
						
			return json_encode($senddata);
		}

			
			public function contactus() 
				{
						$data = array();
						$data['refresh'] = 0;
							$name		    =  $this->checkpostinput('name');
							$email	 	    =  $this->checkpostinput('email');
							$mobile			=  $this->checkpostinput('mobile');
							$message		=  $this->checkpostinput('message');
							
						if($name == "")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Enter Your Name";
								return json_encode($data);
							}
						
						if (!preg_match("/^[a-zA-Z ]*$/",$name))
							{
								$data['status']		=	0;
								$data['message']	=	"Only letters and white space allowed on Name.";
								return json_encode($data);
							} 
							
							
						if($email=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Your EmailID";
								return json_encode($data);
							}
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Mobile Number";
								return json_encode($data);
							}
							
						if($message=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Message";
								return json_encode($data);
							}
							
						
						if(trim($name) != "" && trim($mobile) != "" &&  trim($email) != "" &&  trim($message))				
							{
								$insertdata['name']				=	$name;
								$insertdata['email']			=	$email; 
								$insertdata['contactno']		=	$mobile;
								$insertdata['message']			=	$message;
								$insertdata['ip']				= 	get_client_ip();
								$insertdata['added'] 			=	gettime4db();
								$this->db->insert("contactus",$insertdata);
								$data['refresh']	=	1;
								$data['status']		=	1;
								$data['message']	= 	"Request Sent Succesfully!!!";
								$username			=   $name;
								$title				=	"$username is contact us request";
								$bldid				=   0;
								notification($title,$username,0);		
								return json_encode($data);
							}
							
							
								$data['refresh']	=	0;
								$data['status']		=	0;
									$data['message']	= 	"<b>Oops!</b> Something went wrong ";
								return json_encode($data);
							
				}
			
			public function enquiry() 
				{
						$data = array();
						$data['refresh'] = 0;
							$buildingname 	=  $this->checkpostinput('buildingname');
							$city		    =  $this->checkpostinput('city');
							$flat		    =  $this->checkpostinput('flat');
							$name		    =  $this->checkpostinput('name');
							$email	 	    =  $this->checkpostinput('email');
							$mobile			=  $this->checkpostinput('mobile');
							$additonalinfo	=  $this->checkpostinput('additonalinfo');
						if($buildingname=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Building Name / Apartment Complex";
								return json_encode($data);
							}
							
						if($city=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill City Name";
								return json_encode($data);
							}
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Mobile Number";
								return json_encode($data);
							}
						if($name=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Your Name";
								return json_encode($data);
							}
						if($email=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Your EmailID";
								return json_encode($data);
							}
							
						if(is_numeric($mobile) && (strlen($mobile == 10)))
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill correct mobile number";
								return json_encode($data);
							}
						
						if(trim($name) != "" && trim($mobile) != "" &&  trim($email) != "" &&  trim($buildingname) != "" &&  trim($city) != "")				
							{
								$insertdata['name']				=	$name;
								$insertdata['email']			=	$email; 
								$insertdata['mobile']			=	$mobile;
								$insertdata['buildingname']		=	$buildingname;
								$insertdata['city']				=	$city;
								$insertdata['additonalinfo']	=	$additonalinfo;
								$insertdata['added'] 			=	gettime4db();
								$insertdata['ip']				= 	get_client_ip();
								$this->db->insert("enquiry",$insertdata);
								$data['refresh']	=	1;
								$data['status']		=	1;
								$data['message']	= 	"Request Sent Succesfully!!!";
								$username			=   $name;
								$title				=	"$username is enquiry request";
								$bldid				=   0;
								notification($title,$username,0);		
								return json_encode($data);
							}
							
							
								$data['refresh']	=	0;
								$data['status']		=	0;
									$data['message']	= 	"<b>Oops!</b> Something went wrong ";
								return json_encode($data);
							
				}
			
			public function gatekeeperstatus()
				{ 	
					$data = array();
					$data['refresh']	=	0;	
					$statusid	=	$this->checkpostinput('statusid');
					$gkid		=	$this->checkpostinput('gkid');
						
						$data['status']		=	1;
					
						if($statusid == 1)
								{
									$this->db->where('gkid',$gkid);
									$id=$this->db->update('gatekeeper', array('status'=>'0'));
									$data['message']	=	'Status update successfully';
									$data['refresh']	=	1;
								} else {
									$this->db->where('gkid',$gkid);
									$id=$this->db->update('gatekeeper', array('status'=>'1'));
									$data['message']	=	'Status update successfully';
									$data['refresh']	=	1;
								}
									$username	=  $this->session->userdata('username');
									$token		=  $this->session->userdata('token');
									$token		=  base64_decode($token);
									$title		= "Gate keeper Status is update succesfully ";
									$bldid		= $token; 
									notification($title,$username,$bldid);	
					return json_encode($data);
				}
			
			
			public function flatstatus()
				{ 	
					$data = array();
					$data['refresh']	=	0;	
					$statusid	=	$this->checkpostinput('statusid');
					$fltid		=	$this->checkpostinput('fltid');
						
						$data['status']		=	1;
					
						if($statusid == 1)
								{
									$this->db->where('fltid',$fltid);
									$id=$this->db->update('flats', array('status'=>'0'));
									$data['message']	=	'Status update successfully';
									$data['refresh']	=	1;
								} else {
									$this->db->where('fltid',$fltid);
									$id=$this->db->update('flats', array('status'=>'1'));
									$data['message']	=	'Status update successfully';
									$data['refresh']	=	1;
								}
									$username	=  $this->session->userdata('username');
									$token		=  $this->session->userdata('token');
									$token		=  base64_decode($token);
									$title		= "Flat Status is update succesfully ";
									$bldid		= $token;
									notification($title,$username,$bldid);	
					return json_encode($data);
				}
			
			
			
			public function editflatdetail() 
				{
					
				$data = array();
						$data['refresh'] = 0;
							$stayby 	   	=  $this->checkpostinput('stayby');
							$mobile		    =  $this->checkpostinput('mobile');
							$number		    =  $this->checkpostinput('number');
							$email		    =  $this->checkpostinput('email');
							$contact_2	    =  $this->checkpostinput('contact_2');
							$contact_3 	    =  $this->checkpostinput('contact_3');
							$fltid			=  $this->checkpostinput('fltid');
							$token			=  $this->session->userdata('token');
							$token			=  base64_decode($token);
							
						if($stayby=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill First Name";
								return json_encode($data);
							}
							
						
						if (!preg_match("/^[a-zA-Z ]*$/",$stayby))
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
						if($number=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Flat Number";
								return json_encode($data);
							}
						$resu = $this->getdataoftablewhereclose('buildings','bldid',$token);	
					    $building = $resu[0]->bldid;						
						/* 	
						$checkpoint = $this->flatdata("number#$number","bldaid#$building");
							if($checkpoint['status']==1)
								{
										$data['status']		=	0;
										$data['message']	=	"<b>Already Registered!</b> Flat number in our portal.";
									return json_encode($data);
								} 	 */
								
						if(trim($stayby != "") && trim($mobile != "") && trim($fltid != ""))				
							{
								$insertdata['bldid']			=	$token;
								$insertdata['stayby']			=	$stayby; 
								$insertdata['email']			=	$email;
								$insertdata['mobile']			=	$mobile;
								$insertdata['number']			=	$number;
								$insertdata['contact_2']		=	$contact_2;
								$insertdata['contact_3']		=	$contact_3;
								$insertdata['status']			=	1;
								$insertdata['bldaid']			=	$building;
								$insertdata['added'] 			=	gettime4db();
								$insertdata['ip']				= 	get_client_ip();
								$this->db->where("fltid",$fltid);
								$this->db->update("flats",$insertdata);
								$data['refresh']	=	0;
								$data['status']		=	1;
								$data['message']	= 	"Edit Succesfully!!!";
								
									$username	=  $this->session->userdata('username');
									$title		= "Flat Number $number is update succesfully ";
									$bldid		= $token;
									notification($title,$username,$bldid);
								return json_encode($data);
							}
				}
				 
			// Get All Flat SQL END
	
			// Get Keeper SQL Start
	
			public function gatekeeperdata($token)
				{
					$data = array();
						if (strpos($token, '#') !== false) 
								{
									$token	=	explode("#",$token);
										$index = $token[0];
										$value = $token[1];
										
											$this->db->select('*');
											$this->db->from('gatekeeper');
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
			
			public function editgatekeeperdata($token,$gkid)
				{
					$data = array();
						if (strpos($token, '#') !== false) 
								{
									$token	=	explode("#",$token);
										$index = $token[0];
										$value = $token[1];
										
											$this->db->select('*');
											$this->db->from('gatekeeper');
											$this->db->where('mobile!=',$value);
											$this->db->where('gkid',$gkid);
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
			
			public function addgatekeeper() 
				{   
				$data = array();
						$data['refresh'] = 0;
							$firstname 	   =  $this->checkpostinput('firstname');
							$lastname	   =  $this->checkpostinput('lastname');
							$mobile		   =  $this->checkpostinput('mobile');
							$password  	   =  $this->checkpostinput('password');
							$image  	   =  $this->checkpostinput('imagess');
							$token		   =  $this->session->userdata('token');
							$token		   =  base64_decode($token);
						if($firstname=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill First Name";
								return json_encode($data);
							}
							
						if($lastname=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Last Name";
								return json_encode($data);
							}
						
						if(!preg_match("/^[a-zA-Z ]*$/",$firstname) || !preg_match("/^[a-zA-Z ]*$/",$lastname))
							{
								$data['status']		=	0;
								$data['message']	=	"Only letters and white space allowed on Name.";
								return json_encode($data);
							}	
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill mobile number";
								return json_encode($data);
							}
							
						if($password=='')
							{
								$data['status']		=	0;
								$data['message']	=	"password is not correct";
								return json_encode($data); 
							}
						 if(!empty($image))
							{
								$image=$image;
							}else{
								$image = 0;
							}
						$checkpoint = $this->gatekeeperdata("mobile#$mobile");
						if($checkpoint['status']==1)
							{
									$data['status']		=	0;
									$data['message']	=	"<b>Already Registered!</b> $mobile Gate Keeper in our portal.";
									return json_encode($data); 
							}	
						 
						if(trim($firstname != "") && trim($lastname != "") && trim($mobile != "") && trim($password != ""))				
							{
								$password 						=   md5($password);
								$insertdata['bldid']			=	$token;
								$insertdata['firstname']		=	$firstname;
								$insertdata['lastname']			=	$lastname; 
								$insertdata['mobile']			=	$mobile;
								$insertdata['password']			=	$password;
								$insertdata['status']			=	1;
								$insertdata['photo']			=	$image;
								$insertdata['added'] 			=	gettime4db();
								$insertdata['lastlogin'] 		=	gettime4db();
								$insertdata['password']			=	$password;
								$insertdata['lastip']			= 	get_client_ip();
								$insertdata['devicename']		= 	0;
								$insertdata['deviceid']			= 	0;
								$this->db->insert("gatekeeper",$insertdata);
								$data['refresh']	=	1;
								$data['status']		=	1;
								$data['message']	= 	"Insert Succesfully!!.";
								$username			=   $this->session->userdata('username');
								$title				=   "$firstname $lastname is Added Succesully ";
								$bldid				=    $token;
								notification($title,$username,$bldid);
								return json_encode($data);
							} 
				}
			
			public function editgatekeeperdetails() 
				{
				$data = array();
						$data['refresh'] = 0;
							$firstname 	   =  $this->checkpostinput('firstname');
							$lastname	   =  $this->checkpostinput('lastname');
							$mobile		   =  $this->checkpostinput('mobile');
							$password  	   =  $this->checkpostinput('password');
							$image  	   =  $this->checkpostinput('imagess');
							$gkid  	   	   =  $this->checkpostinput('gkid');
							$token		   =  $this->session->userdata('token');
							$token		   =  base64_decode($token);
							
						if($firstname=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill First Name";
								return json_encode($data);
							}
						if($lastname=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Last Name";
								return json_encode($data);
							}
								
							
					if (!preg_match("/^[a-zA-Z ]*$/",$firstname) || !preg_match("/^[a-zA-Z ]*$/",$lastname))
							{
								$data['status']		=	0;
								$data['message']	=	"Only letters and white space allowed on Name.";
								return json_encode($data);
							} 
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Last Name";
								return json_encode($data);
							}	
						if(!empty($image))
							{
								$image=$image;
							}else{
								$image = 0;
							}
							
						if($password=='')
							{
								$data['status']		=	0;
								$data['message']	=	"password is not correct";
								return json_encode($data); 
							}
						  
						$checkpoint = $this->editgatekeeperdata("mobile#$mobile",$gkid);      
						if($checkpoint['status']==1) 
							{
									$data['status']		=	0;
									$data['message']	=	"<b>Already Registered!</b> $mobile Gate Keeper in our portal.";
									return json_encode($data); 
							}
							  
						if(trim($firstname != "") && trim($lastname != "") && trim($mobile != "") && trim($password != ""))				
							{
								$password 						=   md5($password);
								$insertdata['bldid']			=	$token;
								$insertdata['firstname']		=	$firstname;
								$insertdata['lastname']			=	$lastname;
								$insertdata['mobile']			=	$mobile;
								$insertdata['password']			=	$password;
								$insertdata['status']			=	1;
								$insertdata['added'] 			=	gettime4db();
								$insertdata['lastlogin'] 		=	gettime4db();
								$insertdata['password']			=	$password;
								$insertdata['lastip']			= 	get_client_ip();
								$insertdata['devicename']		= 	0;
								$insertdata['deviceid']			= 	0;
								$insertdata['photo']			=	$image;
								$this->db->where("gkid",$gkid);
								$this->db->update("gatekeeper",$insertdata);
								$data['refresh']	=	1;
								$data['status']		=	1;
								$data['message']	= 	"Edit Succesfully!!.";
								$username			=   $this->session->userdata('username');
								$title				=   "$firstname $lastname is Edit Succesully ";
								$bldid				=    $token;
								notification($title,$username,$bldid);
								return json_encode($data); 
							}
				}
				
			public function countgatekeepers() 
				{
					$token			=	$this->session->userdata('token');
					$token			=	base64_decode($token);
					$this->db->select('count(gatekeeper.added) as total');
						$this->db->from('gatekeeper');
						$this->db->where('gatekeeper.bldid',$token);
						$query	=	$this->db->get();											
						$result =	$query->result_array();	
						if(!empty($result))
								{
									return $result[0]['total'];
								}
						return 0;
											
				}
				
			public function getgatekeepers($counter,$page,$search) 
				{ $page--;
					$token			=	$this->session->userdata('token');
					$token			=	base64_decode($token);
					$this->db->select('gatekeeper.gkid as gkid , gatekeeper.firstname as firstname , gatekeeper.lastname as lastname , gatekeeper.mobile as mobile , gatekeeper.status as status , gatekeeper.lastlogin as lastlogin , gatekeeper.added , gatekeeper.devicename, gatekeeper.deviceid, gatekeeper.photo');
						$this->db->from('gatekeeper');
									if(!empty($search))
										{
											$keyword = strtolower($search);
											$srhnewskeyword	=	" 
																	(
																		gatekeeper.firstname like '%$keyword%'
																		OR 
																		gatekeeper.lastname  like '%$keyword%'
																		OR
																		gatekeeper.mobile  like '%$keyword%'
																		OR
																		gatekeeper.devicename like '%$keyword%'
																		OR
																		gatekeeper.deviceid like '%$keyword%'
																	)
																";
												$this->db->where($srhnewskeyword);
										}
										
							$this->db->where('gatekeeper.bldid',$token);
									$this->db->limit($counter,$page*$counter);
										$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();
						return $query->result();	
				}
		// Get Keeper SQL END
	
	
		// Get Visitors SQL Start
	
				
			public function countvisitorlogs() 
				{
				
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					$this->db->select('count(vislogs.added) as total');
						$this->db->from('vislogs');
							$this->db->join('visitors', 'visitors.visid = vislogs.visid');
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
									//$this->db->limit($counter,$page*$counter);
										//$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();											
											$result =	$query->result_array();	
												if(!empty($result))
													{
														return $result[0]['total'];
													}
											return 0;
											
				}
				
			public function countvisitorlogs1($id) 
				{
				
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					$this->db->select('count(vislogs.added) as total');
						$this->db->from('vislogs');
							$this->db->join('visitors', 'visitors.visid = vislogs.visid');
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								$this->db->where('vislogs.fltid',$id);
									//$this->db->limit($counter,$page*$counter);
										//$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();											
											$result =	$query->result_array();	
												if(!empty($result))
													{
														return $result[0]['total'];
													}
											return 0;
											
				}
	
			public function getvisitorlogs($counter,$page,$search) 
				{ $page--;
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					$this->db->select('visitors.photo_vis as photo , visitors.name as visname , visitors.mobile as vismobile , flats.number as flatno , flats.stayby as stayby , flats.mobile as flatmobile , vislogs.added , vislogs.fltid,vislogs.visid');
						$this->db->from('vislogs');
							$this->db->join('visitors', 'visitors.visid = vislogs.visid');
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								if(!empty($search))
										{
											$keyword = strtolower($search);
											$srhnewskeyword	=	"
																	(
																		visitors.name like '%$keyword%'
																		OR 
																		visitors.mobile  like '%$keyword%'
																		OR
																		flats.number  like '%$keyword%'
																		OR
																		flats.stayby like '%$keyword%'
																		OR
																		flats.mobile like '%$keyword%'
																	)
																";
												$this->db->where($srhnewskeyword);
										} 
								$this->db->where('flats.bldid', $bldid);
									$this->db->limit($counter,$page*$counter);
										$this->db->order_by("added","DESC"); 
											$query	=	$this->db->get();
						return $query->result();	
				}
				
	// Get Visitors SQL End
	
	// Get Dashboard SQL Start
			public function latestvisitors($counter) 
				{
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					$this->db->select('visitors.photo_vis as photo , visitors.name as visname , visitors.mobile as vismobile , flats.number as flatno , flats.stayby as stayby , flats.mobile as flatmobile , vislogs.added , vislogs.fltid, vislogs.visid');
						$this->db->from('vislogs');
							$this->db->join('visitors', 'visitors.visid = vislogs.visid');
								$this->db->join('flats', 'flats.fltid = vislogs.fltid');
								$this->db->where('flats.bldid', $bldid); 
								$this->db->limit($counter,0);
								$this->db->order_by("added","DESC");   
								$query	=	$this->db->get();
						return $query->result();	
				}
	// Get Dashboard SQL End	


			public function updateprofile() 
				{
				$data = array();
						$data['refresh'] = 0;
						
							$username 	   	=  $this->checkpostinput('username');
							$mobile		    =  $this->checkpostinput('mobile');
							$buldingname	=  $this->checkpostinput('buldingname');
							$address 	    =  $this->checkpostinput('address');
							$images 	    =  $this->checkpostinput('images');
						if($username=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Username";
								return json_encode($data);
							}
							
						if($mobile=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill Mobile Number";
								return json_encode($data);
							}
						if($buldingname=="")
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill bulding name";
								return json_encode($data);
							}
						if(is_numeric($mobile) && (strlen($mobile == 10)))
							{
								$data['status']		=	0;
								$data['message']	=	"Please Fill correct mobile number";
								return json_encode($data);
							}
						 if(!empty($images))
							{
								$images=$images;
							}else{
								$images = 0;
							}	
								
						if(trim($username != "") && trim($mobile != "") && trim($buldingname != "") )				
							{
								$token			=	$this->session->userdata('token');
								$bldid  		= 	base64_decode($token);
								$insertdatabuld['name']				=	$buldingname; 
								$insertdatabuld['address']			=	$address;
								$insertdatabuld['added']			=	gettime4db();
								
								$insertdata['name']				=	$username; 
								$insertdata['image']			=	$images; 
								$insertdata['mobile']			=	$mobile;
								$this->db->where('bldid',$bldid);
								$id = $this->db->update('buildings', $insertdatabuld);
								$this->db->where('bldid',$bldid);
								$this->db->update("bld_admin",$insertdata);
								$data['refresh']	=	0;
								$data['status']		=	1;
								$data['message']	= 	"Update Profile Succesfully!!!";	
								$title= "update profile succesfully.";
								notification($title,$username,$bldid);
								return json_encode($data);
							}
				}
			
			public function resetlocation() 
				{
					if(isset($_POST['submit1'])){
								$data = array();
						
								$token			=	$this->session->userdata('token');
								$bldid  		= 	base64_decode($token);
								$insertdatabuld['lati']				=	0; 
								$insertdatabuld['longi']			=	0;
								$insertdatabuld['added']			=	gettime4db();
								$this->db->where('bldid',$bldid);
								$id = $this->db->update('buildings', $insertdatabuld);
								$data['refresh']	=	0;
								$data['status']		=	1;
								$data['message']	= 	"Reset Geo Location Succesfully";	
								$title= "Reset Geo Location.";
								$username			=   $this->session->userdata('username');
								notification($title,$username,$bldid);
								return json_encode($data);
					}	
						
				}
				
			public function resetdevicedetail() 
				{
					$token			=	$this->session->userdata('token');
					$bldid  		= 	base64_decode($token);
					if(isset($_POST['reset'])){
								$data = array();
						
								$gateid			=	$this->checkpostinput('gateid');
								$insertdatabuld['deviceid']				=	0; 
								$insertdatabuld['added']			=	gettime4db();
								$this->db->where('gkid',$gateid);
								$id = $this->db->update('gatekeeper', $insertdatabuld);
								$data['refresh']	=	0;
								$data['status']		=	1;
								$data['message']	= 	"Reset Device Details Succesfully";	
								$title= "Reset Device Details Succesfully.";
								$username			=   $this->session->userdata('username');
								notification($title,$username,$bldid);
								return json_encode($data);
					}	
						
				} 
			
			
		//Change password Admin Start
			public function changepassword()
				{
					$data = array();
					$data['refresh'] = 0;
					
					$token						=	$this->session->userdata('token');
					$bldid  					= 	base64_decode($token);
					$currentpassword	 	  	=	$this->checkpostinput('currentpassword');
					$newpassword	 	  		=	$this->checkpostinput('newpassword');
					$confirmpassword	 	  	=	$this->checkpostinput('confirmpassword');
					
					if($newpassword != $confirmpassword){
						$data['status']		=	0;
						$data['message']	=	'New Password And confirm Password Are not Match !!!';
						return json_encode($data);
						
					} elseif($currentpassword == $confirmpassword){
						
							$data['status']		=	0;
							$data['message']	=	'Old Password And New Password Are Same !!!';
							return json_encode($data);
							
					} else {
							if($currentpassword!="" && $newpassword!="" && $confirmpassword!="" && $bldid!="" ) 
								{
									$this->db->select('*');
									$this->db->from('bld_admin');
									$this->db->where('bldid',$bldid);
									$this->db->where('password',md5($currentpassword));
									$query=$this->db->get();
									$result = $query->result();
									if(!empty($result))
									{
										$values						=	array();
										$values['password']			=	md5($newpassword); 
										$this->db->where('bldid', $bldid); 
										$this->db->where('password', md5($currentpassword)); 
										$check = $this->db->update('bld_admin', $values);
										//$sql = $this->db->last_query();
										$data['refresh']	=	0;
										$data['status']		=	1;
										$data['message']	=	"<b>Successfully !!</b> Update Your Password!";
										$title				= "Update Your Password Succesfully.";
										$username			=   $this->session->userdata('username');
										notification($title,$username,$bldid);
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
			


	
			public function dologin() 
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
									$this->db->select('bld_admin.*,buildings.name as buildname,buildings.status as status');
									$this->db->from('bld_admin');
									$this->db->join('buildings', 'buildings.bldid = bld_admin.bldid');
									$this->db->group_start();
									$this->db->where('bld_admin.mobile',$email);
									$this->db->or_where('bld_admin.email',$email);
									$this->db->group_end();
									$this->db->where('bld_admin.password',$password);
									$query	=	$this->db->get();
									$result =	$query->result();
									 
 
								if(!empty($result))
									{
										if($result[0]->status!=1){
										$data['status']		=	0;
										$data['message']	=	"your account is disabled. please contact your system administrator";
										return json_encode($data);
									}
										$token 		= base64_encode($result[0]->bldaid); 
										$bldid 		= ($result[0]->bldid);  
										$username 	= $result[0]->buildname;
										$logintype	= "bldadmin"; 
											/* setting session data */
											$session = array(
																'bldid' 		=>	$bldid,
																'token' 		=>	$token,
																'username'		=>	$username,
																'logintype' 	=>	$logintype
															);
															//	print_r($session); exit(0);
												$this->session->set_userdata($session);
												$title= "$username Login to Portal.";
												$bldid= base64_decode($token);
												$bldid= $bldid;
												notification($title,$username,$bldid);
												
												
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
		}

?>