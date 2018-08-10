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
	<section class="blog-wrapper"> 
		<div class="white-wrapper1">
							 
			  <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px;">
                <div class="row">
                   <div class="blog-masonry">
				   <div class="container lead">
				   <div class='col-lg-12'>
				   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 first">
						<div class="ch-item">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                    	<i class="fa fa-building-o  fa-4x"></i>
                                        <h3>Buildings</h3>
                                    </div>
									<div class="ch-info-back">
										<i class="fa fa-building-o  fa-4x"></i>
                                        <h1 class='fa-4x'><?php echo $buildings;?></h1>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item -->
                    </div>
				   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="ch-item">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                    	<i class="fa fa-home fa-4x"></i>
                                        <h3>Flats</h3>
                                    </div>
									<div class="ch-info-back">
                                         <i class="fa fa-home fa-4x"></i>
										<h1 class='fa-4x'><?php echo $flats;?></h1>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item -->
                    </div>
				   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="ch-item">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                    	<i class="fa fa-users  fa-4x"></i>
                                        <h3>Visitors</h3>
                                    </div>
									<div class="ch-info-back">
										<i class="fa fa-users  fa-4x"></i>
                                        <h1 class='fa-4x'><?php echo $visitors;?></h1>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item -->
                    </div>
				   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="ch-item">	
							<div class="ch-info-wrap">
								<div class="ch-info">
									<div class="ch-info-front">
                                    	<i class="fa fa-bars fa-4x"></i>
                                        <h3>Logs</h3>
                                    </div>
									<div class="ch-info-back">
										<i class="fa fa-bars fa-4x"></i>
                                        <h1 class='fa-4x'><?php echo $vislogs;?></h1>
                                    </div>
								</div><!-- end ch-info -->
							</div><!-- end ch-info-wrap -->
						</div><!-- end ch-item -->
                    </div>
				   </div>
                     
					 <div class="col-lg-12">
						<div class="doc row">	
							<h3> <b><center>Latest Buildings</center></b></h3>
						<?php 
								if(empty($allbldadmin))
									{
										echo	"
													<div class='alert alert-info'>
														<b> Error! </b> There is no Primise on the site.
													</div>
												";
									} else {
										foreach($allbldadmin as $single)
											{ 
											?>
															<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first" style='padding: 0px 0px 0px;margin: 15px 0;'> 
																				
																					
																			<table class="table" style='margin-bottom: 0px;'>
																						<tr>
																							<td>
																								<b> Name</b>
																							</td>
																							<td>:</td>
																							<td>
																								<?php echo $single['name'] ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Mobile</b>
																							</td>
																							<td>:</td>
																							<td>
																								<?php echo $single['mobile']; ?>
																							</td>
																						</tr>
																						
																						<tr>
																							<td>
																								<b> Email </b>
																							</td>
																							<td>:</td>
																							<td>
																								<?php echo $single['email'];?>
																							</td>
																						</tr>
																				</table> 			
																			
																		</div><!-- end first -->
																	</div>
											<?php 
											}
											echo '<div style="clear:both;"></div>';
													
										?>
										<?php
									}
						?>
						<a target='_blank' href='<?php echo base_url('information/premise');?>' class='btn btn-primary pull-right'>View All</a>
			
						<div class="doc row">	
							<h3> <b><center>Latest Visitors</center></b></h3>
						<?php 
								if(empty($allvisitors))
									{
										echo	"
													<div class='alert alert-info'>
														<b> Error! </b> There is no Primise on the site.
													</div>
												";
									} else {
										foreach($allvisitors as $single)
											{ 
											?>
															<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first" style='padding: 0px 0px 0px;margin: 15px 0;'> 
																				
																					
																			<table class="table" style='margin-bottom: 0px;'>
																						<tr>
																							<td>
																								<b> Name</b>
																							</td>
																							<td>:</td>
																							<td>
																								<?php echo $single['name'] ?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>Mobile</b>
																							</td>
																							<td>:</td>
																							<td>
																								<?php echo $single['mobile']; ?>
																							</td>
																						</tr>
																						
																				</table> 			
																			
																		</div><!-- end first -->
																	</div>
											<?php 
											}
											echo '<div style="clear:both;"></div>';
													
										?>
										<?php
									}
						?>
						<a target='_blank' href='<?php echo base_url('information/visitors');?>' class='btn btn-primary pull-right'>View All<a>
			</div><!-- end container --> 
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper --> 
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		
		</div>
   </section>
<?php
		echo	$layout['footer'];
?>