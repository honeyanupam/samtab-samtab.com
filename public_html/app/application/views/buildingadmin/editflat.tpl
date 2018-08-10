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
	<div class="row">
	<div class="col-md-12">
	<form method="POST" class="editflatform" onsubmit="return editflat();">
								<div class="col-md-12">
									<div class="col-md-2">
									<label><b>Owner Name</b></label>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<input required type="text" name="stayby" id="stayby" class="form-control" Placeholder="Enter The Name" value='<?php echo $selectdata[0]->stayby;?>'/>
											<input required type="hidden" name="fltid" id="fltid" class="form-control" Placeholder="Enter The Name" value='<?php echo $selectdata[0]->fltid;?>'/>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label><b>Email</b></label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control" value='<?php echo $selectdata[0]->email;?>' Placeholder="Enter The EmailId" />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label><b>Mobile Number</b></label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input required type="text" name="mobile" id="mobile" class="form-control" value='<?php echo $selectdata[0]->mobile;?>' Placeholder="Enter The Mobile Number" />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label><b>Flat Number</b></label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input required type="text" name="number" id="number" class="form-control"  value='<?php echo $selectdata[0]->number;?>' Placeholder="Enter Flat Number" disabled />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label><b>Contact Number 1</b></label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input type="text" name="contact_2" id="contact_2" class="form-control"  value='<?php echo $selectdata[0]->contact_2;?>' Placeholder="Enter Contact 1" />
									</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="col-md-2">
									<label><b>Contact Number 2</b></label>
									</div>
									<div class="col-md-10">
									<div class="form-group">
										<input type="text" name="contact_3" id="contact_3" value='<?php echo $selectdata[0]->contact_3;?>' class="form-control" Placeholder="Enter Contact 2" />
									</div>
									</div>
								</div>
								<div class="col-md-12">
								<br/>
									<div class="col-md-2">
									
									</div>
									<div class="col-md-10">
									<p class="lead alert hideme editflatmessage form-group"></p> 
										<div class="form-group">
											<input type="submit" name="submit" class="btn btn-success" value="Save Changes" />
											<a href="<?php echo base_url('building/allflats/');?>" class="btn btn-info" />Back</a>
										</div>
									</div>
								</div>
							</form>
						</div>
						</div>
					</div>	 
	</section>
	<?php
		echo	$layout['footer'];
?>