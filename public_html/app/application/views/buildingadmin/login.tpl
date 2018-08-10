<?php   echo $layout['header'] ; ?>

    <section class="jt-shadow clearfix">
		<div class="container">
			<div class="col-lg-12">
				<h1><?php echo lang('selleraccount'); ?></h1>
                <ul class="breadcrumb pull-right">
                    <li><a href="<?php echo site_url(); ?>"><?php echo lang('home'); ?></a></li>
                    <li><?php echo trim(lang('selleraccount')); ?></li>
                </ul> 
			</div>
		</div>
	</section>
	
	<section class="blog-wrapper">
    	<div class="container">
        	<div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                   <div class="col-md-6">
				   
 						<div class="widget">
                        	<div class="title"> 
                            	<h3> &nbsp; </h3>  
                            </div>
							<p class="lead">
									Login to manage your flats and visitors. Visitor local directory can also be seen.
							</p>
						</div>
				   </div>
                   <div class="col-md-6">
 						<div class="widget">
                        	<div class="title"> 
                            	<h3>Login Your Account</h3>  
                            </div>
                                <form method="POST" class="adminloginform" onsubmit="return loginme();">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input maxlength="80" type="text" class="form-control" placeholder="Email or Mobile Number" id="loginemail" name="loginemail" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input maxlength="80" type="password" name="password" id="loginpassword" class="form-control" placeholder="Password" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!--div class="checkbox">
                                            <label> 
                                                <input type="checkbox" value="1" id="loginremember" /> Remember me
                                            </label>
                                        </div-->
                                    </div>
												<p class="lead alert hideme adminmessage form-group"></p> 
                                    <div class="form-group text-center" >
										<button type="submit" id="submit" name="submit" class="btn btn-primary">Sign in</button>
                                    </div>
                                </form>
                        </div><!-- end widget -->
									<div class="col-xs-12" style="text-align: right;">
										<a onclick="$('.resetpassword').toggle();" class="" oldclass="btn btn-default btn-block">Forgot Password?</a> 
								<div class="change-section resetpassword" style="display:none;">
									<!--   <h3 class="heading"> &nbsp; </h3> {{URL::to('/')}}/signup" -->
									<form method="POST" onsubmit="return resetmypassword();" class='resetmypasswordform'>
										<div class="form-group">
											<div class='pull-left'>
												<label>Enter your email to received a new Password for your account.</label>
												
											</div>	 
													<input required type="email" name="frg_email" class="form-control frg_email" placeholder="Enter Your Email" />
										</div>
										<label style='display:none;'>If you forgot your password email us at <a href='mailto:contact@samtab.com'>contact@samtab.com</a></label>
										<div class="form-group pull-left">
											<div class="resusermanage alert" style="display:none;"></div>
												<button type="submit" class="btn btn-info">Reset my Password</button>
										</div>
									</form>
									</div>
									</div>
					</div><!-- end col-md-6 -->
            	</div><!-- end row --> 
            </div><!-- end content -->
    	</div><!-- end container -->
    </section>
<?php echo $layout['footer']; ?>