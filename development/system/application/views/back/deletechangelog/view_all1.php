

		<div id="content">

			<script type="text/javascript">

				$(document).ready( function ()
				{
					$('span.showhide').hover( function ()
					{
						$(this).css('cursor', 'pointer');
					}, function ()
					{
						$(this).css('cursor', 'default');
					})
					.click( function ()
					{
						$(this).next().toggle('medium');
					}
					);
					$('ul.changelog').css('display', 'none');
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

			<h2>Projects</h2>			

			<?php if ( $changelogs === NULL ) : ?>
			<p>No projects to show.</p>
			<p><a href="<?=site_url('admin/create')?>">Create one</a> now.</p>

			<?php else : ?>

			<ul class="changelogs">

				<?php foreach ( $changelogs as $key => $log_arr ) : ?>
				<li>

					<?=$key?> <span class='showhide'>(show)</span>

					<ul class="changelog"> 

					<?php if ( count ( $log_arr ) < 1 ) :?>

						<li>No changelogs for this release.</li>

					<?php else : 
						foreach ( $log_arr as $key => $log ) : ?>

						<li>
							<span class='proj_ver'>Project Version: <?=$log['proj_ver']?></span>
							<ul>
								<li class='log_title'><?=$log['log_title']?></li>
								<li class='log_type alt'><?=$log['log_type']?></li>
								<li class='log_date'><?=$log['log_date']?></li>
								<li class='log_desc alt'><?=$log['log_desc']?></li>
							</ul>
						</li>

						<?php endforeach; ?>

					</ul>

					<?php endif; ?>

				</li>

				<?php endforeach; ?>

			</ul>

			<?php endif; ?>

			<div class="push">

								</div>
		</div>