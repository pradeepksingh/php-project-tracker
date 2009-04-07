

		<div id="content">
			
			<h1>Add Changelog - <?=$project->project_name?></h1>
			
			<p>Use the below form to add multiple changelogs for the release <code><?=$release?></code>.</p>
			
			<fieldset style="margin-top: 30px;">
				<legend>Add Changelog</legend>
				
				<?php if ( strlen ( validation_errors() ) > 0 ) : ?>
				<div id="errors">
					<ul>
						<?=validation_errors()?>
					</ul>
				</div>
				<?php endif; ?>
				
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
				<script type="text/javascript">
					
					$(document).ready( function ()
					{
					
						$('#add_row').click( function ()
						{
							// We need to clone the 'top_log' div
							var clone = $('.top_log').clone();
							$(clone).attr('class', 'changelog');
							$(':input', clone).attr('value', '');
							$(clone).insertBefore('#add_row');
						});
					
					});
					
				</script>
				
				<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div id="changelog_container">
				
				<?php if ( isset ( $_POST['title'] ) && 
				count ( $this->input->post('title') ) > 0 ) : ?>
				
				<?php foreach ( $this->input->post('title') as $x => $y ) : ?>
					
					<div class="changelog top_log">
					
						<div class="changelog_title">
							
							<div class="title_input">
								<input type="text" name="title[]" class="input_i" 
								value="<?=$_POST['title'][$x]?>" />
							</div>
							<div class="title_text">
								Changelog Title:
							</div>
							
						</div>
						
						<div class="changelog_type">
							
							<div class="type_input">
								<input type="text" name="type[]" class="type_i input_i" 
								value="<?=$_POST['type'][$x]?>"/>
							</div>
							<div class="type_text">
								Type:
							</div>
							
						</div>
						
						<div class="changelog_desc">
							
							<div class="desc_input">
								<textarea name="desc[]" class="desc_textarea"><?=$_POST['desc'][$x]?></textarea>
							</div>
							<div class="desc_text">
								Changelog Description:
							</div>
							
						</div>
						
					</div>
					
				<?php endforeach; ?>
				
				<?php else : ?>
				
					<div class="changelog top_log">

						<div class="changelog_title">

							<div class="title_input">
								<input type="text" name="title[]" class="input_i" />
							</div>
							<div class="title_text">
								Changelog Title:
							</div>

						</div>

						<div class="changelog_type">

							<div class="type_input">
								<input type="text" name="type[]" class="type_i input_i" />
							</div>
							<div class="type_text">
								Type:
							</div>

						</div>

						<div class="changelog_desc">

							<div class="desc_input">
								<textarea name="desc[]" class="desc_textarea"></textarea>
							</div>
							<div class="desc_text">
								Changelog Description:
							</div>

						</div>

					</div>
					
				<?php endif; ?>
					
					<div id="add_row">
						
						<p>+</p>
						
					</div>
					
					<div id="submit">
						<input type="submit" name="add_changelogs" value="Add Changelog(s)" />
					</div>
					
				</div>
				</form>
			</fieldset>
			
		</div>