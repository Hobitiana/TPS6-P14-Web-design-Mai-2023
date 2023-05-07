
<div id="container">
	<h1>Gestion de Vehicule</h1>

	<div id="body">
				<!-- Icon -->
			<div class="fadeIn first">
			  <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
			  <h3>Login Admin</h3>
			</div>

			<!-- Login Form -->
			<form method="POST" action="<?php echo site_url('Coeur/traitementLogA'); ?>">		   
			  <input type="text" id="login" class="fadeIn second" name="username" placeholder="login Admin" required> 
			<?php echo form_error('username'); ?>			  
			 <input type="password" id="password" class="fadeIn third" name="pass" placeholder="password" required> 
			 <?php echo form_error('pass'); ?>	
			  <input type="submit" class="fadeIn fourth"  name="Submit" value="Login">
			</form>

			<!-- Remind Passowrd -->
			<div id="formFooter">
			  <a class="underlineHover" href="#">Forgot Password?</a>
			</div>
		</div>
 <?php if($msgerror= $this->session->flashdata('error')){?> 
	
			<div class="alert bg-danger">
			 <?=$msgerror ?>
			</div>
<?php } ?>

</div>
