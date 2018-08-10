<?php
require_once "../vendor/autoload.php";

use thiagoalessio\TesseractOCR\TesseractOCR;
		
$ocrdata	=	 (new TesseractOCR($_GET['a']))->run();
	// $ocrdata = strtolower($ocrdata);
		echo "<pre>"; print_r($ocrdata); echo "</pre>";
		
		$ocrdataarray = explode("\n",$ocrdata);
		
		echo "<pre>"; print_r($ocrdataarray); echo "</pre>";
		
		
					if (strpos($ocrdata, 'drive') !== false || strpos($a, 'rto') !== false)
						{
							// echo 'true'; echo "driveing liacense";
						}
						
					if (strpos(strtolower($ocrdata), 'government of india') !== false)
						{
							
							if(!empty($ocrdataarray))
								{
									foreach($ocrdataarray as $single)
										{
											$single = trim($single);
												$single = str_replace(" ","",$single);
												
													$single = (int) filter_var($single, FILTER_SANITIZE_NUMBER_INT);
												
													if(strlen($single)==12 && is_numeric($single))
														{
															echo "<br/>Nu:".$single;
														}  // else { 	echo "<br/>not Nu:".$single; }
										}
								}
							
							// echo 'true'; echo "aashar cxa";
						}
		

?>