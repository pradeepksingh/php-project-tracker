

		<div id="content">
			
			<h1>Viewing All Projects</h1>
			
			<p>Follow the link provided to access the releases of a project. You can then select a specific
			release to edit the changelogs for.</p>
			
			<h2>Projects</h2>
			
			<?php if ( $projects === NULL ) : ?>
			<p>No Projects to show.</p>
			<p><a href="<?=site_url('admin/create')?>">Add one</a> now.</p>
			
			<?php else : ?>
			
			<ul>
				<?php foreach ( $projects->result() as $project ) : ?>
				<li><a href="<?=site_url('admin/editchangelog/'.$project->alias)?>">
				<?=$project->project_name?></a></li>
				<?php endforeach; ?>
			</ul>
			
			<?php endif; ?>
			
			<div class="push">

								</div>
			
		</div>