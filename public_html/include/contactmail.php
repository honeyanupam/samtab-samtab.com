<?php ob_start(); session_start(); echo "<br/>";

  $fromemail = "noreply@www.incredibledigitalconnection.com";
 
  $sub = 'Contact Request from Incredible Digital Connection';
  
  $sendto="devendra@sjainventures.com";
  

// Function to get the client IP address
function get_client_ip() {
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


	if(isset($_POST['email']))
	{
	    
	    $code = $_SESSION['code'];
	    
	    $name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['contact'];
		$msg = $_POST['msg'];
		$captcha = $_POST['captcha'];
		
		$get_client_ip	=	get_client_ip();
		$http_referer 	=	$_SERVER['HTTP_REFERER'];
		
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		    {
		       $emailErr = "<div class='alert alert-danger'><b>Oops!</b> Please enter the correct email, <b style='color:#cc0000;'>$email</b> is not valid. </div>";
		       exit($emailErr);
	        }
		
		    if($captcha==$code)
		            {
                		 $headers  = "From: ".$fromemail."\r\n";
                		 $headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
                		 $headers .= "MIME-Version: 1.0 ";
                		 $msg1  = '<table>';
                		 $msg1 .=    '<tr><td><b>Name:</b> </td><td> '.$name.'</td></tr>';
                		 $msg1 .=    '<tr><td><b>Email:</b> </td><td> '.$email.'</td></tr>';
                		 $msg1 .=    '<tr><td><b>Mobile:</b> </td><td> '.$phone.'</td></tr>';
                		 $msg1 .=    '<tr><td><b>Message:</b> </td><td> '.$msg.'</td></tr>';
                		 $msg1 .=    '<tr><td><b>From IP:</b> </td><td> <a href="https://ipinfo.io/'.$get_client_ip.'"> '.$get_client_ip.' </a> </td></tr>';
                		 $msg1 .=    '<tr><td><b>From Page:</b> </td><td> '.$http_referer.'</td></tr>';
                		 $msg1 .= '</table>';
                		 
                		 
                		    $newcode = $_SESSION['code'] = rand(11111,99999);
                		 
                		    echo "<script> $('.sendcontactfrm input').val('');  $('.sendcontactfrm textarea').val('');  $('.captchaimg').attr('src','/include/captcha.php?version=".time()."');   </script>";
                		    
                		 mail($sendto,$sub,$msg1,$headers );
                		
                		
                		// if(mail("rahulitjec@gmail.com",$sub,$msg1,$headers )) { echo "yes"; } else { echo "no"; }
                		
                	        exit("<div class='alert alert-success'><b>Thanks!</b> Your request received. </div>");
		            } else {
		                exit("<div class='alert alert-danger'><b>Oops!</b> Please enter the correct code to send your request. </div>");
		            }
		
	//	header("Location: index.php");
		//exit();

	} else {
	    exit("<div class='alert alert-danger'><b>Oops!</b> There is problem sending your request, please try again later. </div>");
	}
?>



<?php exit(0);
	if(isset($_POST['submit2'])=='Send')
	{
		$headers  = "From: ".$_POST['email']."\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1 \r\n";
		$headers .= "MIME-Version: 1.0 ";
		$msg1  = '<table width="100%" border="0" cellspacing="2" cellpadding="2">';
		$msg1 .=    '<tr><td align="left" valign="top" colspan="3" width="15%"><b>Name:</b> '.$_POST['name'].'</td></tr>';
		$msg1 .=    '<tr><td align="left" valign="top" colspan="3" width="15%"><b>Email:</b> '.$_POST['email'].'</td></tr>';
		$msg1 .=    '<tr><td align="left" valign="top" colspan="3" width="55%"><b>Message:</b> '.$_POST['message'].'</td></tr>';
		$msg1 .= '</table>';
		$sub = 'Contact Request form Sjain Ventures Website';
		//$ret = mail('navneet@dmsinfosystem.com', $sub, $msg1, $headers);
		$ret = mail('contact@sjainventures.com, info@shreyansh.info, amit@sjainventures.com', $sub, $msg1, $headers);
		header("Location: ../thanks.php");
		exit();

	}
?>
