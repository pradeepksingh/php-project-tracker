
		<div id="content">
		
			<h1>Login Required For Access</h1>
			
			
			<p>You have tried to access a page that requires authentication! We don't want you doing
			anything you shouldn't be doing, now. <i>Would we?</i></p>
			<p>Go ahead and login with your correct <i>username</i> and <i>password</i>, and life will
			 be OK once more.</p>
			 
			<h2>Log In Form</h2>
			
			<?php if ( strlen ( validation_errors() ) > 0 ) : ?>
			<div id="errors">
				<ul>
					<?=validation_errors()?>
				</ul>
			</div>
			<?php endif; ?>
			
			<fieldset>
				<legend>Admin</legend>
				
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				
					<table>
					 <tr>
					  <td>Username:</td> <td><input type="text" name="username" /></td>
					 </tr>
					 <tr>
					  <td>Password:</td> <td><input type="password" name="password" /></td>
					 </tr>
					 <tr>
					  <td align="right" colspan="2"><input type="submit" name="log_in" value="Log In" /></td>
					 </tr>
					</table>
				
				</form>
				
			</fieldset>
			
			<h2>What's that?</h2>
			<p>You don't have access? Poop!</p>
			<p>Please get in touch with the <a href="<?=ROOTURIPATH?>users/admin/">admin</a>, if you would like to be part of our development team.</p>
			
			<div class="push">

				</div>
		
		</div>