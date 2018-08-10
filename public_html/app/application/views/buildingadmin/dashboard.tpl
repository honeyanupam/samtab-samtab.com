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
								<h3 class="">
									Welcome <?php echo $this->session->userdata('username'); ?>,
								</h3>
								<p>	
										Manage your Flats, Gate Keeper, Local Directory from here. You can also view your visitor's log from here. 
								</p>
								
								<br/>
															
								
								<?php
										if(empty($latestvisitors))
											{
												?>
												<?php
											} else {
												?>
												<h3 class="">
									Latest Visitors 
								</h3>
													<!--table class="table table-striped">
													  <thead>
														<tr>
														  <th>#</th>
														  <th>Visitors</th>
														  <th>Flat Details</th>
														  <th>Time</th>
														</tr>
													  </thead>
													  <tbody-->
												<?php
													foreach($latestvisitors as $single)
														{
															$fltid = $single->fltid;
															$visid = $single->visid;
															?>
															
															
																	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
																		<div class="group_box first">
																			<div class="group_img">
																			<img src="<?php echo base_url("images"); ?>/default.png" alt="<?php echo $single->visname; ?>" class="img-circle img-responsive" style="max-width:90px; margin: 0px auto;" />
																			<!--span class="circle">12</span>
																				<img src="<?php echo base_url("images"); ?>/<?php echo $single->photo; ?>" alt="<?php echo $single->visname; ?>" class="img-circle img-responsive" style="max-width:90px; margin: 0px auto;" -->
																				
																			</div><!-- end group_img -->
																			<div class="title">
																				<h3><a href="<?php echo site_url("building/flatdet/$fltid/1"); ?>"><?php echo $single->flatno; ?></a></h3>
																			</div>
																			<div class="group_timer">																				
																					<table class="table">
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<?php echo $single->stayby; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Mobile:</b>
																							</td>
																							<td>
																								<?php echo $single->flatmobile; ?>
																							</td>
																						</tr>
																					</table>
													</div>	<div class="title">					
														<h3><a href="<?php echo site_url("building/visitorflat/$visid"); ?>">Visitor</a></h3>
															</div>					
																	<div class="group_timer">																							
																					<table class="table">
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<?php echo $single->visname; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Mobile:</b>
																							</td>
																							<td>
																								<?php echo $single->vismobile; ?>
																							</td>
																						</tr>
																					</table>
																				
																				<p><i class="fa fa-clock-o"></i>
																					<?php
																						echo showtime4db($single->added);
																					?>
																				</p>
																			</div><!-- end group_times -->
																		</div><!-- end first -->
																	</div>
															
																		<!--tr>
																		  <td> 
																				<img src="<?php echo base_url("images"); ?>/<?php echo $single->photo; ?>" class="img-responsive" />
																		  </td>
																		  <td>
																		  </td>
																		  <td>
																				<b> Flat Number: </b> <?php echo $single->flatno; ?> <br/>
																		  </td>
																		  <td>
																				
																		  </td>
																		</tr-->
															<?php														
														}
												?>
													  <!--/tbody>
													</table-->
														<a href="<?php echo site_url("building/visitors-logs"); ?>" class="pull-right">
															All Visitors
														</a>
												<?php
											}
								?>
								
							</div><!-- end doc -->
                        </div><!-- end col-lg-12 -->
					</div><!-- end blog-masonry -->
            	</div><!-- end row --> 
            </div><!-- end content -->
            
			<div id="sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                 
				<div class="widget">
					<div class="title"><h2>Navigation</h2></div>
						<ul class="nav nav-tabs nav-stacked">
							<li> <a href="<?php echo site_url("building/dashboard"); ?>">Dashboard</a> </li>
							<li> <a href="<?php echo site_url("building/allgatekeepers"); ?>">Gate Keeper</a> </li>
							<li> <a href="<?php echo site_url("building/allflats"); ?>">Flats</a> </li>
							<li> <a href="<?php echo site_url("building/visitors-logs"); ?>">Visitor's Log</a> </li>
							<li> <a href="<?php echo site_url("building/activites"); ?>">Activities</a> </li>
							<li> <a href="<?php echo site_url("building/settings"); ?>">Settings</a> </li>
						</ul>                              
				</div><!-- end widget -->
			</div><!-- end sidebar -->
    	</div>
		
		
		
		
   </section>
<?php
		echo	$layout['footer'];
?>