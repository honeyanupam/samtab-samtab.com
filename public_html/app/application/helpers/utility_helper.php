<?php 

/*
Description: Distance calculation from the latitude/longitude of 2 points
Author: Michaël Niessen (2014)
Website: http://AssemblySys.com
 
If you find this script useful, you can show your
appreciation by getting Michaël a cup of coffee ;)
PayPal: https://www.paypal.me/MichaelNiessen
 
As long as this notice (including author name and details) is included and
UNALTERED, this code can be freely used and distributed.
*/ 
 
function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Calculate the distance in degrees
	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
	switch($unit) {
		case 'mtr':
			$distance = ($degrees * 111.13384)*1000; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
			break;
		case 'km':
			$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
			break;
			
	}
	return round($distance, $decimals);
}

		function uploadimgfile2($index,$folder="images",$prefix="other")
			{
				
			}
		
		
		function uploadimgfile($index,$folder="images",$prefix="other")
			{
				$target_dir  = FCPATH;  // try to put full physical path
					// identity accstatement address advtimg other
						$uploadOk = 1;
							$senddata = array();
								$senddata['data'] = "NILL";
									$notallowed = array("php","js","css","html");  // defined here the extesion not to upload
									
									$shownotallowed = "PHP, JS, CSS, HTML fie is not allowed to upload.";
									
									$extension 		=	explode(".",basename($_FILES[$index]["name"]));
									
									$extension 		= 	end($extension);
									$realfilnename 	= 	basename($_FILES[$index]["name"]);
									$datetofolder 	= 	date("Y/M/d");
									$datetofolder 	= 	strtolower($datetofolder);
									$checkdirectory =	$target_dir."$folder/$datetofolder";
									
										if (!file_exists($checkdirectory))
											{
												mkdir($checkdirectory, 0777, true);
											}
													$filnename   = "$folder/$datetofolder/$prefix".md5(time().rand()).".$extension";
												$target_file = $target_dir . $filnename;
							
										if (in_array($extension, $notallowed))
											{
												$uploadOk = 0;
													$senddata['status']  = 0;
													$senddata['message'] = $shownotallowed;
												return $senddata;
											}
					// Check file size
								if ($_FILES[$index]["size"] > 10485760)
											{
												$uploadOk = 0;
													  $senddata['status']  = 0;
													  $senddata['message'] = "Maximum File Upload size is 10MB.";
												  return $senddata;
													// echo "Sorry, your file is too large.";
													// $uploadOk = 0;
											}
												 
												// Check if $uploadOk is set to 0 by an error
												if ($uploadOk == 0)
												 {
												  $senddata['status']  = 0;
												  $senddata['message'] = "<b>Sorry!</b> There was an error uploading your file.2";
												   return $senddata;
													// echo "Sorry, your file was not uploaded.";
												   // if everything is ok, try to upload file
												 } else {
												  if (move_uploaded_file($_FILES[$index]["tmp_name"], $target_file))
												   {
													// echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
													 $senddata['status']  = 1;
													  $tempdata = array();
													  $tempdata['name']   = $filnename;
													  $tempdata['realname']  = $realfilnename;
													 $senddata['data']  = $tempdata;
													 $senddata['message'] = "File Uploaded successfully.";
													  return $senddata;
												   } else {
													// echo "Sorry, there was an error uploading your file.";
													 $senddata['status']  = 0;
													 $senddata['message'] = "<b>Sorry!</b> There was an error uploading your file.";
													  return $senddata;
												   }
												 }
				}
				
				
						// Function to get the client IP address
					
				function get_client_ip()
					{
						$ipaddress = '';
							if (isset($_SERVER['HTTP_CLIENT_IP']))
								$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
							else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
								$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
							else if(isset($_SERVER['HTTP_X_FORWARDED']))
								$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
							else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
								$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
							else if(isset($_SERVER['HTTP_FORWARDED']))
								$ipaddress = $_SERVER['HTTP_FORWARDED'];
							else if(isset($_SERVER['REMOTE_ADDR']))
								$ipaddress = $_SERVER['REMOTE_ADDR'];
							else
								$ipaddress = 'UNKNOWN';
							return $ipaddress;
					}

	/* function langIn($msg=null)
		{
			$obj = &get_instance();
		
				if(isset($_COOKIE['language']))
					{
						$obj->lang->load($my_lang , $my_lang);
					} else {
						$obj->lang->load('english' , 'english');	
					}
						$newlang  = $obj->lang->line($msg);			
			return $newlang ;
		} */

	function showtime4db($date)
		{
			$date = strtotime($date);
				return date('d M, Y h:iA',$date); 	
		}
		
	function gettime4db()
		{
			return date('Y-m-d H:i:s'); 	
		}
		
	function isselected($value1,$value2)
		{
			if($value2==$value1)
				{
					echo "selected='selected'";	
				}
		}
	function ischecked($value1,$value2)
		{
			if($value2==$value1)
				{
					echo "checked='checked'";	
				}
		}
	function getrightobject($array,$index) 
		{
		  if(isset($array->$index))
			return $array->$index;
		  return "";
		}	
	 function file_get_contents_curl($url) 
		{
		  $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $url); 
			  curl_setopt($ch, CURLOPT_HEADER, 0); 
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');
					// for cookies
					  $amzcookie = "cookie/cookie.record";
					  // echo "***"; echo $amzcookie; echo "***";
						curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
						  curl_setopt($ch, CURLOPT_COOKIEJAR, FCPATH.$amzcookie);
							curl_setopt($ch, CURLOPT_COOKIEFILE, FCPATH.$amzcookie);
					// for cookies
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
				  $data = curl_exec($ch);
					curl_close($ch);
			return $data;
	   }

	function ip_details() 
     {
      $ip = get_client_ip();
      $ipfile = FCPATH."ip/$ip.ip";
        if(file_exists($ipfile) && isset($_COOKIE['myip']) && $_COOKIE['myip']==$ip)
          {
            //echo "local";
            $json       = file_get_contents($ipfile);
          } else {
            setcookie ( "myip", "$ip", time()+(7*24*60*60), "/");
            //echo "live";
              // $json       = file_get_contents_curl("http://ipinfo.io/{$ip}");
              $json       = file_get_contents_curl("http://ip-api.com/json/$ip");
                file_put_contents($ipfile,$json); // ipinfo.io
          }
            $details    = json_decode($json);
            
            $temp = $details;
            
              $details = array();
          
              $details['ip']    =  getrightobject($temp,"query");
              $details['city']  =  getrightobject($temp,"city");
              $details['region']  =  getrightobject($temp,"region");
              $details['country']  =  getrightobject($temp,"country");
              $details['org']    =  getrightobject($temp,"org");
              
                // $details = (object) $details;  
      return $details;
    }

// put notify
		function notification($title,$username,$bldid) 
			 {
				 $ci=& get_instance();
				$ci->load->database();
						  $ip_details = ip_details();
							$city     =  $ip_details['city'];
							$region   =   $ip_details['region'];
							$country   =  $ip_details['country'];
							$ip     =  $ip_details['ip'];
							$connection =  $ip_details['org'];
							   $insnot = array();  
									  $insnot['title']    =  $title;
									  $insnot['user_id']  =  $bldid;
									  $insnot['description']  =  "$username logged from <b><a href =  'https://whatismyipaddress.com/ip/$ip' target = '_blank'>$ip</a></b> using Connection: $connection from $city ($region) - $country";
									  $insnot['added']    =  gettime4db();
									  $ci->db->insert("tbl_notify",$insnot);
						 
						 // put notify	
			 }	
?>