<?php
		echo	$layout['header'];
?> 
	
	<section class="post-wrapper-top jt-shadow clearfix">
		<div class="container">
			<div class="col-lg-12">
				<h2><?php echo $data['seo']['title']; ?></h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?php echo base_url(); ?>">Dashbaord</a></li>
                    <li><?php echo $data['seo']['title']; ?></li>
                </ul>
			</div>
		</div>
	</section><!-- end post-wrapper-top -->
	<section class="blog-wrapper ">
		<div class="container">
				<div id="content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="widget">
					<div class="title"><h2>Change Password</h2></div> 
      				<form role="form" class="adminchangepasswordform" method="POST" onsubmit="return adminchangepassword();">
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
					<p class="lead alert hideme adminchangepasswordpassmessage form-group"></p> 
						<button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Change Password</strong></button>
					</div>
				</form>	                              
				</div><!-- end widget -->
			
					
			</div><!-- end container -->
		</div><!-- end white-wrapper -->
	</section><!-- end blog-wrapper -->
   
<?php
		echo	$layout['footer'];
?>