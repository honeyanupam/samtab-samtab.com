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
							  
										if(empty($flatdetailsbyId))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no flat log yet.
														</div>
												<?php
											} else {
												$fltid = $flatdetailsbyId[0]->flatis;
												?>
											<div class="col-lg-2">
											</div>											
										<div class="col-lg-8 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first">
																				<div class='pull-right' style='margin-top: -30px;'>
																					<a class='btn btn-success' href='<?php echo site_url("building/editflat/$fltid"); ?>'><i class='fa fa-edit' style='padding-right: 0px;'></i></a>
																				</div>
																			<div class="group_img">
																			
																			</div><!-- end group_img -->
																			<div class="title">
																				<h3><a href="<?php echo site_url("building/flatdet/$fltid/1"); ?>"><?php echo $flatdetailsbyId[0]->number; ?></a></h3>
																			</div>
																			<div class="group_timer">																				
																					<table class="table" style='text-align:center;'>
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<?php echo $flatdetailsbyId[0]->stayby; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Email:</b>
																							</td>
																							<td>
																								<?php echo $flatdetailsbyId[0]->email; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Mobile:</b>
																							</td>
																							<td>
																								<?php echo $flatdetailsbyId[0]->mobile; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b> contact 2: </b>
																							</td>
																							<td>
																								<?php echo $flatdetailsbyId[0]->contact_2; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>contact 3:</b>
																							</td>
																							<td>
																								<?php echo $flatdetailsbyId[0]->contact_3; ?>
																							</td>
																						</tr>
																						</table>
																		</div>					
																	<div class="group_timer">		 		
																				
																			</div><!-- end group_times -->
																		</div><!-- end first -->
																	</div>	
																	<div class="col-lg-2">
																	</div>	
												</div>
												<div style='clearfix'></div>												
											<?php } ?>	 
											<div class="doc row">													
											<?php 
										
											if(empty($flatdetails))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no visitors log yet.
														</div>
												<?php  
											} else {
												
												?>
												<center><h3><b>Visitors List</b></h3></center> 
											<?php
													foreach($flatdetails as $single)
														{
																$fltid   = $single->fltid; 
																$visid   = $single->visid ; 
															?>
															
															
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first">
																			
																			<div class="group_img">
																			</div><!-- end group_img -->
																			<div class="title">
																				<h3><a href="<?php echo site_url("building/visitorflat/$visid/"); ?>"><?php echo $single->vismobile; ?></a></h3>
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
																						echo showtime4db($single->vislogsadded);
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
								</div><!-- end first -->
																	</div>
								
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