
<input type="hidden" id="base_url_value" value="<?php echo base_url(); ?>" /> 
	

<div id="copyrights" style='display:none;'>
    	<div class="container">
			<div class="col-lg-5 col-md-6 col-sm-12">
            	<div class="copyright-text">
                    <p> &copy; <?php echo date('Y'); ?> - <?php echo WEBSITENAME; ?></p>
                </div><!-- end copyright-text -->
			</div><!-- end widget -->
			<div class="col-lg-7 col-md-6 col-sm-12 clearfix">
				<div class="footer-menu">
                    <ul class="menu">
					<?php 
					if($checklogin){
					$logintype		=	$this->session->userdata('logintype');
								if(trim($logintype)=="bldadmin")
									{
					
					?>
					 <li>   
							<a href="<?php echo site_url("building/allgatekeepers"); ?>">Gate Keeper</a>
						</li>
						
						<li> 
							<a href="<?php echo site_url("building/allflats"); ?>">Flats</a> 
						</li>
						
						<li>
						<a href="<?php echo site_url("building/visitors-logs"); ?>">Visitor's Log</a>
						</li>
						
						
						<li>
						<a href="<?php echo site_url("building/activities"); ?>">Activities</a>
						</li>  

						<?php }else{ ?>	
						<li>
							<a class="" href="<?php echo base_url(); ?>">
								Dashboard
							</a>
						</li>
						
                        <li>
							<a href="<?php echo base_url('information/testimonials'); ?>">Testimonials</a>
						</li> 						
						
                        <li>
							<a href="<?php echo base_url('information/gallery'); ?>">Gallery</a>
						</li> 						
						
                        <li>
							<a href="<?php echo base_url('information/videos'); ?>">Videos</a>
						</li> 						
						
                        <li>
							<a href="<?php echo base_url('information/appointment'); ?>">Appointment</a>
						</li> 						
						
                        <li>
							<a href="<?php echo base_url('information/contact'); ?>">Contact Query</a>
						</li> 
                        <li>
							<a href="<?php echo base_url('information/Setting'); ?>">Setting</a>
						</li> 
				<?php
				}  }
					if($checklogin)
							{
				?>
                        <li>
							<a href="<?php echo base_url('information/logout'); ?>">Logout</a>
						</li>
				<?php
							} else {
				?>
                        <li>
							<a href="<?php echo base_url('information'); ?>">Login</a>
						</li>
				<?php
							}
				?>
					</ul>
					
                </div>
			</div><!-- end large-7 --> 
        </div><!-- end container -->
    </div><!-- end copyrights -->
    
	<div class="dmtop">Scroll to Top</div>
        
  <!-- Main Scripts-->
  <script src="<?php echo base_url()."assets/front/" ?>js/sjainventures.js?version=<?php echo time(); ?>"></script> 
  <script src="<?php echo base_url()."assets/front/" ?>js/admin.js?version=<?php echo time(); ?>"></script> 
  <script src="<?php echo base_url()."assets/front/" ?>js/samtab.js?version=<?php echo time(); ?>"></script> 
  <script src="<?php echo base_url()."assets/front/" ?>js/menu.js"></script>
  <script src="<?php echo base_url()."assets/front/" ?>js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url()."assets/front/" ?>js/jquery.parallax-1.1.3.js"></script>
  <script src="<?php echo base_url()."assets/front/" ?>js/jquery.simple-text-rotator.js"></script>
  <script src="<?php echo base_url()."assets/front/" ?>js/wow.min.js"></script>
  <script src="<?php echo base_url()."assets/front/" ?>js/custom.js"></script>
  
  <script src="<?php echo base_url()."assets/front/" ?>js/jquery.isotope.min.js"></script>
  <script src="<?php echo base_url()."assets/front/" ?>js/custom-portfolio-masonry.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

  <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
  <script type="text/javascript" src="<?php echo base_url()."assets/front/" ?>rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url()."assets/front/" ?>rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
  <script type="text/javascript">
	var revapi;
	jQuery(document).ready(function() {
		revapi = jQuery('.tp-banner').revolution(
		{
			delay:9000,
			startwidth:1170,
			startheight:500,
			hideThumbs:10,
			fullWidth:"on",
			forceFullWidth:"on"
		});
	});	//ready
  </script>
      
  <!-- Royal Slider script files -->
  <script src="<?php  echo base_url(); ?>assets/front/royalslider/jquery.easing-1.3.js"></script>
  <script src="<?php  echo base_url(); ?>assets/front/royalslider/jquery.royalslider.min.js"></script>
  		
  <script>
	jQuery(document).ready(function($) {
	  var rsi = $('#slider-in-laptop').royalSlider({
		autoHeight: false,
		arrowsNav: false,
		fadeinLoadedSlide: false,
		controlNavigationSpacing: 0,
		controlNavigation: 'bullets',
		imageScaleMode: 'fill',
		imageAlignCenter: true,
		loop: false,
		loopRewind: false,
		numImagesToPreload: 6,
		keyboardNavEnabled: true,
		autoScaleSlider: true,  
		autoScaleSliderWidth: 486,     
		autoScaleSliderHeight: 315,
	
		/* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
		imgWidth: 792,
		imgHeight: 479
	
	  }).data('royalSlider');
	  $('#slider-next').click(function() {
		rsi.next();
	  });
	  $('#slider-prev').click(function() {
		rsi.prev();
	  });
	});
  </script>

  <!-- Affix menu -->
<script>
	(function($) {
	  "use strict";
			$("#header-style-1").affix({
			offset: {
			  top: 1200
			, bottom: function () {
				return (this.bottom = $('#copyrights').outerHeight(true))
			  }
			}
		})
	})($);
	
	
	
	
</script>


</body>
</html>
