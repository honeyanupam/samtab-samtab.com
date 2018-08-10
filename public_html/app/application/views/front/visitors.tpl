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
					<div class="col-sm-10">
						<form method='GET' action="<?php echo base_url('information/visitors');?>">
						<div class='col-sm-2'></div>
						<div class='col-sm-8'>
							<input type="text" name='searchkeyword' id="searchkeyword" placeholder="Search Visitors..." class='form-control'>
						</div>	
						<div class='col-sm-1'>
							<button type="submit" class='btn btn-primary btn-lg'> Search </button>
						</div>	
						</form>	
					</div>
				<br/>	
        	<div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px;">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
							<div class="doc row">								
								
								<?php
										if(empty($allgetvisitor))
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
													foreach($allgetvisitor as $single)
														{
														?>
															
															
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
																		<div class="group_box first">
																			<div class="group_img">
																			<img src="<?php echo base_url("images"); ?>/default.png" alt="<?php echo $single->visname; ?>" class="img-circle img-responsive" style="max-width:90px; margin: 0px auto;" />
																				
																			</div><!-- end group_img -->
																								
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