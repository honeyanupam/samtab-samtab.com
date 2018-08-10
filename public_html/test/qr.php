<?php
 function Parse($url) {
        $fileContents= file_get_contents($url);
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);

        return $json;
    }
	function XMLToArrayFlat($xml, &$return, $path='', $root=false) 
{ 
    $children = array(); 
    if ($xml instanceof SimpleXMLElement) { 
        $children = $xml->children(); 
        if ($root){ // we're at root 
            $path .= '/'.$xml->getName(); 
        } 
    } 
    if ( count($children) == 0 ){ 
        $return[$path] = (string)$xml; 
        return; 
    } 
    $seen=array(); 
    foreach ($children as $child => $value) { 
        $childname = ($child instanceof SimpleXMLElement)?$child->getName():$child; 
        if ( !isset($seen[$childname])){ 
            $seen[$childname]=0; 
        } 
        $seen[$childname]++; 
        XMLToArrayFlat($value, $return, $path.'/'.$child.'['.$seen[$childname].']'); 
    } 
} 

	
		  $urlencode =  urlencode("https://samtab.com/test/e.jpg");

			$url  = "http://api.qrserver.com/v1/read-qr-code/?fileurl=".$urlencode;
			$url  = "https://api.qrserver.com/v1/read-qr-code/?fileurl=https%3A%2F%2Fsamtab.com%2Ftest%2Fe.jpg";
	
			$xmlvalue = '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<PrintLetterBarcodeData uid=\"323146447434\" name=\"Anupam Shukla\" gender=\"M\" yob=\"1993\" co=\"S\/O: Anil Kumar Shukla\" street=\"new city colony\" lm=\"near park\" loc=\"ward no 2\" vtc=\"Guna\" po=\"Guna\" dist=\"Guna\" subdist=\"Guna\" state=\"Madhya Pradesh\" pc=\"473001\"\/>';
			
			 $xmlvalue =  htmlentities( $xmlvalue );
			  $xmlvalue2 = str_replace('\n',' ',$xmlvalue);
			  $xmlvalue3 = str_replace('\"',"'",$xmlvalue2);
				//print_r($xmlvalue2); 
				echo "<pre>";
				print_r($xmlvalue2);
			echo "</pre>";  		
				echo "<pre>";
				print_r($xmlvalue3);
			echo "</pre>";  				
			
			$xml = simplexml_load_string($xmlvalue); 
			$xmlarray = array(); // this will hold the flattened data 
			$valu = XMLToArrayFlat($xml, $xmlarray, '', true); 
			print_r($valu);  
			exit(0); 
			$xml = Parse($xmlvalue);
		   	 $xmlvalue2 =  simplexml_load_string( $xmlvalue ); 
				$json = json_encode($xml);
					$array = json_decode($json,TRUE);  
			
			
	 	//echo "<pre>"; 
		//echo "</pre>";  
		  $xmlvalue = new SimpleXMLElement($xmlvalue);
		   $xmlvalue =  simplexml_load_string( $xmlvalue );
		  exit(0);
	
		 	echo "<pre>";
				print_r($xmlvalue2);
			echo "</pre>";  
			echo "<pre>";
					print_r($xmlvalue);
			echo "</pre>";  
			$data = json_decode($xmlvalue1);
			exit(0);
						
							echo "<pre>";
								print_r($data);
							echo "</pre>xxxxxxxxxxxxxxx";		 			
		  exit(0);
		 $xmlvalue = new SimpleXMLElement($xmlvalue);
		  
		  
		  echo $xmlvalue = '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<PrintLetterBarcodeData uid=\"323146447434\" name=\"Anupam Shukla\" gender=\"M\" yob=\"1993\" co=\"S\/O: Anil Kumar Shukla\" street=\"new city colony\" lm=\"near park\" loc=\"ward no 2\" vtc=\"Guna\" po=\"Guna\" dist=\"Guna\" subdist=\"Guna\" state=\"Madhya Pradesh\" pc=\"473001\"\/>';
		  
			print_r($xmlvalue);
		  $xmlvalue = str_replace('\"','"',$xmlvalue);
			
		  
		  // error_reporting(0);
		  
		  $xmlvalue = new SimpleXMLElement($xmlvalue);
		  
			echo "<pre>";
				print_r($xmlvalue);
			echo "</pre>";
		  
		  
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