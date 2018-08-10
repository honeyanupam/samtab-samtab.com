console.log(" I am Called... ");

	var base_url_value = $("#base_url_value").val();

	function adminlogin()
		{
			var email			=	$("#email").val();
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
						url: base_url_value+'admin/adminlogin', 
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
										showresponse(values.status,values.message,"adminloginmessage","adminform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","adminloginmessage","adminform");
									}
							}
					});
			return false;
		}

	
	function editbuladmin(bldid,username,mobile,email,buldingname,address,radious,image)
			{
				
				$('.addprimiseform').show();
				$('#bldid').val(bldid);	 
				$('#username').val(username);	
				$('#mobile').val(mobile);	
				$('#email').val(email);	
				$('#buldingname').val(buldingname);	
				$('#address').val(address);	
				$('#radious').val(radious);	
				$('#image').val(image);	
			}
	
	
	
	function addprimise() 
		{
			var username		=	$("#username").val();
			var email			=	$("#email").val();
			var password		=	$("#password").val();
			var mobile			=	$("#mobile").val(); 
			var buldingname		=	$("#buldingname").val();
			var address			=	$("#address").val();
			var radious			=	$("#radious").val();
			var bldid			=	$("#bldid").val(); 
			var imagess			=	$("#image").val();			
			if (mobile.length != 10)
				{
					showresponse(0,"<b>Error!</b> Phone number must be 10 digits.","addprimisemessage","primiseform");
						$('#mobile').focus();
					return false;
				}      
			$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'admin/addprimise', 
						data: {
							'bldid'			:	bldid,
							'username'		:	username,
							'email'			:	email,
							'password'		:	password,
							'mobile'		:	mobile,
							'imagess'		:	imagess,
							'buldingname'	:	buldingname,
							'radious'		:	radious,
							'address'		:	address
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"addprimisemessage","primiseform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","addprimisemessage","primiseform");
									}
							}
					});
			return false;
		}
		
	function updateprofile() 
		{
			var username		=	$("#username").val();
			var mobile			=	$("#mobile").val();
			var buldingname		=	$("#buldingname").val();
			var address			=	$("#address").val();
			var imagess			=	$("#image").val();
			
			$.ajax({
						type: "POST",
						async: true,
						url: base_url_value+'BuildingAdmin/updateprofile', 
						data: {
							'username'		:	username,
							'mobile'		:	mobile,
							'buldingname'	:	buldingname,
							'images'		:	imagess,
							'address'		:	address
						},
						success: function(tempdata) 
							{
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"updateprofilemessage","updateprofileform");
											if(values.refresh==1)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","updateprofilemessage","updateprofileform");
									}
							}
					});
			return false;
		}
		
				
	function changepassword_form_submit()
		{
			var currentpassword			=	$("#password").val();
			var newpassword				=	$("#newpassword").val();
			var confirmpassword			=	$("#confirmpassword").val();
					$.ajax({ 
						type: "POST",
						async: true,
						url: base_url_value+'BuildingAdmin/changepassword', 
						data: {
							'currentpassword' 	 		: currentpassword,
							'newpassword'		 	 	: newpassword,
							'confirmpassword'		 	: confirmpassword
						},
						success: function(tempdata) 
							{
								$(".loadingme").fadeOut("slow");
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"updateprofilepassmessage","changepassword_form_submit");
											if(values.refresh)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","updateprofilepassmessage","changepassword_form_submit"); 
									} 
							}
					});
			return false;
		}	
				
	function adminchangepassword()
		{
			var currentpassword			=	$("#password").val();
			var newpassword				=	$("#newpassword").val();
			var confirmpassword			=	$("#confirmpassword").val();
					$.ajax({ 
						type: "POST",
						async: true,
						url: base_url_value+'Admin/changepassword', 
						data: {
							'currentpassword' 	 		: currentpassword,
							'newpassword'		 	 	: newpassword,
							'confirmpassword'		 	: confirmpassword
						},
						success: function(tempdata) 
							{
								$(".loadingme").fadeOut("slow");
								if (tempdata.trim() != '') 
									{
										var values = JSON.parse(tempdata);
										showresponse(values.status,values.message,"adminchangepasswordpassmessage","adminchangepasswordform");
											if(values.refresh)
												{
													window.location.reload();
												}
									} else {
										showresponse(0,"Something went wrong, Please try again later.","adminchangepasswordpassmessage","adminchangepasswordform"); 
									} 
							}
					});
			return false;
		}	
			
	function bldStatus(status)
		{
				var statusid  =  $(status).attr('status-id');
				var bldid     =  $(status).attr('bld-id');
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
						url: base_url_value+"Information/bldstatus",
						data: {
							statusid:statusid,
							bldid 	:bldid
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
	   
	   function uploadme() 
		{
			var formData = new FormData();
				formData.append( 'files' , 1);
					formData.append( 'userfile'  , jQuery('.userfiles')[0].files[0]);
						jQuery.ajax({
							   url 	: base_url_value+'uploads/index.php?files=1',
							   type : 'POST',
							   data : formData,
							   processData: false,  // tell jQuery not to process the data
							   contentType: false,  // tell jQuery not to set contentType
							   success : function(data) 
									{
										if (data.trim() != '') 
											{
												var values = JSON.parse(data);
													if(values.response) 
														{
															jQuery("fileresponse").html("<div class='text-success'>Images uploaded.</div>");
															jQuery(".sweetimageval").val("uploads/uploads/"+values.data);
														} else {
															jQuery("fileresponse").html("<div class='text-danger'>"+values.message+"</div>");
														}
											} else {
												jQuery("fileresponse").html("<div class='text-danger'>There was an error uploading your files.</div>");
											}
									}
						});
		}
		