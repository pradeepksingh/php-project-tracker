

		<div id="content">
			
			<h1>Viewing Changelogs for Release <?=$this->uri->segment(4)?></h1>
			
			<p>Below you can delete changelogs by using the below tools. Deleted changelogs cannot be undeleted.</p>
			
			<h2>Changelogs</h2>
			
			<style type="text/css">

				.showhide {
					font-size: 10px;
				}
				#content ul {
					margin: 15px 40px;
					padding: 0;
				}
				#content li {
					list-style-type: none;
					margin: 0;
					padding: 0;
					font: 14px "Lucida Grande", "Trebuchet MS", Verdana, sans-serif;
				}
				#content li ul li {
					list-style-type: none;
					font: 13px Verdana, serif;
					line-height: 20px;
					padding: 2px;
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
					font-size: 10px;
					font-family: Helvetica, serif;
				}
				#content .log_type {
					font-size: 10px;
					font-family: Helvetica, serif;
				}

			</style>
			
			<?php if ( $changelogs === NULL ) : ?>
			<p>No changelogs to show.</p>
			<p><a href="<?=site_url('admin/addchangelog/'.$project->alias)?>">Add one</a> now.</p>
			
			<?php else : ?>
			<ul>
				<?php foreach ( $changelogs->result() as $changelog ) : ?>
				<li>
					<span class="log_title"><?=$changelog->log_title?></span>
					(<a href="
					<?=site_url('admin/deletechangelog/'.$project->alias.'/'
														.$changelog->project_version.'/'
														.$changelog->id)?>">delete</a>)
					<ul>
						<li class="log_type alt"><?=$changelog->log_type?></li>
						<li class="log_date"><?=$changelog->log_date?></li>
						<li class="log_desc alt"><?=$changelog->log_desc?></li>
					</ul>
				</li>
				<?php endforeach; ?>
			</ul>
			
			<?php endif; ?>
			
			<div class="push">
				
			</div>
			
			
		</div>