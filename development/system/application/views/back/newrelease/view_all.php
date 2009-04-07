
			<div id="content">
			
				<h1>New Project Release</h1>
				
				<p>Using this page you can add a new project release for the selected project. 
				This page is <b>not</b> for creating <b>new projects</b>, but for adding releases for 
				and already available project.</p>
				
				<p>Please select a project from below.</p>
				
				<h2>Projects</h2>
				
				<?php if ( $project_results === NULL ) : ?>
				<p>No projects to show. </p>
				<p><a href="<?=site_url('admin/create/')?>">Create one now</a></p>
				
				<?php else : ?>
				
				<ul>
					<?php foreach ( $project_results->result() as $project ) : ?>
					
					<li>
						<a href='<?=site_url("admin/newrelease/{$project->alias}/")?>'>
						<?=$project->project_name?>
						</a>
					</li>
					
					<?php endforeach; ?>
				</ul>
				
				<?php endif; ?>
				
				<div class="push">

				</div>
					
				
			</div>
			