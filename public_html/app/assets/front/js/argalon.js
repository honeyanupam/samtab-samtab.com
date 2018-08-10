console.log(" I am Called... ");

	var base_url_value = $("#base_url_value").val();

	function loginme()
		{
			var email			=	$("#loginemail").val();
			var password		=	$("#loginpassword").val();
			var loginremember	=	0;
			
			
			if($("#loginremember").is(':checked'))
				{
					loginremember = 1;
				} else {
					loginremember = 0;
				}

			
					$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'dobldlogin', 
						data: {
							'password'		:	password,
							'loginremember'	:	loginremember,
							'email'			:	email
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"adminmessage","adminloginform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","adminmessage","adminloginform");
									}
							}
					});
			return false;
		}
	
	function enquiry()
		{
			var buildingname	=	$("#buildingname").val();
			var city			=	$("#city").val();
			var flat			=	$("#flat").val();
			var name			=	$("#name").val();
			var email			=	$("#email").val();
			var mobile			=	$("#mobile").val();
			var additonalinfo	=	$("#additonalinformation").val();

	if (mobile.length != 10)
        {
						
           showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","enquirymessage","enquiryform");
				$('#mobile').focus();
			return false;
        }
			
					$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'front/enquiry', 
						data: {
							'buildingname'	:	buildingname,
							'city'			:	city,
							'flat'			:	flat,
							'name'			:	name,
							'email'		    :	email,
							'mobile'		:	mobile,
							'additonalinfo'	:	additonalinfo
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"enquirymessage","enquiryform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","enquirymessage","enquiryform");
									}
							} 
					});
			return false;
		}
		 
	function contactus() 
		{
			var name			=	$("#name").val();
			var email			=	$("#email").val();
			var mobile			=	$("#mobile").val();
			var message			=	$("#message").val();

	if (mobile.length != 10)
        {
						
           showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","contactusmessage","contactusform");
				$('#mobile').focus();
			return false;
        }  
			
					$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'front/contactus', 
						data: {
							'name'			:	name,
							'email'			:	email,
							'mobile'		:	mobile,
							'message'		:	message
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"contactusmessage","contactusform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","contactusmessage","contactusform");
									}
							} 
					});
			return false;
		}