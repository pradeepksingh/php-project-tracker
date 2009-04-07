
		
		<div id="content">
			
			<h1>Viewing Changelogs - <code><?=$project->project_name?> :: <?=$this->uri->segment( 4 )?></code></h1>
			
			<p>All changelogs for release <?=$this->uri->segment( 4 )?> of project 
			<strong><?=$project->project_name?></strong></p>
			
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
			<p>No changelogs can be found for this release.</p>
			<p><a href="<?=site_url('admin/addchangelog/'.$project->alias)?>">Add them</a> now.</p>
			
			
			
			<?php else : ?>
			<ul>
				
				<?php foreach ( $changelogs->result() as $changelog ) : ?>
				<li>
					<span class="log_title"><?=$changelog->log_title?></span> 
					(<a href="<?=site_url('admin/editchangelog/'.$project->alias.'/'.$changelog->id)?>">edit</a>)
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