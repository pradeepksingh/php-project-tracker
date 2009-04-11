

		<div id="content">
			
			<h1>Edit Project Details</h1>
			
			<p>Use the form below to edit your project details.</p>
			
			<h2>Edit Project Form</h2>
			
			<fieldset style="margin-top: 30px;">
				<legend>Edit Project Details</legend>
				
				<?php if ( strlen ( validation_errors() ) > 0 ) : ?>
				<div id="errors">
					<h1>There were some errors.</h1>
					<ul>
						<?=validation_errors()?>
					</ul>
				</div>
				<?php endif; ?>
				
				<form method="post" action="<?=current_url()?>" style="padding-left: 50px;">
					
					<table>
						<tr>
							<td>Project Name:</td>
							<td><input type="text" name="project_name" value="<?=$project->project_name?>"/></td>
						</tr>
						<tr>
							<td>Project Author:</td>
							<td>
							<input type="text" name="project_author" readonly="readonly" value="<?=$project->project_author?>" /></td>
						</tr>
						<tr>
							<td>Project Description:</td>
							<td><textarea style="width: 22em; padding: 5px; border: 1px solid black;" rows="7" name="project_desc"><?=$project->project_desc?></textarea></td>
						</tr>
						<tr>
							<td align="right" colspan="2"><input type="submit" name="update" value="Update Project!" /></td>
						</tr>
					</table>
					
				</form>
			</fieldset>
			
			<div class="push">
				
			</div>
			
		</div>