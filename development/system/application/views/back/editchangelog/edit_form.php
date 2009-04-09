

		<div id="content">
			
			<h1>Editing Changelog</h1>
			
			<p>Use the form below to edit the changelog for release <code><?=$changelog->project_version?></code> of
			<?=$project->project_name?></p>
			
			<h2>Changelog</h2>
			
			<style type="text/css">
					div#changelog_container {
						background-color: beige;
					}
					div.changelog {
						padding: 10px;
						height: 220px;
					}
					div.title_text, div.desc_text, div.type_text  {
						font-size: 20px;
						font-family: Lucida, serif;
						width: 40%;
					}
					div.title_input, div.desc_input, div.type_input {
						width: 60%;
						float: right;
					}
					input.input_i, textarea.desc_textarea {
						width: 320px;
						padding: 5px;
						border: 1px solid black;
					}
					textarea.desc_textarea {
						height: 140px;
					}
					div.changelog_type {
						font-size: 12px;
					}
					div.type_text {
					}
					input.type_i {
					}
					div#add_row {
						font-size: 30px;
					}
					div#add_row:hover {
						cursor: pointer;
					}
					div#submit {
						width: 100%;
						text-align: center;
					}
					div#submit input {
						width: 50%;
						margin: 10px;
						height: 30px;
					}
				</style>
			
			<fieldset style="margin-top: 30px">
				<legend>Changelog Edit Form</legend>
				
				<?php if ( strlen ( validation_errors() ) > 0 ) : ?>
				<div id="errors">
					<ul>
						<?=validation_errors()?>
					</ul>
				</div>
				<?php endif; ?>
				
				<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
				
					<div id="changelog_container">
						<div class="changelog top_log">

							<div class="changelog_title">
	
								<div class="title_input">
									<input type="text" name="title" class="input_i" 
									value="<?=$changelog->log_title?>" />
								</div>
								<div class="title_text">
									Changelog Title:
								</div>
	
							</div>
	
							<div class="changelog_type">
	
								<div class="type_input">
									<input type="text" name="type" class="type_i input_i" 
									value="<?=$changelog->log_type?>"/>
								</div>
								<div class="type_text">
									Type:
								</div>
	
							</div>
	
							<div class="changelog_desc">
	
								<div class="desc_input">
									<textarea name="desc" class="desc_textarea"><?=$changelog->log_desc?></textarea>
								</div>
								<div class="desc_text">
									Changelog Description:
								</div>
	
							</div>
	
						</div>
						
						<div id="submit">
								<input type="submit" name="update" value="Update" />
						</div>
					</div>
					
				</form>
				
			</fieldset>
			
			<div class="push">
				
			</div>
			
		</div>