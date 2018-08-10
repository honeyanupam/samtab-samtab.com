<?php include('include/header.php'); ?>
    
    
    <!-- Login Area Start -->
    <section class="bleezy-login-page-area section_100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-page-box">
                        <div class="login-page-heading">
                            <i class="fa fa-key"></i>
                            <h3>Enquire Now</h3>
                        </div>
					<form  method="POST" class="login-form contactusform" onsubmit="return contactus();">
						<div class="row">
								<div class="col-md-12">	
									<label>Name</label>
									<div class="account-form-group">
										<input type="text" placeholder="" name="name" id='name'>
									</div>
								</div>
								<div class="col-md-12">	
									<label>E-Mail (where we can send you more information)</label>
									<div class="account-form-group">
										<input type="email" placeholder="" name="email" id='email'>
									</div>
								</div>
								<div class="col-md-12">	
									<label>Mobile Number</label>
									<div class="account-form-group">
										<input type="number" placeholder="" name="mobile" id='mobile'>
									</div>
								</div>
								<div class="col-md-12">	
									<label>Message</label>
									<div >
										<textarea name='message' id='message' class="account-form-group account-form-group-textarea" rows="5" cols="46" name="comment" form="usrform"></textarea>
									</div>
								</div>
						</div>	
						<p class="alert hideme contactusmessage form-group"></p> 
                        <div class="login-sign-up">
							<p>
								<button type="submit" name='contactusf'>Enquiry Now ! </button>
							</p>
                        </div>
					</form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Area End -->
    
    
  <?php include('include/footer.php'); ?>