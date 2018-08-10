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
						<a onclick="$('.addvideoform').toggle();" class="btn btn-info">Add Video</a>
					</div>
							<div style="clear:both;"></div>
						
					<div class="addvideoform" style="display:none;">
						<h3> Add a New Video </h3>
						<div class="row">
							<form method="POST">
								<div class="col-md-12">
									<div class="form-group">
										<input  required type="text" name="ytlink" class="form-control" Placeholder="Insert YouTube Embed URL like 	https://www.youtube.com/embed/I20B8mhMEW8" />
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
								if(empty($allvideos))
									{
										echo	"
													<div class='alert alert-info'>
														<b> Error! </b> There is no video on the site.
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
															YouTube Link
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
										foreach($allvideos as $single)
											{
												echo "<tr>";
													echo "<td>".$single['id']."</td>";
													echo "<td><a href='".$single['ytlink']."' target='_BLANK'>".$single['ytlink']."</a></td>";
													echo "<td>".$single['added']."</td>";
													$ipid = $single['ip'];
													echo "<td><a href='https://whatismyipaddress.com/ip/$ipid' target='_BLANK'>$ipid</a></td>";
													?>
														<td>
															<form method="POST" onsubmit="return confirmdelete();">
																<input type="hidden" name="videoid" value="<?php echo $single['id']; ?>" />
																<input type="hidden" name="delete" value="1" />
																<input type="submit" class="btn btn-danger" name="submit" value="Delete Video <?php echo $single['id']; ?>" />
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