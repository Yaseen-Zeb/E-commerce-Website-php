<?php
 include "header.php";
?>
	<!--main area-->
	<main id="main" class="main-site left-sidebar">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">							
					<div class=" main-content-area">
						<div class="wrap-login-item ">
							<div class="register-form form-item ">
								<form class="form-stl form reg_form" action="#" name="frm-reg">
									<fieldset class="wrap-title">
										<h3 class="form-title">Create an account</h3>
										<h4 class="form-subtitle">Personal infomation</h4>
									</fieldset>									
									<fieldset class="wrap-input">
										<label for="frm-reg-lname">Name*</label>
										<input type="text" id="reg_name" name="reg_name" placeholder="Full name*">
									</fieldset>
									<fieldset class="wrap-title">
									<h3 class="form-title" style="margin-bottom: -7px;margin-top: 15px;">Login Information</h3>
									<fieldset class="wrap-input">
										<label for="frm-reg-email">Email Address*</label>
										<input type="email" id="reg_email" name="reg_email" placeholder="Email address">
									</fieldset>
									
									</fieldset>
									<fieldset class="wrap-input item-width-in-half left-item ">
										<label for="frm-reg-pass">Password *</label>
										<input type="text" id="reg_pass" name="reg_pass" placeholder="Password">
									</fieldset>
									<fieldset class="wrap-input item-width-in-half ">
										<label for="frm-reg-cfpass">Confirm Password *</label>
										<input type="text" id="reg_cfpass" name="reg_cpass" placeholder="Confirm Password">
									</fieldset>
									
									<input style="width:100%;" type="submit" class="btn btn-sign" value="Register" name="register" onclick="reg_form_submit()">
									<div style="display:none; margin-top:10px" class="alert alert-success reg_success"></div>
                                    <div style="display:none; margin-top:10px" class="alert alert-danger reg_error"></div>
								</form>
							</div>											
						</div>
					</div><!--end main products area-->		
				</div>
			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->


	<?php
 include "footer.php";
?>