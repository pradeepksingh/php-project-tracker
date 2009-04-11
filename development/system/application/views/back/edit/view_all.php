

		<div id="content">
			
			<h1>Viewing All Projects</h1>
			
			<p>Please select a project from below to edit the details for.</p>
			
			<h2>Projects</h2>
			
			<?php if ( $projects === NULL ) : ?>
			<p>No projects to show.</p>
			<p><a href="<?=site_url('admin/create')?>">Create one</a> now.</p>
			
			<?php else : ?>
			
			<ul>
				<?php foreach ( $projects->result() as $project ) : ?>
				<li>
					<a href="<?=site_url('admin/edit/'.$project->alias)?>"><?=$project->project_name?></a>
				</li>				
				<?php endforeach; ?>
			</ul>
			
			<?php endif; ?>
			
		</div>