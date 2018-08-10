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
					
					<p>
						
						<?php 
								if(empty($enquiry))
									{
										echo	"
													<div class='alert alert-info'>
														<b> Opps! </b> There is no Enquiry Request on the site.
													</div>
												";
									} else {
										?>
											<table class="table">
												<thead>
													<tr>
														<th> ID </th>
														<th> Name </th>
														<th> Email </th>
														<th> Mobile </th>
														<th> Building Name</th>
														<th> City </th>
														<th> Received on </th>
														<th> Received from IP </th>
													</tr>
												</thead>
												<tbody> 
										<?php
										foreach($enquiry as $single)
											{
												echo "<tr>";
													echo "<td>".$single['id']."</td>";
													echo "<td>".$single['name']."</td>";
													echo "<td>".$single['email']."</td>";
													echo "<td>".$single['mobile']."</td>";
													echo "<td>".$single['buildingname']."</td>";
													echo "<td>".$single['city']."</td>";
													echo "<td>".showtime4db($single['added'])."</td>";
													$ipid = $single['ip'];
													echo "<td><a href='https://whatismyipaddress.com/ip/$ipid' target='_BLANK'>$ipid</a></td>";
												echo "</tr>";
											}
										?>
												</tbody>
											</table>
										<?php
									echo '<div style="clear:both;"></div>';
															echo "<center>";
																echo $pagination;
															echo "</center>";
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
			$('.cntquerytable').DataTable(
				{
					 "order": [[ 0, "desc" ]]
				}
			);
		});
	</script>