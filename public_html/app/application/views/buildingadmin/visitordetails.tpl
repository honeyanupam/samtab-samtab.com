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
										if(empty($visitordetails))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no visitor log yet.
														</div>
												<?php
											} else {
												?>
												
												<?php
													foreach($visitordetails as $single)
														{
																$visid = $single->visid;
															?>
															
																<div class="col-lg-2"></div>
																	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
																		<div class="group_box first"> 
																				
																			<div class="group_img">
																			<?php 
																				if(!empty($single->photo_vis)){
																					$images = base_url("images/").$single->photo_vis; 
																				}else{
																					$images  = base_url("images/default.png");  
																				} 
																				
																			?>
																			<img src="<?php echo $images; ?>" alt="<?php echo $single->name; ?>" class="img-circle img-responsive" style="max-width:90px; margin: 0px auto;" />
																				
																			</div><!-- end group_img -->
																			<div class="title">
																				<h3><a href="<?php echo site_url("building/visitordetails/$visid/"); ?>">Visitor Details</a></h3>
																			</div>
																			<div class="group_timer">																				
																					<table class="table">
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<?php echo $single->name; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Gender:</b>
																							</td>
																							<td>
																								<?php echo $single->gender; ?> 
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Address:</b>
																							</td>
																							<td>
																								<?php echo $single->address; ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>ID:</b>
																							</td>
																							<td>
																								<?php echo $single->idnum; ?>
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
																					</table>
																		
																				<p><i class="fa fa-clock-o"></i>
																					<?php
																						echo showtime4db($single->added);
																					?>
																				</p>
																			</div><!-- end group_times -->
																
																
																		</div><!-- end first -->
																		<center>
																			<a class="btn btn-primary" href="javascript:window.history.go(-1);">Back</a>
																		</center>
																	</div>
																	<div class="col-lg-2"></div>
															
																		
															<?php														
														
														}
														
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