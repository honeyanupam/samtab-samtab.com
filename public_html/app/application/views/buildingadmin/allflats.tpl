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
					<div class="col-sm-12">
						<form method='GET' action="<?php echo base_url('building/allflats');?>">
						<div class='col-sm-7'>
							<input type="text" name='searchkeyword' id="searchkeyword" placeholder="Search Flats..." class='form-control'>
						</div>	
						<div class='col-sm-2'>
							<button type="submit" class='btn btn-primary btn-lg'> Search </button>
						</div>	
						</form>	
					
					<div class="pull-right col-sm-3">
						<a onclick="$('.addflattoggle').toggle();" class="btn btn-info">Add Flat</a>
						<a onclick="$('.addflatcsv').toggle();" class="btn btn-warning">Upload CSV Files</a>
					</div>
					</div>
							<div style="clear:both;"></div>
						
					<div class="addflatcsv" style="display:none;">
					<div class="row">
						<div class="col-sm-12">
						
						
											<div class="block-content-inner admin-blade-dropdown" style="text-align:center">
												<div style="padding:10px;" class="col-md-4">
													<h3> Step 1: </h3> 
														Please download the sample file. Don't modilfy the first row.
														<br/><br/> <!-- studentCsvFile/student.csv -->
													<a href='<?php echo base_url('assets/sample.csv');?>' class='btn btn-info btn-sm'>Download File</a> 
														<br/>
												</div>
												
												<div style="padding:10px;" class="col-md-4">
													<h3> Step 2: </h3>
														Fill all the relevant flat information and save the file as CSV file.
														<br/>
												</div> 
												
												<div style="padding:10px;" class="col-md-4">

													<h3> Step 3: </h3>
														Upload the CSV file with flat information and press the Import Data button to complete. <br/><br/>
													<form method="post" enctype="multipart/form-data">
															<input type="file" name="csv" class='form-control' value="" /> 
															<br/>
															<p style="color:red"></p>
															<button type="submit" class='btn btn-primary' name="submitcsv" ><i class='fa fa-upload'> Import Data</i></button>
													</form><br>
													
												</div>
														<div style="clear:both;"></div>
														<hr/>						
											
									If you are not sure how to import data, you can always send the sample file, filled with all the flat details to us at <a href="mailto:info@samtab.com"><b>info@samtab.com</b></a> and we can do it for you.
									
								<br/>		 
											
							
					</div>
					</div>
					</div>
					</div>
					<div class="addflattoggle" style="display:none;">
						<h3> Add a New Flat </h3>
						<div class="row">
							<form method="POST" class="addflatform" onsubmit="return addflat();">
								<div class="col-md-4">
									<div class="form-group">
										<input required type="text" name="stayby" id="stayby" class="form-control" Placeholder="Enter The Name" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control" Placeholder="Enter The Email" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input required type="number" name="mobile" id="mobile" class="form-control" Placeholder="Enter The Mobile Number" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input required type="text" name="number" id="number" class="form-control" Placeholder="Enter Flat Number" />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" name="contact_2" id="contact_2" class="form-control" Placeholder="Enter Contact 1" />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<input type="text" name="contact_3" id="contact_3" class="form-control" Placeholder="Enter Contact 2" />
									</div>
								</div>
								<div class="col-md-12">
								<p class="lead alert hideme addflatmessage form-group"></p> 
									<div class="form-group">
										<input type="submit" name="submit" class="btn btn-success" value="Save" />
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
							<div class="doc row">								
								
								<?php
								if(isset($uploadflatdata['message'])){
									if($uploadflatdata['status']==0){
										echo '<b><div class="alert alert-danger">
										 '.$uploadflatdata['message'].'
										</div></b>';
									}else{
										echo '<b><div class="alert alert-success">
										 '.$uploadflatdata['message'].'
										</div></b>';
									} 
								}
								
										if(empty($getallflats))
											{
												?>
														<div class=" alert alert-info text-center lead ">
															<b> Oops! </b> There is no flat log yet.
														</div>
												<?php
											} else {
												?>
												
												<?php
													foreach($getallflats as $single)
														{
																$fltid = $single->fltid;
															?>
															
															
																	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 searchcontant">
																		<div class="group_box first"> 
																				<div class='pull-right' style='margin-top: -30px;'>
																					<a class='btn btn-primary' href='<?php echo site_url("building/editflat/$fltid"); ?>'><i class='fa fa-edit' style='padding-right: 0px;color:#fff;'></i></a>
																				</div>
																			
																			<div class="group_img">
																			
																				
																			</div><!-- end group_img -->
																			<div class="title ">
																				<h3><a href="<?php echo site_url("building/flatdet/$fltid/1"); ?>"><?php echo $single->number; ?></a></h3>
																			</div>
																			<div class="group_timer">																				
																					<table class="table">
																						<tr>
																							<td>
																								<b> Name: </b>
																							</td>
																							<td>
																								<a href="<?php echo site_url("building/flatdet/$fltid/1"); ?>"><?php echo $single->stayby; ?></a>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b> Email Id: </b>
																							</td>
																							<td>
																								<?php echo $single->email; ?>
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
													</div>					
																	<div class="group_timer">																							
																					<table class="table">
																						<tr>
																							<td>
																								<b> contact 2: </b>
																							</td>
																							<td>
																							<?php 
																								if($single->contact_2!=''){
																								echo $single->contact_2;
																								}else{
																									echo 'N/A';
																								}
																								?>
																							</td>
																						</tr>
																						<tr>
																							<td>
																								<b>contact 3:</b>
																							</td>
																							<td>
																								<?php 
																								if($single->contact_3!=''){
																								echo $single->contact_2;
																								}else{
																									echo 'N/A';
																								}
																								?>
																							</td>
																						</tr>
																					</table>
																				
																				<?php if($single->status =='1'){ 
																						$class_css	= "btn btn-success";
																						$status 	= 'Enabled';
																						} else {
																						$class_css	= "btn btn-danger";
																						$status		= 'Disabled';
																					}
																				?>

																				
																				<p><i class="fa fa-clock-o"></i>
																					<?php
																						echo showtime4db($single->added);
																					?>
																				</p>
																				<a style='color:#fff;' class="<?php echo $class_css; ?>" flat-id="<?php echo $single->fltid; ?>" status-id="<?php echo $single->status; ?>" onclick="flatStatus(this)" ><?php echo $status; ?></a> 
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
<script>
$(document).ready(function(){
  $('#search').keyup(function(){
 
   // Search text
   var text = $(this).val().toLowerCase();
 
   // Hide all content class element
   $('.searchcontant').hide();

   // Search 
   $('.searchcontant .title').each(function(){
 
    if($(this).text().toLowerCase().indexOf(""+text+"") != -1 ){
     $(this).closest('.searchcontant').show();
    }
  });
   $('.searchcontant .table').each(function(){
 
    if($(this).text().toLowerCase().indexOf(""+text+"") != -1 ){
     $(this).closest('.searchcontant').show();
    }
  });
 });
});


</script>