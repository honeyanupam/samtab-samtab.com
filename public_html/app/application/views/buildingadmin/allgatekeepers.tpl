<?php
		echo	$layout['header'];
?> 
	
	<section class="post-wrapper-top jt-shadow clearfix">
		<div class="container">
			<div class="col-lg-12">
				<h2><?php echo $data['seo']['title']; ?></h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                    <li><?php echo $data['seo']['title']; ?></li>
                </ul>
			</div>
		</div>
	</section><!-- end post-wrapper-top -->
	<section class="post-wrapper jt-shadow clearfix">
		
		
		
		<div class="container">
		<br/>
					<br/>
					<div class="col-sm-10">
						<form method='GET' action="<?php echo base_url('building/allgatekeepers');?>">
						<div class='col-sm-2'></div>
						<div class='col-sm-8'>
							<input type="text" name='searchkeyword' id="searchkeyword" placeholder="Search Gatekeepers..." class='form-control'>
						</div>	
						<div class='col-sm-1'>
							<button type="submit" class='btn btn-primary btn-lg'> Search </button>
						</div>	
						</form>	
					</div>
					
					<div class="pull-right">
						<a onclick="$('.gatekeepertoggle').toggle();" class="btn btn-info">Add Gate Keeper</a>
					</div>
							<div style="clear:both;"></div>
						

        	<div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px;">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
							<div class="doc row">								
								
								
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gatekeepertoggle" style="display:none;">
											
											 <div class="row">
												<form method="POST" class="gatekeeperform" onsubmit="return gatekeeper();">
												<div class="col-md-6">
												<div class="title">
																				<h3> Add a New Gate Keeper </h3>
																			</div>
																			<div class="group_timer">																				
																					<table class="table">
																						<tr>
																							<td>
																								<b> First Name: </b>
																							</td>
																							<td>
																							<input required type="text" name="firstname" id="firstname" class="form-control" Placeholder="Enter First Name" />
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>last Name:</b>
																							</td>
																							<td>
																								<input required type="text" name="lastname" id="lastname" class="form-control" Placeholder="Enter Last Name" />
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Gatekeeper Image :</b>
																							</td>
																							<td>
																		<div class="form-group">
																			<div class="input-group">
																			<!--input type="file" name="category_img" id="category_img"  accept="image/*" --> 
																			<a class="btn alert-info" onclick="jQuery('.userfiles').trigger('click');" style="display:block;"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image </a>
																			<fileresponse style="display:block;"></fileresponse>
																			<input type="hidden" class="sweetimageval" name="image" id="image">
																			<input style="display:none;" onchange="uploadme();" type="file" id='regionimg' name="userfile" size="20" class="form-control userfiles" />  
																			</div>
																	   </div>
																							</td>
																						</tr>
																					</table>
													</div>
												
												</div>
												<div class="col-md-6">
												<div class="title">					
														<h3>Login Details</h3>
															</div>					
																	<div class="group_timer">																							
																					<table class="table">
																						<tr>
																							<td>
																								<b> Mobile Number: </b>
																							</td> 
																							<td>
																								<input required type="number" name="mobile" id="mobile" class="form-control" Placeholder="Enter Mobile Number" />
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Password:</b>
																							</td>
																							<td>
																								<input required type="text" name="password" id="password" class="form-control" Placeholder="Enter Password" />
																							</td>
																						</tr>
																					</table>
																				
																			</div><!-- end group_times -->
												</div>
												<div class="col-md-12">
													<p class="lead alert hideme gatekeepermessage form-group"></p> 
														<div class="form-group">
															<input type="submit" name="submit" class="btn btn-success" value="Save" />
														</div>
													</div>
													</form>
													<div style="clear:both;"></div>
											 </div>


											
																		
																	</div>
								
								
								
								<?php
										if(empty($getgatekeepers))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no gate keepers log yet.
														</div>
												<?php
											} else {
												?>
												
												<?php
													foreach($getgatekeepers as $single)
														{
															$gkid = $single->gkid;
															 
															?>
															
															
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																	
																		<div class="group_box first"> 
																				
																			<div class="group_img">
																			<?php 
																				if(!empty($single->photo)){
																					$images = base_url($single->photo); 
																				}else{
																					$images  = base_url("images/default.png");  
																				} 
																				
																			?>
																			<img src="<?php echo $images; ?>" alt="<?php echo $single->firstname; ?>" class="img-circle img-responsive" style="max-width:90px; margin: 0px auto;" >
																				
																			</div><!-- end group_img -->
																			
																			<div style='clear:both;'></div>	
																					
																			<div class="title">
																				<h3>Gate Keeper</h3>
																			</div>
																			   <div class='pull-right'>
																					<a class='btn btn-success' title='<?php echo $single->firstname; ?> <?php echo $single->lastname; ?>' href='<?php echo site_url("building/editgatekeeper/$gkid"); ?>'><i class='fa fa-edit' style='padding-right: 0px;'></i></a>
																				</div> 
																			<div class="group_timer">
																				<table class="table">
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<?php echo $single->firstname; ?> <?php echo $single->lastname; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Mobile:</b>
																							</td>
																							<td>
																								<?php echo $single->mobile; ?>
																							</td>
																						</tr>
																				<tr>
																							<td>
																								<b>Status:</b>
																							</td>		
																						<?php 
																				if($single->status =='1'){ 
																					$class_css	= "btn btn-success";
																					$status 	= 'Enabled';
																					} else {
																					$class_css	= "btn btn-danger";  
																					$status		= 'Disabled';
																				}
																				?>

																				 
																				<td>
																				<a style='color:#fff;' class="<?php echo $class_css; ?>" gk-id="<?php echo $gkid; ?>" status-id="<?php echo $single->status; ?>" onclick="GatekeeperStatus(this)" ><?php echo $status; ?></a>
																				</td>
																				</tr>		
																			</table>
																					
																						
													</div>

														<div class="title">					
														<h3>Device Details</h3>
														</div>					
																	<div class="group_timer">				
																				<table class="table">
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<?php echo $single->devicename; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>DeviceID:</b>
																							</td>
																							<td>
																								<?php echo $single->deviceid; ?>
																							</td>
																						</tr>
																						<form method="POST">	
																							<div class="form-group">
																							<input type="hidden" name="gateid" value="<?php echo $gkid; ?>" />  
																							<input type="submit" name="reset" class="btn btn-primary" value="Reset Device ID" />
																							</div>
																					</form>
																					</table>
																					<p><i class="fa fa-clock-o"></i>
																					<?php
																						echo showtime4db($single->lastlogin); 
																					?>
																					</p>
																				
																			</div><!-- end group_times -->
																		</div><!-- end first -->
																	</div>
																	
															
																		
															<?php														
															
														}
														echo '<div style="clear:both;"></div>';
															echo "<center>";
																echo $pagination;
															echo "</center>";
												?>
													  
												<?php
											}
								?>
								
								
							</div><!-- end doc -->
                        </div><!-- end col-lg-12 -->
					</div><!-- end blog-masonry -->
            	</div><!-- end row --> 
            </div><!-- end content -->
            
			
    	</div>
		
		
		
		
   </section>
<?php
		echo	$layout['footer'];
?>