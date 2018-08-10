console.log(" I am Called... ");
	var blankform = 1;
	function showresponse(showtype,showmessage,classname,formclassname,blankform)
		{
			$("."+classname).fadeIn("slow");
				$("."+classname).html(showmessage);
					if(showtype==1)
						{
							$("."+classname).addClass("alert-success");
							$("."+classname).removeClass("alert-danger");
								if(blankform==1)
									{
										$('.'+formclassname)[0].reset();
									}
						} else {
							$("."+classname).removeClass("alert-success");
							$("."+classname).addClass("alert-danger");
						}
							setTimeout(function(){
								$("."+classname).fadeOut("slow");
							},7000);
		}