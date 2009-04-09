		
		
		<div id="content">
		
			<script type="text/javascript">
				
				$(document).ready( function ()
				{
				});
			</script>
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
					font: 22px "Lucida Grande", "Trebuchet MS", Verdana, sans-serif;
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
				
			</style>
			
			<h1>Add Changelog - Viewing All Projects</h1>
			
			<p>All projects and their releases are listed below.</p>

			<h2>Projects.</h2>			
			
			<?php if ( $projects === NULL ) : ?>
			<p>No projects to show.</p>
			<p><a href="<?=site_url('admin/create')?>">Create one</a> now.</p>
			
			<?php else : ?>
			
			<ul class="changelogs">
				
				<?php foreach ( $projects->result_array() as $key => $project ) : ?>
				<li>
					
					<ul class="changelog"> 
					
					<?php if ( $project['has_release'] ) : 
						$releases = $this->project->get_releases_by_project( $project['project_name'] );
						foreach ( $releases->result_array() as $key => $release ) :
					?>
						
						<li>
							<span class="log_title"><?=$release['project_name']?></span>
							<span class='alt'>Project Version: 
							<a href='<?=site_url("main/viewchangelog/".$project['alias']."/".$release['project_version'])?>'>
							<?=$release['project_version']?></a> - 
							<a href='<?=site_url("admin/addchangelog/".$project['alias']."/".$release['project_version'])?>'>(add changelog)</a></span>
						</li>
						
					
					
					<?php endforeach; ?>
					
					<?php else : ?>
						<li>No releases for project <code><?=$project['project_name']?></code></li>
					<?php endif; ?>
					
					</ul>
					
				</li>
				
				<?php endforeach; ?>
				
			</ul>
			
			<?php endif; ?>
			
			<div class="push">

								</div>
		</div>