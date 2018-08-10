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
        	<div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px;">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
							<div class="doc row">								
								
								<?php
										if(empty($getvisitorlogs))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no visitor log yet.
														</div>
												<?php
											} else {
												?>
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
													foreach($getvisitorlogs as $single)
														{
															$fltid = $single->fltid;
															$visid = $single->visid;
															?>
															
															
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first">
																			<div class="group_img">
																			<img src="<?php echo base_url("images"); ?>/default.png" alt="<?php echo $single->visname; ?>" class="img-circle img-responsive" style="max-width:90px; margin: 0px auto;" />
																				
																			</div><!-- end group_img -->
																			<!--div class="title">
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
																				</div>	
																				<div class="title">				
																					<h3><a href="<?php echo site_url("building/visitorflat/$visid"); ?>">Visitor</a></h3>
																				</div-->					
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
														echo '<div style="clear:both;"></div>';
															echo "<center>";
																echo $pagination;
															echo "</center>";
												?>
													  <!--/tbody>
													</table
														<a href="<?php echo site_url("building/visitors-logs"); ?>" class="pull-right">
															All Visitors
														</a>
														-->
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