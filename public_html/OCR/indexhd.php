<img src='img/<?php echo $_GET['a'];?>' width='100px' height='100px' style='width:20%; height:40%'; />
<br/> 
<?php
	 
require_once "../vendor/autoload.php";

use thiagoalessio\TesseractOCR\TesseractOCR;
		
$ocrdata	=	 (new TesseractOCR('img/'.$_GET['a']))->run();
//echo "<pre>"; print_r($ocrdata); echo "</pre>";
$ocrdataarray = explode("\n",$ocrdata);
		
		echo "<pre>"; print_r($ocrdataarray); echo "</pre>";
		
		if(!empty($ocrdataarray))
		{
		foreach($ocrdataarray as $single)
			{
				$single = trim($single);
					$single = str_replace(" ","",$single);
					
						$single = (int) filter_var($single, FILTER_SANITIZE_NUMBER_INT);
					
						if(strlen($single)==12 && is_numeric($single))
							{
								echo "<br/>Adhaar Card:".$single;
							}
						
			}if($single==''){
				echo $val= '<b>your image is not captured correctly,</b>';
			echo '<br/>';
			echo '<b>Please Try Again</b>';
			exit(0);
			}
		}
		 
				
		

?>