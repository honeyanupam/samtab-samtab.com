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
										if(empty($visitorflat))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no visitor log yet.
														</div>
												<?php
											} else {
												?>
												
												<?php
													foreach($visitorflat as $single)
														{
																$fltid = $single->fltid;
																$visid = $single->visid;
															?>
															
															
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first"> 
																				
																			<div class="group_img">
																			
																				
																			</div><!-- end group_img -->
																			<div class="title">
																				<h3><a href="<?php echo site_url("building/visitordetails/$visid/"); ?>">Visitor</a></h3>
																			</div>
																			<div class="group_timer"> 		
																				<table class="table">
																						<tr>
																							<td> 
																								<b> Visitor Name: </b>
																							</td>
																							<td>
																								<a href="<?php echo site_url("building/visitordetails/$visid/"); ?>"><?php echo $single->visname; ?></a>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Visitor Mobile:</b>
																							</td>
																							<td>
																								<?php echo $single->vismobile; ?>
																							</td>
																						</tr>
																					</table>
																			</div>					
																
																<div class="title">					
																		<h3><a href="<?php echo site_url("building/flatdet/$fltid/1"); ?>"><?php echo $single->flatnumber; ?></a></h3>
															</div>					
																	<div class="group_timer">																							
																					<table class="table">
																						<tr>
																							<td>
																								<b> Flat Owner: </b>
																							</td>
																							<td>
																								<?php echo $single->stayby; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Flat Number:</b>
																							</td>
																							<td>
																								<?php echo $single->flatnumber; ?>
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