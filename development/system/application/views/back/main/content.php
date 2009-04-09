
			<div id="content">
			
				<h1>Admin Area</h1>
				
				<p>Welcome to our administration area for the development of applications, programs 
				and scripts written by those who operate <b>mahcuz.com</b>. Here, if you have the correct permissions, you may create new projects, edit existing projects, delete existing projects, etc. Please be careful and wise about your actions - a deleted project cannot be 'revived'.</p>
				
				<p>Use the navigation below to use the administration area.</p>
				
				<h2>Admin Navigation</h2>
				
				<style type="text/css">
					#content ul li ul {
						margin-top: 10px;
						margin-bottom: 10px;
						margin-left: 10px;
					}
					#content ul li ul li a {
						color: brown;
						letter-spacing: 0;
					}
				</style>
				<ul>
				
					<li>
						<a href="<?=site_url('admin/create/')?>">Create new project</a>
						<ul>
							<li><a href="<?=site_url('admin/edit/')?>">Edit Project</a></li>
							<li><a href="<?=site_url('admin/delete/')?>">Delete Project</a></li>
						</ul>
					</li>
					
					<li>
						<a href="<?=site_url('admin/newrelease/')?>">Add a new release for an existing project</a>
						<ul>
							<li><a href="<?=site_url('admin/editrelease/')?>">Edit Release</a></li>
							<li><a href="<?=site_url('admin/deleterelease/')?>">Delete Release</a></li>
						</ul>
					</li>
					
					<li>
						<a href="<?=site_url('admin/addchangelog/')?>">Add changelogs for a release</a>
						<ul>
							<li><a href="<?=site_url('admin/editchangelog/')?>">Edit Changelog</a></li>
							<li><a href="<?=site_url('admin/deletechangelog/')?>">Delete Changelog</a></li>
						</ul>
					</li>
				
				</ul>
				
				<div class="push">
					
				</div>
			
			</div>
			