		
		
		<div id="content">
			
			<h1>Viewing Releases for <?=$project->project_name?></h1>
			
			<p>Follow the link to access the changelogs for the release you want.</p>
			
			<h2>Releases</h2>
			
			<?php if ( $releases === NULL ) : ?>
			<p>There are no releases to show.</p>
			<p><a href="<?=site_url('admin/newrelease/'.$project->alias)?>">Add one</a> now.</p>
			
			<?php else : ?>
			
			<ul>
				<?php foreach ( $releases->result() as $release ) : ?>
				<li>
					Project Version: <?=$release->project_version?> -
					<a href="<?=site_url('admin/deletechangelog/'.$project->alias.'/'.$release->project_version)?>">
					View Changelogs</a>
				</li>
				<?php endforeach; ?>
			</ul>
			
			<?php endif; ?>
			
			<div class="push">
				
			</div>
			
		</div>