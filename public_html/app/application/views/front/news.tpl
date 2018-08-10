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
		<div class="white-wrapper">
			<div class="container lead">
					
					
					<div class="pull-right">
						<a onclick="$('.addvideoform').toggle();" class="btn btn-info">Add NEWS</a>
					</div>
							<div style="clear:both;"></div>
						
					<div class="addvideoform" style="display:none;">
						<h3> Add a New NEWS </h3>
						<div class="row">
							<form method="POST">
								<div class="col-md-12">
									<div class="form-group">
										<input required type="text" name="title" class="form-control" Placeholder="Title for NEWS" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="description" class="form-control" Placeholder="Content for NEWS"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" name="submit" class="btn btn-success" value="Add" />
									</div>
								</div>
							</form>
									<div style="clear:both;"></div>
						</div>
								<hr/>
					</div>	
						
					
					<p>
						<?php 
								if(empty($alltestimonials))
									{
										echo	"
													<div class='alert alert-info'>
														<b> Error! </b> There is no NEWS on the site.
													</div>
												";
									} else {
										?>
											<table class="table videostable">
												<thead>
													<tr>
														<th>
															ID
														</th>
														<th>
															Title
														</th>
														<th>
															Description
														</th>
														<th>
															Added
														</th>
														<th>
															Added from IP
														</th>
														<th>
															Delete
														</th>
													</tr>
												</thead>
												<tbody>
										<?php
										foreach($alltestimonials as $single)
											{
												echo "<tr>";
													echo "<td>".$single['id']."</td>";
													echo "<td>".$single['title']."</td>";
													echo "<td>".$single['description']."</td>";
													echo "<td>".$single['added']."</td>";
													$ipid = $single['ip'];
													echo "<td><a href='https://whatismyipaddress.com/ip/$ipid' target='_BLANK'>$ipid</a></td>";
													?>
														<td>
															<form method="POST" onsubmit="return confirmdelete();">
																<input type="hidden" name="testiid" value="<?php echo $single['id']; ?>" />
																<input type="hidden" name="delete" value="1" />
																<input type="submit" class="btn btn-danger" name="submit" value="Delete NEWS <?php echo $single['id']; ?>" />
															</form>
														</td>
													<?php
												echo "</tr>";
											}
										?>
												</tbody>
											</table>
										<?php
									}
						?>
					</p>
					
			</div><!-- end container -->
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