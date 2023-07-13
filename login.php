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
							<div class="login-form form-item form-stl">
								<form name="frm-login" class="login_form form">
									<fieldset class="wrap-title">
										<h3 class="form-title">Log in to your account</h3>										
									</fieldset>
									<fieldset class="wrap-input">
										<label for="frm-login-uname">Email Address:</label>
										<input type="text" id="login_email" name="login_email" placeholder="Type your email address">
									</fieldset>
									<fieldset class="wrap-input text-start">
										<label for="frm-login-pass">Password:</label>
										<input type="password" id="login_pass" name="login_pass" placeholder="************">
									</fieldset>
									</fieldset>
									<input style="width:100%;" type="submit" class="btn btn-submit" value="Login" name="submit" onclick="login_form_submit()">
									<div style="display:none; margin-top:10px" class="alert alert-success login_success"></div>
                                    <div style="display:none; margin-top:10px" class="alert alert-danger login_error"></div>
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