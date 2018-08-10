<?php
		
		defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


			$route['m/remvislog']  		=	'Mobile/remvislog';
			$route['m/gklogin']  		=	'Mobile/gklogin';
			$route['m/gklogout']		=	'Mobile/gklogout';
			$route['m/getallflat'] 		=	'Mobile/getallflat';
			$route['m/getflat'] 		=	'Mobile/getflat';
			$route['m/getvisitors'] 	=	'Mobile/getvisitor'; 
			$route['m/getvislogs'] 		=	'Mobile/getvislogs'; 
			$route['m/verifygk'] 		=	'Mobile/verifygklogin'; 
			$route['m/imageocr'] 		=	'Mobile/imageocr'; 

$route['default_controller'] 	= 'BuildingAdmin';

$route['dobldlogin'] 						=	'BuildingAdmin/dobldlogin';
$route['addgatekeeper'] 					=	'BuildingAdmin/addgatekeeper';
$route['addflat'] 							=	'BuildingAdmin/addflat';
$route['editflatdetail']    				= 	'BuildingAdmin/editflatdetail';
$route['editgatekeeperdetails']    			= 	'BuildingAdmin/editgatekeeperdetails';
$route['building']              			= 	'BuildingAdmin/index';
$route['building/dashboard']   	 			= 	'BuildingAdmin/dashboard';
$route['building/settings']   	 			= 	'BuildingAdmin/settings';
$route['building/allflats']    				= 	'BuildingAdmin/allflats/0';
$route['building/editflat/(:any)']    		= 	'BuildingAdmin/editflat/$1';
$route['building/allflats/(:any)']    		= 	'BuildingAdmin/allflats/$1';
$route['building/allgatekeepers']   		= 	'BuildingAdmin/allgatekeepers/0';
$route['building/allgatekeepers/(:any)']   	= 	'BuildingAdmin/allgatekeepers/$1';
$route['building/activities']   	 		= 	'BuildingAdmin/activities';
$route['building/activities']   			= 	'BuildingAdmin/activities/0';
$route['building/activities/(:any)']   		= 	'BuildingAdmin/activities/$1';
$route['building/editgatekeeper/(:any)']   	= 	'BuildingAdmin/editgatekeeper/$1';
$route['building/visitors-logs']   			=	'BuildingAdmin/visitorslog/0';
$route['building/visitors-logs/(:any)']   	=	'BuildingAdmin/visitorslog/$1';
$route['building/visitorflat']   			=	'BuildingAdmin/visitorflat/$1/'; 
$route['building/visitorflat/(:any)']   	=	'BuildingAdmin/visitorflat/$1/1'; 
$route['building/visitorflat/(:any)/(:any)']=	'BuildingAdmin/visitorflat/$1/$2'; 
$route['building/flatdet']   				=	'BuildingAdmin/flatdet/$1/'; 
$route['building/flatdet/(:any)']   		=	'BuildingAdmin/flatdet/$1/1';
$route['building/flatdet/(:any)/(:any)']   	=	'BuildingAdmin/flatdet/$1/$2';
$route['information/notification']   		=	'Information/notification/0';
$route['information/notification/(:any)']   =	'Information/notification/$1';
$route['information/enquiry']   			=	'Information/enquiry/0';
$route['information/enquiry/(:any)']   		=	'Information/enquiry/$1';
$route['information/contact']   			=	'Information/contact/0';
$route['information/contact/(:any)']   		=	'Information/contact/$1'; 
$route['information/premise']   			=	'Information/premise/0';
$route['information/premise/(:any)']   		=	'Information/premise/$1';
$route['information/visitors']   		=	'Information/visitorslog/0';
$route['information/visitors/(:any)']   	=	'Information/visitorslog/$1';
$route['building/visitordetails/(:any)'] =	'BuildingAdmin/visitordetails/$1';

	$route['logout']              = 'Information/logout';
	
	$route['404_override'] = '';
	
	
		$route['translate_uri_dashes'] = FALSE;



?>