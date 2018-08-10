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
        	<div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
							<div class="doc row">								
								<div class="title"><h2>Update Profile</h2></div> 
								
		
								<form method="POST" class="updateprofileform" onsubmit="return updateprofile();">
							
								<div class="col-md-12">
									<div class="col-md-2">
									<label>	Name  </label>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="text" id='username' name="username" class="form-control" Placeholder="Name" value='<?php echo $selectdata[0]['name'];?>'/>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label>	Mobile </label>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="number" id='mobile' name="mobile" class="form-control" Placeholder="Mobile" value='<?php echo $selectdata[0]['mobile'];?>' />
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label>	Email Id </label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input required type="email" id='email' name="email" class="form-control" Placeholder="Email-Id" value='<?php echo $selectdata[0]['email'];?>' disabled />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label>	Bulding Name  </label>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="text" id='buldingname' name="buldingname" class="form-control" Placeholder="Building Name" value='<?php echo $selectdata[0]['buldingname'];?>'  />
										</div>
									</div>
								</div>
								<div class="col-md-12">
										<div class="col-md-2">
										<label>	Address </label>
										</div>
										<div class="col-md-10">
											<div class="form-group">
												<input required type="text" id='address' name="address" class="form-control" Placeholder="Address" value='<?php echo $selectdata[0]['address'];?>' />
											</div>
										</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										<label>	Photo </label>
									</div>
									<div class="col-md-10"> 
											<div class="form-group">
												<div class="input-group">
												<!--input type="file" name="category_img" id="category_img"  accept="image/*" --> 
												<a class="btn alert-info" onclick="jQuery('.userfiles').trigger('click');" style="display:block;"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image </a>
												<fileresponse style="display:block;"></fileresponse>
												<input type="hidden" class="sweetimageval" name="image" id="image">
												<input style="display:none;" onchange="uploadme();" type="file" id='regionimg' name="userfile" size="20" class="form-control userfiles" />  
											
										 
										   <?php 
										   
												if(!empty($selectdata[0]['image'])){
													$images = base_url($selectdata[0]['image']); 
												}else{
													$images  = base_url("images/default.png");  
												} 
												?>
												<br/>
											<img src="<?php echo $images; ?>" alt="<?php echo $selectdata[0]['name']; ?>" class="img-circle img-responsive" style="max-width:90px; height: 90px; margin: 0px auto;" />
												</div>
										  </div>
									  </div>	  
								</div>
								<div class="col-md-12">
								<p class="lead alert hideme updateprofilemessage form-group"></p> 
									<div class="form-group">
										<input type="submit" name="submit" class="btn btn-sm btn-primary  m-t-n-xs" value="Save Changes" />
									</div>
								</div>
							</form>
									<div style="clear:both;"></div>
									<br/>
									<br/>
								<form method="POST" >	
								<div class="col-md-12">
										<div class="col-md-2">
											<label>Reset Geo Location</label>  
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<input required type="text" id='lati' name="lati" class="form-control" Placeholder="Latitude" value='<?php echo $selectdata[0]['lati'];?>' disabled />
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<input required type="text" id='longi' name="longi" class="form-control" Placeholder="Longitude" value='<?php echo $selectdata[0]['longi'];?>' disabled />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
											<input type="submit" name="submit1" class="btn btn-primary  m-t-n-xs" value="Reset" />
											</div>
										</div>		
								</div>	  
								</form>								
								</div><!-- end doc -->
                        </div><!-- end col-lg-12 -->
					</div><!-- end blog-masonry -->
            	</div><!-- end row --> 
            </div><!-- end content -->
            
			<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                 
				<div class="widget">
					<div class="title"><h2>Change Password</h2></div> 
      				<form role="form" class="changepassword_form_submit" method="POST" onsubmit="return changepassword_form_submit();">
					<div class="form-group">
					<label> Password </label>
							<input type="password" name="password" id="password" required="" placeholder="Password" class="form-control">
					</div>
					<div class="form-group">
						<label>
							  New Password
						</label>
							<input type="password" name="newpassword" id="newpassword" required="" placeholder="New Password" class="form-control">
					</div>
					<div class="form-group">
						<label>
							  Confirm Password
						</label>
							<input type="password" name="confirmpassword" id="confirmpassword" required="" placeholder="Confirm Password" class="form-control">
					</div>
					<div>
					<p class="lead alert hideme updateprofilepassmessage form-group"></p> 
						<button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Change Password</strong></button>
					</div>
				</form>	                              
				</div><!-- end widget -->
			</div><!-- end sidebar -->
    	</div>
		
		
		
		
   </section>
<?php
		echo	$layout['footer'];
?>