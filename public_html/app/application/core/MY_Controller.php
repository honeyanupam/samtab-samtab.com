<?php
		if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
		{ 
			//set the class variable.
			
				public $template  = array();
				public $data      = array();
		
			/*Loading the default libraries, helper, language */

				public function __construct()
					{
						parent::__construct();

						$this->load->helper(array('form','language','url'));
					}

		
			/*	Seller Page Layout*/

			public function bldAdminLayout( $data ) 
				{
					$this->template['header']   = $this->load->view('buildingadmin/includes/header.tpl',   $data , true);
					$this->template['footer']   = $this->load->view('buildingadmin/includes/footer.tpl',   $data , true);
				return $this->template ;
				}

			public function frontLayout( $data ) 
				{
					$this->template['header']   = $this->load->view('front/includes/header.tpl',   $data , true);
					$this->template['footer']   = $this->load->view('front/includes/footer.tpl',   $data , true);
				return $this->template ;
				}
			/*	front Layout */
			
			public function webLayout( $data ) 
				{
					$this->template['header']   = $this->load->view('webpage/include/header.tpl',   $data , true);
					$this->template['footer']   = $this->load->view('webpage/include/footer.tpl',   $data , true);
				return $this->template ;
				}
			/*	front Layout */

    }
?>