<?php
		echo	$layout['header'];
?> 
	<style>
	
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 15px;
	}
	.btn-lg {
    padding: 6px 30px;
}
.white-wrapper {
    padding: 0px 0;
}
	</style>
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
		<div class="white-wrapper">
			<div class="container lead">
					<br/>
					<div class="col-sm-10">
						<form method='GET' action="<?php echo base_url('information/premise');?>">
						<div class='col-sm-2'></div>
						<div class='col-sm-8'>
							<input type="text" name='searchkeyword' id="searchkeyword" placeholder="Search Premises..." class='form-control'>
						</div>	
						<div class='col-sm-1'>
							<button type="submit" class='btn btn-primary btn-lg'> Search </button>
						</div>	
						</form>	
					</div>
					
					<div class="pull-right">
						<a onclick="$('.addprimiseform').toggle();" class="btn btn-info">Add Primise</a>
					</div>
							<div style="clear:both;"></div>
						
					<div class="addprimiseform" style="display:none;">
						<h3> Add a New Primise </h3>
						<div class="row">
							<form method="POST" class="primiseform" onsubmit="return addprimise();">.
							
								<div class="col-md-12">
									<div class="col-md-2">
									Name
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="text" id='username' name="username" class="form-control" Placeholder="Name" />
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										Mobile
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="text" id='mobile' name="mobile" class="form-control" Placeholder="Mobile" />
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										Email Id
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input required type="email" id='email' name="email" class="form-control" Placeholder="Email-Id" />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										Password 
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input required type="password" id='password' name="password" class="form-control" Placeholder="Password" />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										Bulding Name 
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="text" id='buldingname' name="buldingname" class="form-control" Placeholder="Building Name" />
										</div>
									</div>
								</div>
								<div class="col-md-12">
										<div class="col-md-2">
											Address
										</div>
										<div class="col-md-10">
											<div class="form-group">
												<input required type="text" id='address' name="address" class="form-control" Placeholder="Address" />
											</div>
										</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										Radious 
									</div>
									<div class="col-md-10"> 
										<div class="form-group">
											<input required type="text" id='radious' name="radious" class="form-control" Placeholder="Radious" />
											<input type="hidden" name="bldid" id="bldid" value=""/>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
										Premises Image 
									</div>
									<div class="col-md-10"> 
											<div class="form-group">
												<div class="input-group">
												<!--input type="file" name="category_img" id="category_img"  accept="image/*" --> 
												<a class="btn alert-info" onclick="jQuery('.userfiles').trigger('click');" style="display:block;"><i class="fa fa-upload" aria-hidden="true"></i> Upload Image </a>
												<fileresponse style="display:block;"></fileresponse>
												<input type="hidden" class="sweetimageval" name="image" id="image">
												<input style="display:none;" onchange="uploadme();" type="file" id='regionimg' name="userfile" size="20" class="form-control userfiles" />  
												</div>
										   </div>
										   
									</div>
								</div>
								<div class="col-md-12">
								<p class="lead alert hideme addprimisemessage form-group"></p> 
									<div class="form-group">
										<input type="submit" name="submit" class="btn btn-success" value="Save Changes" />
									</div>
								</div>
							</form>
									<div style="clear:both;"></div>
						</div>
								<hr/>
					</div>	
						
					<div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:20px;">
                <div class="row">
                   <div class="blog-masonry">
                        <div class="col-lg-12">
							<div class="doc row" style='width: 104%;'>	
				
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
																								<?php echo $single['name']; ?>
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
																								<b>Photo</b>
																							</td>
																							<td>:</td>
																							<td>
																								<?php 
																									if(!empty($single['image'])){
																										$images = base_url($single['image']); 
																									}else{
																										$images  = base_url("images/default.png");  
																									} 
																									?>
																								<img src="<?php echo $images; ?>" alt="<?php echo $single['name']; ?>" class="img-circle img-responsive" style="max-width:90px; height: 90px; margin: 0px auto;" />
																							</td>
																						</tr>
																				
																						
																					
																				<?php 
																				if($single['status'] =='1'){ 
																					$class_css	= "btn btn-success btn-lg";
																					$status 	= 'Enabled';
																					} else {
																					$class_css	= "btn btn-danger btn-lg";
																					$status		= 'Disabled';
																				}
																				?>

																				
																				<td>
																				<a style='color:#fff;' class="<?php echo $class_css; ?>" bld-id="<?php echo $single['bldid']; ?>" status-id="<?php echo $single['status']; ?>" onclick="bldStatus(this)" ><?php echo $status; ?></a>
																				</td>
																				<td></td>
																				<td>
																				<a class="btn btn-success btn-lg" onClick="editbuladmin('<?php echo $single['bldid']; ?>','<?php echo $single['name']; ?>','<?php echo $single['mobile']; ?>','<?php echo $single['email']; ?>','<?php echo $single['buldingname'];?>','<?php echo $single['address'];?>','<?php echo $single['radious'];?>','<?php echo $single['image'];?>');"><span style='color:#fff;'>View / Edit</span></a>
																				</td>
																				</table> 			
																			
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
			</div><!-- end container -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
		</div><!-- end white-wrapper -->
	</section><!-- end blog-wrapper -->
   
<?php
		echo	$layout['footer'];
?>

	<script>
		$(document).ready(function(){
			$('.videostable').DataTable(
				{
					 "order": [[ 0, "desc" ]]
				}
			);
		});
		
		
			function confirmdelete()
				{
					 if (confirm("Are you sure?"))
						{
								// your deletion code
							return true;
						}
							return false;
				}
		
			
		
	</script>