
		<style type="text/css">

				.showhide {
					font-size: 10px;
				}
				#content ul {
					margin: 10px 40px;
					padding: 0;
				}
				#content li {
					list-style-type: none;
					margin: 0;
					padding: 0;
					font: 14px "Lucida Grande", "Trebuchet MS", Verdana, sans-serif;
				}
				#content li ul li {
					list-style-type: circle;
					font: 13px Verdana, serif;
				} 
				#content li ul li ul li {
					list-style-type: none;
					font: 11px "Lucida Grande" sans-serif;
					padding: 5px;
				}
				#content .alt {
					background-color: beige;
				}
				#content .log_title {
					font-weight: bold;
					font-size: 14px;
				}
				#content .log_date {
					font-size: 8px;
					font-family: Helvetica, serif;
				}
				h3 {
					font-size: 20px;
					margin: 20px;
				}

			</style>
		<div id="content">
			
			<h1>Add Changelog - Viewing Project <code><?=$project->project_name?></code></h1>
			
			<p>Project <code><?=$project->project_name?></code> and it's releases.</p>
			
			<h2>Releases</h2>
			
			<h3><?=$project->project_name?></h3>
			<?php if ( $project_releases === NULL ) : ?>
			<p>No releases for this project. 
			<a href="<?=site_url('admin/newrelease/'.$project->alias)?>">Add one</a> now.</p>
			
			<?php else : ?>
			
			<ul class="changelogs">
				<?php foreach ( $project_releases->result() as $release ) : ?>
				<li><span class='alt'>Project Version: <?=$release->project_version?> - 
				<a href='<?=site_url('admin/addchangelog/'.$project->alias.'/'.$release->project_version)
				?>'>Add Changelog</a></li>
				<?php endforeach; ?>
			</ul>
			
			<?php endif; ?>
			
			
			<div class="push">

								</div>
			
		</div>