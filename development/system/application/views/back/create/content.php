
			<div id="content">
			
			<!-- script can go here //-->
			<script type="text/javascript">
			
			function update_zip(box_obj)
			{
				var el = document.getElementById("create_zip");
				if(box_obj.checked == true)
				{
					el.innerText = "Yes please!";
				}
				else
				{
					el.innerText = "No!"
				}
			}
			
			</script>
			
			
				<h1>Admin Area - Create New Project</h1>
				
				<p>Welcome the the <i>Create New Project</i> area. Please use the form - given below - to upload a new project. Be careful with the details you give, regarding the new project; while it's possible to edit the project and it's details <b>after</b> the creation of it, it's generally good practice and <b>smart</b> to get things right the first time. If you are suspected of malicious intentions, be it uploading a virus, editing the database content with bad-intentions, etc., you will be stripped of your priviledges until an administrator can review the issue. In the words of Eminem: <i>Be smart, don't be a retard</i>.</p>
				
				<h2>Project Upload Form</h2>
				
				<!-- upload form //-->
				<fieldset style="margin-top: 30px">
				 	<legend>Admin Area - Create New Project</legend>
				 	
				 	<?php
				 		if ( strlen ( validation_errors() ) > 0 ) :
				 		?>
				 		<div id="errors">
				 			<h1>Oops! We hit some errors..</h1>
				 			<ul>
								<?php echo validation_errors(); ?>
							</ul>
						</div>
					<?php endif; ?>
				 	
				 	<p>Please remember that this is for creating <b>new projects</b> - not for adding new <b>project releases</b>. To add a project release, go <a href="../new-release/">here</a>. If you try to create a project that already exists, it will fail. If you intentionally want to overwrite the project, delete it first, and then create the new project.</p>
					<form action="<?=current_url()?>" method="post" style="padding-left: 50px">
					
					<table>
						<tr>
							<td>Project Name:</td>
							<td><input type="text" name="project_name" value="<?=set_value('project_name')?>"/></td>
						</tr>
						<tr>
							<td>Project Author:</td>
							<td><input type="text" name="project_author" readonly="readonly" value="<?=$this->session->userdata('username')?>" /></td>
						</tr>
						<tr>
							<td>Project Description:</td>
							<td><textarea style="width: 22em; padding: 5px; border: 1px solid black;" rows="7" name="project_desc"><?=set_value('project_desc')?></textarea></td>
						</tr>
						<tr>
							<td align="right" colspan="2"><input type="submit" name="submit_project" value="Create Project!" /></td>
						</tr>
					</table>
					
					</form>
				
				<h2>Notes</h2>
				<ul style="font-size: 11px;">
					<li>All fields are required.</li>
					<li><b>Project Author</b> is a <code>READONLY</code> field; it is populated with your current log-in username.</li>
					<li>Meaningful <b>Project Description</b>'s are a must. A description that doesn't describe the project will only turn away any potential users.</li>
				</ul>
				</fieldset>
			
			<div class="push">

				</div>
			</div>