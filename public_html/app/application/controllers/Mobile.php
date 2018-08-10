<?php date_default_timezone_set('asia/kolkata');

defined('BASEPATH') OR exit('No direct script access allowed');

	class Mobile extends MY_Controller 
		{

			public function __construct()
				{
					parent::__construct();
						$this->load->helper(array('form','language','url'));
						$this->load->model('MobileModel');
				}
				
			public function test1() 
				{
					$lat	=	"0.0";	
					if($lat=="0.0") $lat=0;
						if(empty($lat))
							{
								echo "safgjsakj";
							} else {
								echo "35436";
							}
				}
				
			public function test() 
				{
					$point1 = array("lat" => 21.2220999, "long" => 81.6540492); // building lat long
						$point2 = array("lat" =>  21.2221381, "long" => 81.6539461); // gatekeeper lat long
							$mtr = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long'], 'mtr'); // Calculate distance in metre 
							echo $mtr;
								if($mtr>100)
									{
											$data['status']		=	0;
											$data['message']	=	"You are out of the range of Building.";
										return json_encode($data);
									}	
				}
				
			public function imageocr() 
				{
					echo	$this->MobileModel->imageocr();
				}
				
			public function gklogin() 
				{
						echo  $this->MobileModel->dologin();
				}
				
			public function gklogout() 
				{
						echo  $this->MobileModel->gklogout();
				}
				
			public function getvisitor() 
				{
						echo  $this->MobileModel->getvisitor();
				}
				
			public function getallflat() 
				{
						echo  $this->MobileModel->getallflat();
				}
				
			public function getflat() 
				{
						echo  $this->MobileModel->getflat();
				}
				
			public function getvislogs() 
				{
					echo  $this->MobileModel->getvislogs();
				}
				
			public function verifygklogin() // for checking geo fancing , for checking activeness uisng building admin
				{
					echo  $this->MobileModel->verifygklogin();
				}

		}
?>