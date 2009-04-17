

		<div id="content">
			
			<h1>Viewing All Projects</h1>
			
			<p>Select from the list below which project you would like to edit a release for.</p>
			
			<h2>Releases</h2>
			
			<?php if ( $projects === NULL ) : ?>
			<p>No projects to show.</p>
			<p><a href="<?=site_url('admin/create')?>">Create one</a> now.</p>
			
			<?php else : ?>
			<ul>
				<?php foreach ( $projects->result() as $project ) : ?>
				<li><a href="<?=site_url('admin/editrelease/'.$project->alias)?>">
				<?=$project->project_name?></a></li>
				<?php endforeach; ?>
			</ul>
			
			<?php endif; ?>
			
			<div id="push">
				
			</div>
			
		</div>