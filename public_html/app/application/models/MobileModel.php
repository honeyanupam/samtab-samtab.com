<?php require_once str_replace("app/","",FCPATH)."vendor/autoload.php"; 
	  use thiagoalessio\TesseractOCR\TesseractOCR;
	Class MobileModel extends CI_Model
		{
			
			
			public function checkpostinput($index) 
				{
						return $this->input->post($index);
				}
			
			public function imageocr()
				{ 
					// exit("aaaaaaaaaa");
					if(empty($_POST))
						{
							$data['status']		=	0;
							$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
							return json_encode($data);
						}
							$data = array();
								$sjaincode 	 =	SJAINCODE;
									$sjain 	 =	$this->checkpostinput('sjain');			
										if($sjain!=$sjaincode)
											{
												$data['status']		=	0;
												$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
													return json_encode($data);
											}

					$bldid 	 	=	$this->checkpostinput('bldid');
						$gkid 	 	=	$this->checkpostinput('gkid');
							$imgOcr  	=	$this->checkpostinput('imgOcr');
								$imageType  =	$this->checkpostinput('imageType');
								$allIdCardData  =	$this->checkpostinput('allIdCardData');
								
								$isvalid = 0;
								
									switch($imageType)
										{
											case "visitor":
												$isvalid 	=	1;
											break;
											case "idcard":
												$isvalid = 1;
											break;
											case "vehicle":
												$isvalid = 1;
											break;
										}
					  // for image conversion 
						if($isvalid)
							{
								$dir_path	=	FCPATH."images/";
									if($imgOcr != "0")
										{
											// INSERT INTO `images` (`img_id`, `absurl`, `type`, `bldid`, `gkid`, `added`) VALUES (NULL, '', '', '', '', CURRENT_TIMESTAMP);
											$img_url	=	date("Y/M/d/").$imageType."_".time().".jpg";
											$checkdirectory = $dir_path.date("Y/M/d/");
												if (!file_exists($checkdirectory))
													{
														mkdir($checkdirectory, 0777, true);
													}
														file_put_contents($dir_path.$img_url, base64_decode($imgOcr));
														
			$ocrdata = "";

			 
			// Qrcode reader with image
			$img_urlqr =  'https://www.samtab.com/app/images/'.$img_url; 
			$urlencode =  urlencode($img_urlqr);
			$urlimage  = "http://api.qrserver.com/v1/read-qr-code?fileurl=".$urlencode;
			// $urlimage  = "http://api.qrserver.com/v1/read-qr-code?fileurl=https://samtab.com/test/a.jpg";
			  
			
			 $ch = curl_init();   
			curl_setopt($ch, CURLOPT_URL, $urlimage ); 
			  curl_setopt($ch, CURLOPT_HEADER, 0); 
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
				  $data = curl_exec($ch);
					curl_close($ch);
					$data = json_decode($data);
					
						if(!empty($data[0]->symbol[0]->data) && isset($data[0]->symbol[0]->data)){
							$xml  = $data[0]->symbol[0]->data;
							$xml1 = str_replace('\n',' ',$xml);
							$xmlvalue =  $xml1;
						}else{  
							$xmlvalue = '0'; 
						}
			// Qrcode reader with image	
			$fileistoocr = $dir_path.$img_url;

				// $ocrdata =  (new TesseractOCR($fileistoocr))->lang('eng')->run();
				$ocrdata	=	(new TesseractOCR($fileistoocr))->lang('eng')->run();
				
				$vis_name = "";
				$vis_idnumber = "";
						
		$ocrdataarray = explode("\n",$ocrdata);
		
		// echo "<pre>"; print_r($ocrdataarray); echo "</pre>";
		
		$vis_idtype = ""; 
		
					if (strpos(strtolower($ocrdata), 'drive') !== false || strpos(strtolower($ocrdata), 'driving') !== false || strpos(strtolower($ocrdata), 'rto') !== false)
						{
							// echo 'true'; echo "driveing liacense";
						}
						
			// adhar card here			
					if (strpos(strtolower($ocrdata), 'government of india') !== false)
						{
							$vis_idtype = "AADHAR"; // "AADHAR"
							if(!empty($ocrdataarray))
								{
									
									$vis_name = isset($ocrdataarray[2])?$ocrdataarray[2]:"";
									$vis_name .= " ".isset($ocrdataarray[3])?$ocrdataarray[3]:"";
									$vis_name .= " ".isset($ocrdataarray[4])?$ocrdataarray[4]:"";
									foreach($ocrdataarray as $single)
										{	
											$single = trim($single);	
												$single = str_replace(" ","",$single);
													$single = (int) filter_var($single, FILTER_SANITIZE_NUMBER_INT);
														if(strlen($single)==12 && is_numeric($single))
															{
																$vis_idnumber = $single;
															}  // else { 	echo "<br/>not Nu:".$single; }
										}
								}
							
							// echo 'true'; echo "aashar cxa";
						}
			// adhar card here			
				
				

				/*
							
				$theuulris = base_url("finalocr.php?file=$fileistoocr");
					$theuulris = str_replace("app/","OCR/",$theuulris);
						$ocrdata = file_get_contents_curl($theuulris);
							// require_once str_replace("app/","ocr/",FCPATH)."finalocr.php";
				*/
				
												$instarray = array();
													$instarray['absurl']	=	$img_url;
													$instarray['ocrdata']	=	$ocrdata;
													$instarray['type'] 		=	$imageType;
													$instarray['bldid'] 	=	$bldid;
													$instarray['gkid'] 		=	$gkid;
													$instarray['xmlvalue']	=	$xmlvalue;
													$instarray['allIdCardData'] 	=	$allIdCardData;
													$instarray['added'] 	=	gettime4db();
													$instarray['ip'] 		=	get_client_ip();
														$this->db->insert("images",$instarray);
															$img_id = $this->db->insert_id();
												$sedndata = array();
												$sedndata[0]['type']	=	$imageType;	
												
												
														switch($imageType)
															{
																case "visitor":	
																	//$sedndata[0]['vehno']	=	"MP-22-MH-8765";	
																break;
																case "idcard":	
																	$sedndata[0]['vis_idtype']		=	$vis_idtype;	
																	$sedndata[0]['vis_idnumber']	=	$vis_idnumber;	
																	$sedndata[0]['vis_name']		=	$vis_name;	
																	$sedndata[0]['vis_address']		=	"";  
																	$sedndata[0]['vis_xml_value']	=	$xmlvalue; 	 
																break;
																case "vehicle":
																	$sedndata[0]['vehi_number']	=	$allIdCardData;	
																break;
															}
												 
												 
												$sedndata[0]['img_id']	    =	$img_id;	
													$data['status']			=	1;
													$data['message']		=	"Got the Images";
													$data['data']			=	$sedndata;
														return json_encode($data);
										} else {
											$img_url	=	"0";
										}
							}
										$data['status']		=	0;
										$data['message']	=	"All Fields are required.";
											return json_encode($data);
					  // for image conversion 
				}
				
			public function getimagefrombase64() 
				{
					
				}
				

			public function verifygklogin() 
				{
					if(empty($_POST))
						{
							$data['status']		=	0;
							$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
							return json_encode($data);
							// exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
							$data = array();

								$sjaincode 	 =	SJAINCODE;

									$sjain 	 =	$this->checkpostinput('sjain');

										if($sjain!=$sjaincode)
											{
												$data['status']		=	0;
												$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
												return json_encode($data);
											}

									$gkid 	 	=	$this->checkpostinput('gkid');
									$lati 	 	=	$this->checkpostinput('lati');
									$longi 	 	=	$this->checkpostinput('longi');
									$deviceid 	=	$this->checkpostinput('deviceid');

												
								// CHECK IF IT IS BLOCKED FROM PREMISE ADMIN
											$this->db->select('gatekeeper.*,buildings.*,gatekeeper.status as gkstatus');
												$this->db->from('gatekeeper');
													$this->db->join('buildings', 'buildings.bldid = gatekeeper.bldid');		
														$this->db->where('gatekeeper.gkid',$gkid);
															$query	=	$this->db->get();
																$result =	$query->result_array();
																// echo $this->db->last_query();
													if(empty($result))
															{
																$data['status']		=	0;
																$data['message']	=	"Oops! There is an error occured! Please login again.";
																return json_encode($data);
															}
													if(empty($gkid))
															{
																$data['status']		=	0;
																$data['message']	=	"Oops! There is an error occured! Please login again.";
																return json_encode($data);
															}

																$status 		= ($result[0]['gkstatus']); 
																$saveddeviceid 	= ($result[0]['deviceid']); 	
																$savedlati 		= ($result[0]['lati']); 	
																$savedlongi 	= ($result[0]['longi']); 	
																$radious 		= ($result[0]['radious']); 	
																$isgeo 			= ($result[0]['isgeo']); 	
													if($saveddeviceid!=$deviceid)
														{
																$data['status']		=	0;
																$data['message']	=	"Oops! There is an error occured! You are trying to login with new Device, Please ask Premise Admin to reset the Login.";
																return json_encode($data);
														}
																	if($status!="1")
																		{
																			$data['status']		=	0;
																			$data['message']	=	"You are not allowed to login, Please contact Building's Admin.";
																			return json_encode($data);
																		}
								// CHECK IF IT IS BLOCKED FROM PREMISE ADMIN
								
								// CHECK IF IT IS ON RADIOUS
								
								
									if($savedlati=="0.0") $savedlati=0;
										if($savedlongi=="0.0") $savedlongi=0;
								
								if( $lati!="0.0" && $longi!="0.0" && $savedlati!="0.0" && $savedlongi!="0.0" )
									{
										$point1 = array("lat" => $savedlati, "long" => $savedlongi); // building lat long
											$point2 = array("lat" =>  $lati, "long" => $longi); // gatekeeper lat long
												$mtr = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'], 'mtr'); // Calculate distance in metre 
												
													if($mtr>$radious && $isgeo)
														{
																$data['status']		=	0;
																$data['message']	=	"You are out of the range of Building.";
															return json_encode($data);
														}
									}
								
								// CHECK IF IT IS ON RADIOUS
				
						$data['status']		=	1;
						$data['message']	=	"You are allowed to login.";
						return json_encode($data);
												
				}

			public function getvislogs() 
				{
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
								
							$data = array();
								$sjaincode 	 =	SJAINCODE;
									$sjain 	 =	$this->checkpostinput('sjain');			
										if($sjain!=$sjaincode)
											{
												$data['status']		=	0;
												$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
												return json_encode($data);
											}
								$bldid 	 =	$this->checkpostinput('bldid');
										$this->db->select('images.absurl as photo ,b.absurl as photo_vehi,c.absurl as photo_id , visitors.name as visname , visitors.idnum as idnum, visitors.address as address , visitors.mobile as vismobile , flats.number as flatno , flats.stayby as stayby , flats.mobile as flatmobile , vislogs.added , vislogs.fltid');
											$this->db->from('vislogs');
												$this->db->join('visitors', 'visitors.visid = vislogs.visid');
													$this->db->join('flats', 'flats.fltid = vislogs.fltid');
													$this->db->join('images', 'images.img_id = visitors.photo_vis','left'); 
													$this->db->join('images b', 'b.img_id = visitors.photo_vehi','left'); 
													$this->db->join('images c', 'c.img_id = visitors.photo_id','left'); 
														$this->db->limit(500,0);
															$this->db->order_by("vislogs.added","DESC"); 
															$this->db->where("flats.bldid",$bldid); 
																$query	=	$this->db->get();
																	$result =	$query->result_array();
											if(!empty($result))
												{
													$data['status']		=	1;
														$data['message']	=	"We got the data.";
															$data['result']		=	$result;
													return json_encode($data);
												}		
															$data['status']		=	0;
															$data['message']	=	"There is no data.";
															return json_encode($data);							
				}

			public function deletevislog() // flats 
				{
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
							$data = array();
								$sjaincode 	 =	SJAINCODE;
								$sjain 	 =	$this->checkpostinput('sjain');			
									if($sjain!=$sjaincode)
										{
											$data['status']		=	0;
											$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
											return json_encode($data);
										}
						
					if(isset($_POST['insertid']))
						{
							$this->db->where('autoid', $_POST['insertid']);
								$this->db->delete('vislogs'); 					
						}
				}
				
			public function getflat() // flats 
				{
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
					$data = array();
						$data['insertid']	=	0;
						$sjaincode 	 =	SJAINCODE;
							$sjain 	 =	$this->checkpostinput('sjain');			
								if($sjain!=$sjaincode)
									{
										$data['status']		=	0;
										$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
										return json_encode($data);
									}
						$bldid 	 =	$this->checkpostinput('bldid');
						$number 	 =	$this->checkpostinput('number');
							if(empty($number))
								{
										$data['status']		=	0;
										$data['message']	=	"Please provide a valid Flat Number.";
										return json_encode($data);
								}
							$this->db->from('flats');
								$this->db->where('bldid',$bldid);
								$this->db->where('number',$number);
									$query	=	$this->db->get();
										$result =	$query->result_array();
											if(!empty($result))
												{
													$status 		= ($result[0]['status']); 
													$fltid 			= ($result[0]['fltid']); 
														if($status!="1")
															{
																$data['status']		=	0;
																$data['message']	=	"The Flat is not active, Please consult management to Confirm about Flat Status.";
																return json_encode($data);
															}
															
															
															// store the log to database 
																$visid 	 =	$this->checkpostinput('visid');	
																$gkid 	 =	$this->checkpostinput('gkid');	
																	$insarray = array();
																		$insarray['visid']  = $visid;
																		if(!empty($visid)) $insarray['fltid']  = $fltid;
																		if(!empty($gkid)) $insarray['gkid']  = $gkid;
																			$this->db->insert("vislogs",$insarray);
																			$insertid = $this->db->insert_id();
															// store the log to database 
															
																$this->db->select('flats.number as flatno , flats.stayby as stayby , flats.email as flatemail,buildings.name as buildingname, buildings.address as buildingaddress ');
																$this->db->from('flats');
																$this->db->join('buildings', 'buildings.bldid = flats.bldaid');
																$this->db->where("flats.fltid",$fltid); 
																$query1	=	$this->db->get();
																$result1 =	$query1->result_array();
																
																$this->db->select('visitors.name as visname , visitors.mobile as vismobile,images.absurl as visimage');
																$this->db->from('visitors');
																$this->db->join('images', 'images.img_id = visitors.photo_vis','left');
																$this->db->where("visitors.visid",$visid); 
																$query2	=	$this->db->get();
																$result2 =	$query2->result_array();
													
														$to 	   = $result1[0]['flatemail'];
														$stayby    = $result1[0]['stayby'];
														$visname   = $result2[0]['visname'];
														$vismobile = $result2[0]['vismobile'];
														$visimage  = $result2[0]['visimage'];
														$subject   = "$visname Visitor On Your Flat Number ".$result1[0]['flatno'];

													// Always set content-type when sending HTML email
														$headers = "MIME-Version: 1.0" . "\r\n";
														$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

													// More headers
														$headers .= 'From: <noreply@samtab.com>' . "\r\n";
													// $headers .= 'Cc: myboss@example.com' . "\r\n";
													
														$loginlink	=	base_url(); 
														$imageurl	=	base_url('images/').$visimage; 
													
														$message = "
																			Hi $stayby, 
																			<br/>
																			<br/>
																			<div style='line-height: 25px;'>
																			<img style='float:right;width: 130px;height: 120px;' src='$imageurl'>
																			 <b> Visitor Name:</b> $visname <br/>
																			 <b> Visitor Mobile Number:</b> $vismobile <br/>
																			 <b> Visit Flat:</b> ".$result1[0]['flatno']." <br/>
																			 <b> Visit Building Name:</b> ".$result1[0]['buildingname']." <br/>
																			 <b> Visit Building Address:</b> ".$result1[0]['buildingaddress']."  <br/> 
																			 <br/>
																			 </div>
																		";
													
														
														
														$emailtheme = file_get_contents_curl(base_url()."assets/email.theme");
														$message = str_replace("{{emailcontent}}",$message,$emailtheme); 
														if(!empty($to))
														mail($to,$subject,$message,$headers);	
															
															
															
																$data['status']		=	1;
																$data['message']	=	"Flat number: $number details.";
																$data['result']		=	$result;
																$data['insertid']	=	$insertid;
																return json_encode($data);
												}		
															$data['status']		=	0;
															$data['message']	=	"There is no Flat number: $number";
															return json_encode($data);
				}

			public function getallflat() // flats 
				{
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
					$data = array();
						$sjaincode 	 =	SJAINCODE;
							$sjain 	 =	$this->checkpostinput('sjain');			
								if($sjain!=$sjaincode)
									{
										$data['status']		=	0;
										$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
										return json_encode($data);
									}
						$bldid 	 =	$this->checkpostinput('bldid');
						
							$this->db->from('flats');
								$this->db->where('bldid',$bldid);
								$this->db->where('status',1);
									$query	=	$this->db->get();
										$result =	$query->result_array();
											if(!empty($result))
												{
													$status 		= ($result[0]['status']); 
													$fltid 			= ($result[0]['fltid']); 
																$data['status']		=	1;
																$data['message']	=	"All Flat details.";
																$data['result']		=	$result;
																return json_encode($data);
												}		
															$data['status']		=	0;
															$data['message']	=	"There is no Flats on Building ";
															return json_encode($data);
				}
			
			public function getvisitor() 
				{
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
							$data = array();
														
					$sjaincode 	 =	SJAINCODE;
						$sjain 	 =	$this->checkpostinput('sjain');			
							if($sjain!=$sjaincode)
								{
									$data['status']		=	0;
									$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
									return json_encode($data);
								}
								
						$mobile 	 =	$this->checkpostinput('mobile');
						
							if(empty($mobile))
								{
										$data['status']		=	0;
										$data['message']	=	"Please provide a valid Mobile Number.";
										return json_encode($data);
								}
								
				// visitor entry 
						$newvisitor 	 =	$this->checkpostinput('newvisitor');
							if(!empty($newvisitor) && $newvisitor=="1")
								{
									$this->db->from('visitors');
										$this->db->where('mobile',$mobile);
											$query	=	$this->db->get();
												$result =	$query->result_array();
													if(!empty($result))
														{
															$data['status']		=	0;
															$data['message']	=	"Mobile Number ($mobile) details is already with us.";
															$data['data']		=	$result;
															return json_encode($data);									
														}

										$insertdata = array();
											$insertdata['vistype']		=	$this->checkpostinput('visitortype');
											$insertdata['mobile']		=	$this->checkpostinput('mobile');
											$insertdata['gkid']			=	$this->checkpostinput('gate_keeper_id');
											$insertdata['name']			=	$this->checkpostinput('visitorName');
											$insertdata['address']		=	$this->checkpostinput('visitorAddress');
											$insertdata['country']		=	"India";
											$insertdata['idnum']		=	$this->checkpostinput('visitorIdProff');
											$insertdata['gkid']			=	$this->checkpostinput('visitorVehicleNumber');
											$photo_vis					=	$this->checkpostinput('photo_vis');
											$insertdata['photo_vis']	=	$photo_vis;
											$insertdata['photo_id']		=	$this->checkpostinput('photo_id'); 
											$insertdata['photo_vehi']	=	$this->checkpostinput('photo_vehi');
											$insertdata['added'] 		=	gettime4db();
											$insertdata['updated'] 		=	gettime4db();
											$insertdata['ip'] 			=	get_client_ip();
													$this->db->insert("visitors",$insertdata);													
								}						
				// visitor entry 				
								
								
							$this->db->select('visitors.*,images.absurl');
							$this->db->from('visitors');
								$this->db->where('mobile',$mobile);
								//	$this->db->join('user_email', 'user_email.user_id = emails.id', 'left');
									$this->db->join('images', 'images.img_id = visitors.photo_vis','left');
									$query	=	$this->db->get();
										$result =	$query->result_array();
											if(!empty($result))
												{
													$status 		= ($result[0]['status']); 
													$result[0]['photo_vis'] 		= isset($result[0]['absurl'])?$result[0]['absurl']:0;; 
														if($status!="1")
															{
																	$data['status']		=	0;
																	$data['message']	=	"The Visitor is not active, Please consult SamTab.";
																return json_encode($data);
															}
																	$data['status']		=	1;
																	$data['message']	=	"Visitor details is available on SamTab.";
																	$data['result']		=	$result;
																return json_encode($data);
												}		
															$data['status']		=	0;
															$data['message']	=	"Visitor details is not available on SamTab.";
															return json_encode($data);
				}
				
			public function gklogout() 
				{
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
					$sjaincode 	 =	SJAINCODE;
						$sjain 	 =	$this->checkpostinput('sjain');
							
							if($sjain!=$sjaincode)
								{
									$data['status']		=	0;
									$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
									return json_encode($data);
								}
								
									$mobile 	 =	$this->checkpostinput('mobile');
											$uarray = array();
												$uarray['lastip'] 		=	get_client_ip();
												$uarray['deviceid'] 	=	0;
						$this->db->where('mobile',$mobile);
								$this->db->update("gatekeeper",$uarray);
				}
				
			public function dologin() 
				{	
					if(empty($_POST))
						{
							exit("Unauthorized access, Please contact developer at contact@sjainventures.com"); 
						}
					$data = array();
							$sjaincode 	 =	SJAINCODE;
								$sjain 	 =	$this->checkpostinput('sjain');
											if($sjain!=$sjaincode)
												{
													$data['status']		=	0;
													$data['message']	=	"Unauthorized access, Please contact developer at contact@sjainventures.com";
													return json_encode($data);
												}
								
									$mobile 	 =	$this->checkpostinput('mobile');
										$password 	 =	$this->checkpostinput('password');
											$postdeviceid 	 =	$this->checkpostinput('deviceid');
												$devicename 	 =	$this->checkpostinput('devicename');
										
												if($mobile=="")
													{
														$data['status']		=	0;
														$data['message']	=	"Mobile number is required.";
														return json_encode($data);
													}
													
												if($password=='')
													{
														$data['status']		=	0;
														$data['message']	=	"password is required.";
														return json_encode($data); 
													}
													
												if(trim($mobile != "") && trim($password != ""))				
													{
															$password = md5($password);
															$this->db->select('gatekeeper.*,buildings.*,gatekeeper.status as gkstatus');
															$this->db->from('gatekeeper');
															$this->db->join('buildings', 'buildings.bldid = gatekeeper.bldid');
															//$this->db->from('');
															
															$this->db->where('mobile',$mobile);
															$this->db->where('password',$password);
															$query	=	$this->db->get();
															$result =	$query->result_array();

														if(!empty($result))
															{
																//$token 		= base64_encode($result[0]->userid); 
																$status 		= ($result[0]['gkstatus']); 
																$deviceid 		= ($result[0]['deviceid']); 
																
																
																	if($status!="1")
																		{
																			$data['status']		=	0;
																			$data['message']	=	"You are not allowed to login.";
																			return json_encode($data);
																		}
																		
																	$uarray = array();
																	
																		$uarray['lastlogin'] = gettime4db();
																		$uarray['lastip'] = get_client_ip();
																
																		if( $deviceid=="0" )
																			{
																						$uarray['deviceid'] = $postdeviceid;
																						$uarray['devicename'] = $devicename;
																				// $arraay  =  array("deviceid"=>$postdeviceid,""=>);    deviceid
																			} else {
																				if($deviceid!=$postdeviceid)
																					{
																						$devicename 		= ($result[0]['devicename']);
																						$data['status']		=	0;
																						$data['message']	=	"You are already logged in different Mobile or Tablet on $devicename.";
																						return json_encode($data);
																					}
																			}
																				$this->db->where('mobile',$mobile);
																					$this->db->where('password',$password);
																						$this->db->update("gatekeeper",$uarray);
																
																
																$lati 	 =	$this->checkpostinput('lati');
																$longi 	 =	$this->checkpostinput('longi');
																
																$gkdetails 	= $result;
																
																	if(isset($gkdetails[0]['lati']))
																		{
																			$oldlati = $gkdetails[0]['lati'];
																		}
																		
																	if(isset($gkdetails[0]['longi']))
																		{
																			$oldlongi = $gkdetails[0]['longi'];
																		}
																		
																	if(isset($gkdetails[0]['bldid']))
																		{
																			$bldid = $gkdetails[0]['bldid'];
																		}
																		
																			if($oldlati=="0.0") $oldlati=0;
																			if($oldlongi=="0.0") $oldlongi=0;
																		
																		if(!empty($oldlati) && !empty($oldlongi))
																			{
																			} else {	
																				if($lati=="0.0") $lati=0;
																					if($longi=="0.0") $longi=0;
																						$uarray = array();
																						$gkdetails[0]['lati'] = $uarray['lati'] = $lati;
																						$gkdetails[0]['longi'] = $uarray['longi'] = $longi;
																							$this->db->where('bldid',$bldid);
																								$this->db->update("buildings",$uarray);
																			}
																			
																				$uarray = array();
																					$uarray['a'] = $lati;
																					$uarray['b'] = $longi;
																						$this->db->where('bldid',$bldid);
																							$this->db->update("buildings",$uarray);
																
																$data['status']		=	1;
																$data['message']	= 	" Login Succesfully.";
																$data['result']	= 	$gkdetails;
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