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
							<div class="row">
							<form method="POST" class="editgatekeeperform" onsubmit="return editgatekeeper();">
								<div class="col-md-6">
									<div class="form-group">
										<input required type="text" name="firstname" id="firstname" class="form-control" Placeholder="Enter First Name" value='<?php echo $selectdata[0]->firstname; ?>'/>
										<input required type="hidden" name="gkid" id="gkid" class="form-control" Placeholder="Enter First Name" value='<?php echo $selectdata[0]->gkid; ?>'/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input required type="text" name="lastname" id="lastname" class="form-control" Placeholder="Enter Last Name" value='<?php echo $selectdata[0]->lastname; ?>'/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input required type="text" name="mobile" id="mobile" class="form-control" Placeholder="Enter Mobile Number" value='<?php echo $selectdata[0]->mobile; ?>'/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input required type="text" name="password" id="password" class="form-control" Placeholder="Enter Password" />
									</div>
								</div>
								<?php 
													if(!empty($selectdata[0]->photo)){
														$images = base_url($selectdata[0]->photo); 
													}else{
														$images  = base_url("images/default.png");  
													} 
													
												?>
												<img src="<?php echo $images; ?>" alt="<?php echo $selectdata[0]->firstname; ?>" class="img-circle img-responsive pull-left" style="max-width:90px; margin: 0px auto;" >
								<div class="col-md-6">
								<div class="form-group">
												
									<div class="input-group">
									<!--input type="file" name="category_img" id="category_img"  accept="image/*" --> 
									<a class="btn alert-info" onclick="jQuery('.userfiles').trigger('click');" style="display:block;"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image </a>
									<fileresponse style="display:block;"></fileresponse>
									<input type="hidden" class="sweetimageval" name="image" id="image" value='<?php echo $selectdata[0]->photo; ?>' >
									<input style="display:none;" onchange="uploadme();" type="file" id='regionimg' name="userfile" size="20" class="form-control userfiles" />  
																			
									</div>
							    </div>
								
							    </div>
								<br/>
								<br/>
								
									<div style="clear:both;"></div>
						</div>
						<div class="col-md-12">
								<p class="lead alert hideme editgatekeepermessage form-group"></p> 
									<div class="form-group">
										<center><input type="submit" name="submit" class="btn btn-success" value="Save Changes" /> &nbsp;&nbsp;<a href="<?php echo base_url('building/allgatekeepers/');?>" class="btn btn-info" />Back</a></center>
										
									</div>
								</div>
							</form>
								<hr/>	

	</div>	 
	</section>
	<?php
		echo	$layout['footer'];
?>