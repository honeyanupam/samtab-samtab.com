a<?php

		  $urlencode =  urlencode("https://samtab.com/test/a.jpg");

			$url  = "http://api.qrserver.com/v1/read-qr-code/?fileurl=".$urlencode;
			$url  = "https://api.qrserver.com/v1/read-qr-code/?fileurl=https%3A%2F%2Fsamtab.com%2Ftest%2Fa.jpg";
		//  echo $url;
		  
		  
		  
		  
		  echo $xmlvalue = '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<PrintLetterBarcodeData uid=\"323146447434\" name=\"Anupam Shukla\" gender=\"M\" yob=\"1993\" co=\"S\/O: Anil Kumar Shukla\" street=\"new city colony\" lm=\"near park\" loc=\"ward no 2\" vtc=\"Guna\" po=\"Guna\" dist=\"Guna\" subdist=\"Guna\" state=\"Madhya Pradesh\" pc=\"473001\"\/>';
		  
		  $xmlvalue = str_replace('\"','"',$xmlvalue);
			
		  
		  // error_reporting(0);
		  
		  $xmlvalue = new SimpleXMLElement($xmlvalue);
		  
			echo "<pre>";
				print_r($xmlvalue);
			echo "</pre>";
			print_r($xmlvalue);
			exit(0);
		  
		  
		  exit(0);
		  
			// file_get_contents($url); exit(0);
		  
		  
		  $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $url ); 
			  curl_setopt($ch, CURLOPT_HEADER, 0); 
				//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1');
					// for cookies
					  //$amzcookie = "a.record";
						//curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
						 // curl_setopt($ch, CURLOPT_COOKIEJAR, $amzcookie);
							//curl_setopt($ch, CURLOPT_COOKIEFILE, $amzcookie);
					// for cookies
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
				  $data = curl_exec($ch);
					curl_close($ch);
					
						$data = json_decode($data);
						
							echo "<pre>";
								print_r($data);
							echo "</pre>";
							
		  


?>