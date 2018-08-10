
<?php 
echo $url  = "http://api.idolondemand.com/1/api/sync/ocrdocument/v1?apikey=df285a0e-7181-4355-8d5c-416ef098d57a&url=http://www.samtab.com/OCR/115.jpg&mode=document_photo&languages=en"; 
		//  echo $url;
		  
		   $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, $url ); 
			  curl_setopt($ch, CURLOPT_HEADER, 0); 
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
				  $data = curl_exec($ch);
					curl_close($ch);
					$data = json_decode($data);
					echo "<pre>";
				print_r($data->text_block[0]->text); 
			echo "</pre>"; 
							
			 		
				
exit(0);			
ini_set('memory_limit', '-1'); 
require "vendor/autoload.php";
$qrcode = new Zxing\QrReader('115.jpg');
$text = $qrcode->text();
print_r($qrcode);
?> 
      