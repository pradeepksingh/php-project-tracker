

		<div id="content">

			<h1>Edit Changelogs - Viewing Releases For <code><?=$project->project_name?></code></h1>

			<p>Select a release for project <code><?=$project->project_name?></code> from below to edit changelogs for a specific release.</p>

			<h2>Releases</h2>

			<?php if ( $project_releases === NULL ) : ?>
			<p>There are no releases for this project.</p>
			<p><a href="<?=site_url('admin/newrelease/'.$project->alias)?>">
			Add one</a> now.</p>

			<?php else : ?>

			<ul>

				<?php foreach ( $project_releases->result() as $release ) : ?>
				<li>
					Project Version: <?=$release->project_version?> - 
					<a href="<?=site_url('admin/editchangelog/'.$project->alias.'/'.$release->project_version)?>">
					View Changelogs</a>
				</li>
				<?php endforeach; ?>

			</ul>		

			<?php endif; ?>

			<div class="push">

								</div>

		</div>