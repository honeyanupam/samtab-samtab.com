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
								if(empty($allappointment))
									{
										echo	"
													<div class='alert alert-info'>
														<b> Error! </b> There is no Appointment Query on the site.
													</div>
												";
									} else {
										?>
											<table class="table appointmenttable">
												<thead>
													<tr>
														<th> ID </th>
														<th> Name </th>
														<th> Email </th>
														<th> Mobile </th>
														<th> Message </th>
														<th> Appointment Date </th>
														<th> Received on </th>
														<th> Received from IP </th>
													</tr>
												</thead>
												<tbody>
										<?php
										foreach($allappointment as $single)
											{
												echo "<tr>";
													echo "<td>".$single['id']."</td>";
													echo "<td>".$single['name']."</td>";
													echo "<td>".$single['email']."</td>";
													echo "<td>".$single['contactno']."</td>";
													echo "<td>".$single['message']."</td>";
													echo "<td>".$single['apndate']."</td>";
													echo "<td>".$single['added']."</td>";
													$ipid = $single['ip'];
													echo "<td><a href='https://whatismyipaddress.com/ip/$ipid' target='_BLANK'>$ipid</a></td>";
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
			$('.appointmenttable').DataTable(
				{
					 "order": [[ 0, "desc" ]]
				}
			);
		});
	</script>