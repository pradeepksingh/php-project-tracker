<?php


/**
 * This file will handle all the backend operations
 * that occurr in the development area.
 * These operations will include:
 * - creating new projects,
 * - deleting projects,
 * - updating projects,
 * etc.
 */
 
class Admin extends Controller
{
	/**
	 * Properties.
	 */
	private 	$_area 		= 'back';		// Used for loading view for correct section.
	 
	/**
	 * @access public
	 */
	function Admin()
	{
		parent::Controller();
		
		// Load libraries we need.
			$this->load->library('session');
			$this->load->library('form_validation');
			// Set our delimiters (form_val)
				$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		// Load models (second param is alias).
			$this->load->model('Project_model', 'project');
			$this->load->model('User_model', 'user');
			
		// Load helpers.
			$this->load->helper('url');
			$this->load->helper('form');
			$this->load->helper('user_auth');
		
		// Profiling - DEBUGGING ONLY
			$this->output->enable_profiler( TRUE );
			
		
		// check with user_auth that user is an admin.
		// basically compares param 1 against param 2, in the 3rd param.
			if ( session_exists( 'access_level', 4, 'session' ) === FALSE 
					&& $this->uri->segment( 2 ) != 'login' )
			{
				redirect('admin/login/');
			}	
			else
			{
				$this->_username 		= $this->session->userdata( 'username' );
				$this->_access_level	= $this->session->userdata( 'access_lvl' );
			}	
	}
	
	/**
	 * @access public
	 */
	public function index()
	{
		$vars = 
			array (
				'area' 		=> $this->_area,
				'module'	=> 'main'
				);
		$this->load->view('loader', $vars);
	}
	
	
	/**
	 * @access public
	 */
	public function create()
	{
		$vars = 
			array (
				'area'		=> $this->_area,
				'module' 	=> __FUNCTION__
				);
		
		// Was the form submitted?
		if( $this->input->post( 'submit_project' ) !== FALSE )
		{
			//echo '<pre>';
			//print_r($_FILES);
			//print_r($_POST);
			//echo '</pre>';
			
			// Let's create some validation rules, using the 
			// form validation class.
			$rules = 
				array (
						array (
							'field' => 'project_name', // POST key.
							'label' => 'Project Name', // Human form.
							'rules' => 'trim|required|min_length[1]|max_length[40]|callback_project_exists[true]' // Rules - no comma.
							),
						array (
							'field' => 'project_author',
							'label' => 'Project Author',
							'rules' => 'trim|required|min_length[1]|max_length[40]|alpha|callback_username_exists[true]'
							),
						array (
							'field' => 'project_desc',
							'label' => 'Project Description',
							'rules' => 'trim|required|min_length[1]'
							)
						);
			$this->form_validation->set_rules( $rules );
			// Set a custom error message, to better describe what we want from 'project_stage'.
			$this->form_validation->set_message('integer', 
												'Please use the format <code>1.0.4</code> for your <strong>Project Version</strong>.' );
			// Run the validation, if evaluates for FALSE, return errors.
			if ( $this->form_validation->run() === FALSE )
			{
				$this->load->view( 'loader', $vars );
			}
			else
			{
				// Alias: URL friendly.
				$alias = strtolower( str_replace( ' ', '-', $this->input->post('project_name') ) );
				$data = 
					array (
						'project_name' 		=> $this->input->post('project_name'),
						'project_author' 	=> $this->input->post('project_author'),
						'project_desc'		=> $this->input->post('project_desc'),
						'alias'				=> $alias
						);
				// Pass our $data array to the commit_new_project() method.
				// Using Active Record, CI will sort the data for us, cleaning it
				// etc.
				$this->project->commit_new_project( $data );
				$vars['page'] = "done.php";
				$vars['new_release_link'] = "admin/newrelease/{$alias}";
				$this->load->view( 'loader.php', $vars );
			}
		}
		else
		{
			// Let's show the upload form
			$this->load->view('loader.php', $vars);
		}
	}
	
	public function newrelease()
	{	
		$vars['module'] = "newrelease";
		$vars['area'] 	= $this->_area;
		$vars['page'] 	= 'add_form';
		
		if ( $this->uri->segment( 3 ) === FALSE )
		{
			$vars['page'] 				= 'view_all';
			// Grab all the projects via our Project model
			// If there are no projects, the value returned is NULL.
			$vars['project_results']	= $this->project->get_all_projects();
			$this->load->view('loader', $vars);
		}
		else
		{
		
			// Grab project info.	
			// If there are no projects that match, $project will be NULL.
			$vars['project'] 		= $this->project->get_project( $this->uri->segment( 3 ) );
			if ( $this->project->project_exists_by_alias( $this->uri->segment( 3 ) ) === FALSE )
			{
				die( "That project doesn't exist." );
			}	
			// $project_info will hold data such as latest release, etc, providing there
			// is a release.
			if ( (bool) $vars['project']->has_release && $vars['project'] !== NULL )
			{
				$vars['project_info']	= $this->project->get_latest_project_info( $vars['project']->project_name );
				// $project_log holds ALL change logs associated with the project,
				// providing there is a valid project (with releases).
				$vars['project_log']	= $this->project->get_latest_changelog( $vars['project']->project_name, $vars['project_info']->project_version );
			}
			else
			{
				$vars['project_info']	= NULL;
				$vars['project_log']	= NULL;
			}
			if( $this->input->post( 'submit_release' ) !== FALSE )
			{
				// Run a few validation tests.
				// With arrays, remember your [] brackets.
				$rules = 
					array (
						array (
							'field' => 'project_name',
							'label' => 'Project Name',
							'rules' => 'required|min_length[4]|callback_project_exists[false]'
							),
						array (
							'field' => 'project_author',
							'label' => 'Project Author',
							'rules' => 'required|min_length[4]|callback_username_exists'
							),
						array (
							'field' => 'project_version',
							'label' => 'Project Version',
							'rules' => 'required|min_length[1]|callback_newer_version'
							)
					);
				$this->form_validation->set_rules( $rules );
				if ( $this->form_validation->run() !== TRUE )
				{
					// Form validation came back false
					// Show the upload form with errors.
					$vars['page'] = 'add_form';
					$this->load->view( 'loader', $vars );
				}
				else
				{
					// Form validation was a-ok.
					// We use a couple of extra libraries here.
					// The zip library, to create a zip archive of the
					// project file; and the upload library, to handle 
					// the uploading of the file. 
					// Check files exist.
					if ( $_FILES['file']['error'] === 0 )
					{
						$upload_path   = str_replace('\\', '/', BASEPATH . 'uploads/' . $_FILES['file']['name']);
						if ( copy( $_FILES['file']['tmp_name'], $upload_path ) === FALSE )
						{
							$vars['file_error'] = "Error.";
							$vars['page'] 		= 'add_form';
							$this->load->view( 'loader', $vars );
						}
						else
						{
							// File uploaded. Let's archive.
							$this->load->library('zip');
							$file_path = $upload_path . "/" . $_FILES['file']['name'];
							$arc_path  = $upload_path . "/zip/" . $_FILES['file']['name'] . ".zip";
							$this->load->library( 'zip' );
							// Read the uploaded file into a string for ZIP lib.
							$this->zip->read_file( $file_path );
							// And archive it.
							$this->zip->archive( $arc_path );
							// Now we have the archive done, let's do the database work.
							// Do we have to update the has_release flag?
							if ( (bool) $vars['project']->has_release === FALSE )
							{
								$this->project->set_has_release( TRUE, $this->uri->segment( 3 ) );
							}
							$data = 
								array (
									'project_name' 		=> $this->input->post( 'project_name' ),
									'project_author' 	=> $this->input->post( 'project_author' ),
									'project_stage' 	=> $this->input->post( 'project_stage' ),
									'project_version' 	=> $this->input->post( 'project_version' ),
									'project_download' 	=> $arc_path
								);
							$this->project->commit_new_release( $data );
							$vars['page'] 				= "release_added";
							$vars['release_version'] 	= $this->input->post( 'project_version' );
							$vars['project_name']		= $this->input->post( 'project_name' );
							$vars['changelog_link']		= "admin/addchangelog/{$this->uri->segment( 3 )}/{$vars['release_version']}/";
							$vars['version_link']		= "main/viewrelease/{$this->uri->segment( 3 )}/{$vars['release_version']}/";
							
							$this->load->view('loader', $vars);
						}
					}	
					else
					{
						die( "No File Uploaded" );
					}			
				}
			}
			else
			{
				$this->load->view('loader', $vars);
			}
		}
	}

	public function edit()
	{
		$x = "lol/lol";
		explode("/", $x);
	}
	
	/* ----------------------------------------------------- */
	/**
	 * CHANGELOGS.
	 * Section for adding, editing and deleting changelogs.
	 *
	 * addchangelog()
	 * 		1. If no project name is given, we list available projects 
	 * 		with a link to that project's changelog (admin/addchangelog/proj-name).
	 * 		2. Listed 'neath these project titles are all said projects available
	 * 		project versions, with link to their changelogs (main/viewchangelog/proj-name/1.1)
	 * 		and to their add changelog page (admin/addchangelog/proj-name/1.1
	 *
	 * 		If a (valid) project name is given an no project version, we repeat
	 * 		part 2 of the above.
	 *
	 * 		If we do have a (valid) proj name and (valid) proj version, we provide the 
	 * 		viewer with a form for adding new changelogs for said version
	 * 		and also display any changelogs for that version (if there are any).
	 * 		The form for adding changelogs initially starts with room for only
	 * 		1 changelog, but these can be dynamically added via jQuery.
	 *
	 * editchangelog()
	 *		Largely the same as addchangelog (namely parts 1 and 2, of course
	 *		with necessary adjustments - /addchangelog/ becomes /editchangelog/).
	 *		- Validate proj name (must exist - if not, send to admin/create/.
	 *		- Validate proj version (must exist - if not, redirect to addchangelog).
	 *		Instead of displaying a form if a proj ver is given, we need to display
	 *		all changelogs for that specific version, and in that display is a link
	 *		for each changelog, pointing to the edit page for that log. We use the
	 *		ID of the changelog (coming from DB) as the identifier.
	 *
	 *		If proj name, proj ver and log ID are all valid, we display the logs
	 *		info in a form for the user to change and then submit.
	 * deletechangelog()
	 *		Simplist of the methods.
	 *		Again, much like the above methods it requires proj name, proj ver
	 *		and proj ID - displaying the correct data for the combination of these
	 *		3.
	 *		- Validates the proj name, proj ver, and ID.
	 *		If all 3 are OK, we delete from db using the ID (segment(5)).
	 *
	 * --
	 * The flow of the methods isn't hard to understand. They all display data
	 * based on the sections given in the url.
	 */
	
	public function addchangelog ( ) 
	{
		$vars['module'] = 'addchangelog';
		$vars['area']   = $this->_area;
		
		// Is there a project given?
		if ( $this->uri->segment( 3 ) === FALSE )
		{
			// Get all projects and their releases.
			$vars['projects'] = $this->project->get_all_projects();
			$vars['page']	  = 'view_all';
			$this->load->view('loader', $vars);
		}
		// No version given.
		elseif ( $this->uri->segment( 4 ) === FALSE )
		{
			// Check the project exists. segment 3 of uri.
			if ( $this->project->project_exists_by_alias( $this->uri->segment( 3 ) ) === FALSE ) 
			{
				redirect('admin/create/');
			}
			// It exists.
			else
			{
				$vars['project'] 			= $this->project->get_project( $this->uri->segment( 3 ) );
				$vars['project_releases'] 	= $this->project->get_releases_by_project( $vars['project']->project_name );
				$vars['page']				= 'view_single';
				$this->load->view('loader', $vars);
			}	
		}
		// Version and Proj given.
		else
		{
			if ( $this->project->project_exists_by_alias( $this->uri->segment( 3 ) ) === FALSE )
			{
				redirect('admin/create/');
			}
			elseif ( $this->project->release_exists_by_alias( $this->uri->segment( 3 ),
			  		 $this->uri->segment( 4 ) ) === FALSE )
			{
				redirect('admin/newrelease/' . $this->uri->segment( 3 ));
			}
			else
			{
				$vars['project'] = $this->project->get_project( $this->uri->segment( 3 ) );
				$vars['release'] = $this->uri->segment( 4 );
				
				// Form was submitted.
				if ( $this->input->post('add_changelogs') !== FALSE )
				{
					if ( count ( $this->input->post('title') ) < 1 )
					{
						die( "There was a problem. Please make sure you fill out the logs correctly." );
					}
					// We strip out any changelogs that weren't filled out.
					// By this, I mean not any logs that had a single section missing, but logs
					// that are completely empty - title, desc, type.
					$this->remove_empty_logs( );
					// We require at least the title of the changelog.
					$this->form_validation->set_rules('title[]', 'Changelog Title', 'trim|required|min_length[1]');
					
					if ( $this->form_validation->run() !== FALSE )
					{
						// Passed validation. Add to database.
						$data = 
							array (
								'project_name' 		=> $vars['project']->project_name,
								'project_version' 	=> $vars['release']
							);
						foreach ( $_POST['title'] as $key => $title )
						{
							$data['log_type'] 	= $_POST['type'][$key];
							$data['log_title']	= $_POST['title'][$key];
							$data['log_desc']	= $_POST['desc'][$key];
							// Commit it.
							$this->project->commit_changelog( $data );
							redirect('main/view/' . $vars['project']->project_name);
						}
					}
					else
					{
						$vars['page'] = 'add_page';
						$this->load->view('loader', $vars);
					}
				}
				else
				{
					$vars['page'] 	 = 'add_page';
					$this->load->view('loader', $vars);
				}
			}
		}
	} 
	
	public function editchangelog ( )
	{
		
		$vars['module'] = 'editchangelog';
		$vars['area']	= $this->_area;
		
		// If we don't have a project name.
		if ( $this->uri->segment( 3 ) === FALSE )
		{
			
			// Show all changelogs, catagories by project name.
			$vars['projects'] = $this->project->get_all_projects();
			$vars['page']	  = 'view_all';
			$this->load->view('loader', $vars);
			
		}
		
		// We have a project name, but nothing else.
		elseif ( $this->uri->segment( 4 ) === FALSE )
		{
			
			// Project exists?
			if ( $this->project->project_exists_by_alias( $this->uri->segment( 3 ) ) === FALSE )
			{
				show_error("The given project <code>{$this->uri->segment( 3 )}</code> does not exist.");
				return;
			}
			
			// Load view with project info.
			$vars['project'] 			= $this->project->get_project( $this->uri->segment( 3 ) );
			$vars['project_releases'] 	= $this->project->get_releases_by_project( $vars['project']->project_name );
			$vars['page']				= 'view_project';
			$this->load->view('loader', $vars);
			
		}
		
		// We have project name, project release, but no changelog ID.
		elseif ( $this->uri->segment( 5 ) === FALSE )
		{
			
			// Project exists?
			if ( $this->project->project_exists_by_alias( $this->uri->segment( 3 ) ) === FALSE  )
			{
				show_error("The given project <code>{$this->uri->segment( 3 )}</code> does not exist.");
				return;
			}
			// Release exists?
			if ( $this->project->release_exists_by_alias( $this->uri->segment( 3 ),
														  $this->uri->segment( 4 ) ) === FALSE  )
			{
				show_error("The given release <code>{$this->uri->segment( 4 )} does not exist.");
				return;
			}
			
			$vars['project'] 	= $this->project->get_project( $this->uri->segment( 3 ) );
			$vars['changelogs'] = $this->project->get_changelogs_by_release( $vars['project']->project_name,
																			 $this->uri->segment( 4 ) );
			$vars['page']		= 'view_single';
			$this->load->view('loader', $vars);
			
		}
		
		// All information has been given.
		else
		{
			
			// Project exists?
			if ( $this->project->project_exists_by_alias( $this->uri->segment( 3 ) ) === FALSE  )
			{
				show_error("The given project <code>{$this->uri->segment( 3 )}</code> does not exist.");
				return;
			}
			// Release exists?
			if ( $this->project->release_exists_by_alias( $this->uri->segment( 3 ),
														  $this->uri->segment( 4 ) ) === FALSE  )
			{
				show_error("The given release <code>{$this->uri->segment( 4 )} does not exist.");
				return;
			}
			// Changelog id exists.
			if ( $this->project->changelog_exists_by_id( $this->uri->segment( 3 ),
														 $this->uri->segment( 4 ),
														 $this->uri->segment( 5 ) ) === FALSE )
			{
				show_error("The given ID is not valid or does not exist.");
				return;
			}
			
			// Load up the front end with form for editing.
			if ( $this->input->post('submit_edit') === FALSE )
			{
			
				$vars['project']   = $this->project->get_project( $this->uri->segment( 3 ) );
				$vars['changelog'] = $this->project->get_changelog_by_id( $this->uri->segment( 5 ) );
				$vars['page']	   = 'edit_form';
				$this->load->view('loader', $vars);
				
			}
			
		}
		
	}
	
	public function deletechangelog ( )
	{
		$vars['module'] = 'deletechangelog';
		$vars['area']   = $this->_area;

		// Do we have a project given?
		if ( $this->uri->segment( 3 ) === FALSE )
		{
			// Load changelogs.
			$vars['changelogs'] = $this->project->get_all_changelogs();
			// Set page.
			$vars['page'] 		= 'view_all';
			$this->load->view('loader', $vars);
		}
	} 
	
	public function logout()
	{
		// Destroy CI's session.
		$this->session->sess_destroy();
		// and redirect to the root of site.
		redirect( '' );
	} 
	
	public function login()
	{
		$vars = 
			array (
				'area' => $this->_area,
				'module' => __FUNCTION__
				);
				
		// Was the forum submitted?
		if( $this->input->post('log_in') !== FALSE )
		{
			// Form validation stuff.
			$rules = 
				array (
					array (
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'required|min_length[4]|max_length[16]|callback_username_exists[true]'
						),
					array (
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required|min_length[4]|max_length[16]|callback_password_username_match'
						)
					);
			$this->form_validation->set_rules( $rules );
			if ( $this->form_validation->run() === TRUE )
			{
				// Username and password matched.
				// Let's set the session data; access level, username.
				$userdata =
					array (
						'access_level' => $this->user->get_access_level( $this->input->post('username') ),
						'username'	   => $this->input->post('username')
						);
				$this->session->set_userdata( $userdata );
				// Set misc variables.
				$vars['page'] = "loggedin.php";
				$vars['red_to'] = site_url('admin/');
				$vars['red_time'] = 5;
				$this->load->view( 'loader', $vars );
			}
			else
			{
				$this->load->view( 'loader', $vars );
			}
		}
		else
		{
			$this->load->view( 'loader', $vars );
		}
	}
	
	public function remove_empty_logs ( )
	{
		foreach ( $_POST['title'] as $key => $title )
		{
			if ( $_POST['title'][$key] == '' && $_POST['type'][$key] == '' && $_POST['desc'][$key] == '' )
			{
				unset ( $_POST['title'][$key] );
				unset ( $_POST['type'][$key] );
				unset ( $_POST['desc'][$key] ); 
			}
		}
	}
	
	public function username_exists ( $username, $switch )
	{
		// Callback to check username exists in database.
		if( $switch == 'true' )
		{
			if ( ! $this->user->username_exists( $username ) )
			{
				$this->form_validation->set_message( 'username_exists', 'That username doesn\'t exist' );
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			# code...
		}
	}

	public function project_exists ( $project, $switch )
	{
		// Used as a callback for form validation.
		// Does the project exist? The model will let us know!
		if( $switch == 'true' )
		{
			if ( $this->project->project_exists( $project ) === TRUE )
			{
				$this->form_validation->set_message( 'project_exists', 'That project already exists.' );
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			if ( $this->project->project_exists( $project ) === FALSE )
			{
				$this->form_validation->set_message( 'project_exists', 'That project doesn\'t exist.' );
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	
	public function password_username_match ( $password )
	{
		// Callback for comparing the given password for 
		// username.
		$username = $this->input->post( 'username' );
		if ( $this->user->password_username_match( $username, $password ) )
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message( 'password_username_match', 'Password and Username don\'t match.' );
			return FALSE;
		}
	}
	
	/**
	 * Callback function.
	 * Used for new releases, to check that the given new releases
	 * project version, is greater than the last version given.
	 * To get this far, it has to be a valid project, so we can
	 * skip checking the projects validity.
	 */
	public function newer_version ( $version )
	{
		$project		= $this->uri->segment( 3 );
		$project_info   = $this->project->get_project( $project );
		if ( (bool) $project_info->has_release )
		{
			$latest_project = $this->project->get_latest_project_info( $project_info->project_name );
			if ( $version > $latest_project->project_version )
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message( 'newer_version', "The project version you supplied is older than the current version ({$latest_project->project_version})." );
				return FALSE;
			}
		}
		else
		{
			return TRUE;
		}
	}
	
	public function createrelease()
	{
		$name 			= $_POST['project_name'];
		$description 	= $_POST['project_desc'];
		$author 		= $_POST['project_author'];
		$stage 			= $_POST['project_stage'];
		$version 		= $_POST['project_version'];
		$dl_avail 		= ($this->no_file ? "no" : "yes");
		$dl_link		= ROOTPATH . "dev_projects/zip/{$_POST['project_name']}-{$_POST['project_version']}.zip";
		$rel_ag 		= "none";
		
		$this->db->query("INSERT INTO `project_releases` VALUES
		(null, '{$name}', '{$description}', '{$version}', '{$rel_ag}', '{$dl_avail}', '{$dl_link}')");
	}
	 
}


?>