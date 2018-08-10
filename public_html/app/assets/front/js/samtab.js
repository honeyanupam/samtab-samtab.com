console.log(" I am Called... ");

	var base_url_value = $("#base_url_value").val();
	
	
	function gatekeeper()
		{
			var firstname		=	$("#firstname").val();
			var lastname		=	$("#lastname").val();
			var mobile			=	$("#mobile").val();
			var password		=	$("#password").val();
			var imagess			=	$("#image").val();
			
			
	if (mobile.length != 10)
        {
						
           showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","gatekeepermessage","gatekeeperform");
				$('#mobile').focus();
			return false;
        }
			
				$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'addgatekeeper', 
						data: {
							'firstname'		:	firstname,
							'lastname'		:	lastname,
							'mobile'		:	mobile,
							'imagess'		:	imagess,
							'password'		:	password
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"gatekeepermessage","gatekeeperform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","gatekeepermessage","gatekeeperform");
									}
							}
					});
			return false;
		}
	
		
	function GatekeeperStatus(status)
		{
				var statusid  =  $(status).attr('status-id');
				var gkid      =  $(status).attr('gk-id');
				if(statusid == 1)
				{
					$(status).removeClass('btn btn-success');
					$(status).addClass('btn btn-danger');
					$(status).html("Disabled");
					$(status).attr("status-id" , "0");
				}else{
					$(status).removeClass('btn btn-danger');
					$(status).addClass('btn btn-success');
					$(status).html("Enabled");
					$(status).attr("status-id" , "1");
				}
					$.ajax({
						type: "POST",  
						url: base_url_value+"BuildingAdmin/gatekeeperstatus", 
						data: {
							statusid:statusid,
							gkid 	:gkid
						},
						processdata:false,
						cache: false,
						success: function (tempdata) 
							{
								console.log(tempdata); 
							} 
					});  
				return false; 
	   }
	
	function resetmypassword()
		{
				var frg_email = $(".frg_email").val();
					$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'BuildingAdmin/resetmypassword',
						data: {
							'frg_email'		:	frg_email
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"adminmessage","resetmypasswordform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","adminmessage","resetmypasswordform");
									}
							}
					});
				return false;
		}
	
	function editgatekeeper()
		{
			var firstname		=	$("#firstname").val();
			var lastname		=	$("#lastname").val();
			var mobile			=	$("#mobile").val();
			var password		=	$("#password").val();
			var imagess			=	$("#image").val();
			var gkid			=	$("#gkid").val();
				
	if (mobile.length != 10)
        {
						
           showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","editgatekeepermessage","editgatekeeperform");
				$('#mobile').focus();
			return false;
        }
				$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'editgatekeeperdetails', 
						data: {
							'firstname'		:	firstname,
							'gkid'			:	gkid,
							'lastname'		:	lastname,
							'mobile'		:	mobile,
							'imagess'		:	imagess,
							'password'		:	password
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"editgatekeepermessage","editgatekeeperform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","editgatekeepermessage","editgatekeeperform");
									}
							}
					});
			return false;
		}
	
	function addflat()
		{
			var stayby		=	$("#stayby").val();
			var number		=	$("#number").val();
			var mobile		=	$("#mobile").val();
			var email		=	$("#email").val();
			var contact_2	=	$("#contact_2").val();
			var contact_3	=	$("#contact_3").val();
			if (mobile.length != 10)
				{
								
				   showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","addflatmessage","addflatform");
						$('#mobile').focus();
					return false;
				}
				
				$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'addflat', 
						data: {
							'stayby'		:	stayby,
							'mobile'		:	mobile,
							'number'		:	number,
							'email'			:	email,
							'contact_2'		:	contact_2,
							'contact_3'		:	contact_3
						},
						success: function(tempdata) 
							{
								console.log(tempdata.trim());
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"addflatmessage","addflatform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","addflatmessage","addflatform");
									}
							}
					}); 
			return false;
		}
	
	function flatStatus(status)
		{
				var statusid  =  $(status).attr('status-id');
				var fltid    =  $(status).attr('flat-id');
				if(statusid == 1)
				{
					$(status).removeClass('btn btn-success');
					$(status).addClass('btn btn-danger');
					$(status).html("Disabled");
					$(status).attr("status-id" , "0");
				}else{
					$(status).removeClass('btn btn-danger');
					$(status).addClass('btn btn-success');
					$(status).html("Enabled");
					$(status).attr("status-id" , "1");
				}
					$.ajax({
						type: "POST",  
						url: base_url_value+"BuildingAdmin/flatstatus",
						data: {
							statusid:statusid,
							fltid 	:fltid
						},
						processdata:false,
						cache: false,
						success: function (tempdata) 
							{
								console.log(tempdata); 
							} 
					});
				return false; 
	   }

	function editflat()
		{
			var stayby		=	$("#stayby").val();
			var email		=	$("#email").val();
			var number		=	$("#number").val();
			var mobile		=	$("#mobile").val();
			var contact_2	=	$("#contact_2").val();
			var contact_3	=	$("#contact_3").val();
			var fltid		=	$("#fltid").val();
			if (mobile.length != 10)
				{
								
				   showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","addflatmessage","addflatform");
						$('#mobile').focus();
					return false;
				}
				$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'editflatdetail', 
						data: {
							'stayby'		:	stayby,
							'fltid'			:	fltid,
							'mobile'		:	mobile,
							'email'			:	email,
							'number'		:	number,
							'contact_2'		:	contact_2,
							'contact_3'		:	contact_3
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"editflatmessage","editflatform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","editflatmessage","editflatform");
									}
							}
					});
			return false;
		}