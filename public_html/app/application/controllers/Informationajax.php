<?php
		defined('BASEPATH') OR exit('No direct script access allowed');

	class Informationajax extends MY_Controller 
		{
			
			public function __construct()
				{
					parent::__construct();

						$this->load->helper(array('form','language','url'));
						$this->load->model('InformationModel');

							if(isset($_COOKIE['language']))
								{
									$this->lang->load($_COOKIE['language']."_landing" , $_COOKIE['language']);
								} else {
									$this->lang->load('english_landing' , 'english');
								}
				}
				
		}
		
?>