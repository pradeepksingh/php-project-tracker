<?php

class Project_model extends Model 
{
	
	
	function Project_model()
	{
		parent::Model();
	}
	
	
	/**
	 * Project_model::project_exists()
	 * 
	 * @param  string $proj_name
	 * @return bool
	 */
	public function project_exists ( $proj_name )
	{
		// Using the active record db CI library, data is
		// escaped by the system. So no need for SQL escaping. :D
		if ( $proj_name != NULL )
		{
			// sexy hot method chaining - PHP 5!
			$this->db
				 ->select( 'project_name' )
				 ->from( 'projects' )
				 ->where( 'project_name', $proj_name );
			$query = $this->db->get();
			if ( $query->num_rows() < 1 )
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	
	/**
	 * Project_model::project_exists_by_alias()
	 * 
	 * @param  string $alias
	 * @return bool
	 */
	public function project_exists_by_alias ( $alias )
	{
		if ( $alias !== NULL )
		{
			$this->db
				 ->select( 'project_name' )
				 ->from( 'projects' )
				 ->where( 'alias', $alias );
			$query = $this->db->get();
			if ( $query->num_rows() < 1 )
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
	}
	
	/**
	 * Project_model::get_all_projects()
	 * 
	 * @return obj, or null
	 */
	public function get_all_projects ( )
	{
		$this->db
			 ->from( 'projects' );
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return NULL;
		}
		else
		{
			return $query;
		}
	}
	
	/**
	 * Project_model::get_project()
	 * 
	 * @param  string $alias
	 * @return obj, or null
	 */
	public function get_project ( $alias )
	{
		if ( ! is_null ( $alias ) )
		{
			$this->db
				 ->from		( 'projects' )
				 ->where	( 'alias', $alias )
				 ->limit 	( 1 );
			$query = $this->db->get();
			if ( $query->num_rows() < 1 )
			{
				return NULL;
			}
			else
			{
				// Return it as object.
				return $query->row();
			}
		}
	}
	
	
	/**
	 * Project_model::update_all_project_names()
	 * 
	 * @param  string $proj
	 * @param  string $new
	 * @return void
	 */
	public function update_all_project_names ( $proj, $new )
	{
		# Load the releases.
		$releases = $this->get_releases_by_project( $proj );
		
		# Releases were found.
		if ( $releases !== NULL )
		{
			# We don't need this variable anymore.
			unset( $releases );
			
			# Set our database stuff.
			$this->db->where('project_name', $proj);
			$data = array ( 'project_name' => $new );
			
			# Run update.
			$this->db->update('project_releases', $data);
		}
		
		# We do the same for changelogs.
		$changelogs = $this->get_changelogs_by_project( $proj );
		
		# Changelogs were found.
		if ( $changelogs !== NULL )
		{
			unset( $changelogs );
			
			# Database stuff.
			$this->db->where('project_name', $proj);
			$data = array ( 'project_name' => $new );
			
			# Run update.
			$this->db->update('project_changelogs', $data);
		}
	}
	
	/**
	 * Project_model::get_project_by_alias()
	 * 
	 * @param  string $alias
	 * @return Project::get_project()
	 */
	public function get_project_by_alias ( $alias )
	{
		return $this->get_project( $alias );
	}
	
	
	/**
	 * Project_model::get_latest_project_info()
	 * 
	 * @param  string $proj_name
	 * @return obj, or null
	 */
	public function get_latest_project_info ( $proj_name )
	{
		if ( ! is_null ( $proj_name ) )
		{
			$this->db
				 ->from		( 'project_releases' )
				 ->where	( 'project_name', $proj_name )
				 ->order_by ( 'project_version', 'desc' )
				 ->limit 	( 1 );
			$query = $this->db->get();
			if ( $query->num_rows() < 1 )
			{
				return NULL;
			}
			else
			{
				return $query->row();
			}
		}
	}
	
	
	/**
	 * Project_model::delete_project()
	 * 
	 * @param  string $proj
	 * @return void
	 */
	public function delete_project ( $proj )
	{
		$this->db->where('project_name', $proj);
		$this->db->delete('projects');
	}
	
	/**
	 * Project_model::get_releases_by_project()
	 * 
	 * @param  string $proj_name
	 * @return obj, or null
	 */
	public function get_releases_by_project ( $proj_name )
	{
		$this->db
			 ->from('project_releases')
			 ->where('project_name', $proj_name)
			 ->order_by('project_version', 'desc');
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return NULL;
		}
		else
		{
			return $query;
		}
	}
	
	/**
	 * Project_model::get_releases_by_alias()
	 * 
	 * @param  string $alias
	 * @return obj, or null
	 */
	public function get_releases_by_alias ( $alias )
	{
		$this->db
			 ->from('project_releases')
			 ->where('alias', $alias)
			 ->order_by('project_version', 'desc');
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return NULL;
		}
		else
		{
			return $query;
		}
	}
	
	/**
	 * Project_model::get_all_releases()
	 * 
	 * Marked for deletion.
	 * 
	 * @return
	 */
	public function get_all_releases ()
	{
		$data = array();
		$projects = $this->get_all_projects();
		if ( $projects !== NULL )
		{
			foreach( $projects->result() as $project )
			{
				$this->db
					 ->from('project_releases')
					 ->where('project_name', $project->project_name)
					 ->order_by('project_version', 'desc');
				if ( $query->num_rows() > 0 )
				{
					$query = $this->db->get();
					echo '<pre>';
					die(print_r($query->result_array()));
					foreach ( $query->result() as $key => $release )
					{
						$data[$key] = array();
						$data[$key]['proj_name']   = $project->project_name;
						$data[$key]['proj_alias']  = $project->alias;
						$data[$key]['proj_author'] = $release->project_author;
						$data[$key]['proj_ver']    = $release->project_version;
					}
				}
				else
				{
					return NULL;
				}
			}
			return $data;
		}
		else
		{
			return NULL;
		}
	}
	
	/**
	 * Project_model::release_exists_by_alias()
	 * 
	 * @param  string $alias
	 * @param  string $release
	 * @return bool
	 */
	public function release_exists_by_alias ( $alias, $release )
	{
		$proj = $this->get_project_by_alias( $alias );
		$this->db
			 ->from('project_releases')
			 ->where('project_name', $proj->project_name)
			 ->where('project_version', $release);
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	/**
	 * Project_model::delete_associated_releases()
	 * 
	 * @param  string $proj
	 * @return void
	 */
	public function delete_associated_releases ( $proj )
	{
		$this->db->where('project_name', $proj);
		$this->db->delete('project_releases');
	}
	
	public function get_project_changelog ( $project )
	{
		
	}
	
	/**
	 * Project_model::get_latest_changelog()
	 * 
	 * @param  string $project
	 * @param  string $version
	 * @return obj, or null
	 */
	public function get_latest_changelog ( $project, $version )
	{
		if ( ! is_null ( $project ) )
		{
			$this->db
				 ->from		( 'project_changelogs' )
				 ->where	( 'project_name', $project )
				 ->where	( 'project_version', $version )
				 ->order_by	( 'project_version', 'desc' )
				 ->order_by ( 'id', 'desc' );
			$query = $this->db->get();
			if ( $query->num_rows() < 1 )
			{
				return NULL;
			}
			else
			{
				return $query;
			}
		}
	}
	
	/**
	 * Project_model::get_all_changelogs()
	 * 
	 * Marked for deletion.
	 * 
	 * @return
	 */
	public function get_all_changelogs ( )
	{
	
		$data = array();
		$projects = $this->get_all_projects();
		if ( $projects !== NULL )
		{
			foreach ( $projects->result() as $project )
			{
				$data[$project->project_name] = array();
				$this->db
					 ->from('project_changelogs')
					 ->where('project_name', $project->project_name)
					 ->order_by('project_version', 'desc');
				$query = $this->db->get();
				if ( $query->num_rows() < 1 )
				{
					$data[$project->project_name][] = NULL;
				}
				else
				{
					foreach( $query->result() as $key => $changelog )
					{
						$data[$project->project_name][$key]['proj_ver']  = $changelog->project_version;
						$data[$project->project_name][$key]['log_desc']  = $changelog->log_desc;
						$data[$project->project_name][$key]['log_type']  = $changelog->log_type;
						$data[$project->project_name][$key]['log_title'] = $changelog->log_title;
						$data[$project->project_name][$key]['log_date']  = $changelog->log_date;
					}
				}
			}
			return $data;
		}
		else
		{
			return NULL;
		}
	}
	
	/**
	 * Project_model::get_changelogs_by_project()
	 * 
	 * @param  string $proj
	 * @return obj, or null
	 */
	public function get_changelogs_by_project ( $proj )
	{
		$this->db	
			 ->from('project_changelogs')
			 ->where('project_name', $proj);
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return NULL;
		}
		else
		{
			return $query;
		}
	}
	
	/**
	 * Project_model::get_changelogs_by_release()
	 * 
	 * @param  string $proj
	 * @param  string $release
	 * @return obj, or null
	 */
	public function get_changelogs_by_release ( $proj, $release )
	{
		(string) $proj;
		(int)    $release;
		$this->db
			 ->from('project_changelogs')
			 ->where('project_name', $proj)
			 ->where('project_version', $release)
			 ->order_by('project_version', 'desc');
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return NULL;
		}
		else
		{
			return $query;
		}
		
	}
	
	/**
	 * Project_model::get_changelog_by_id()
	 * 
	 * @param  int $id
	 * @return obj, or null
	 */
	public function get_changelog_by_id ( $id )
	{
		$this->db
			 ->from('project_changelogs')
			 ->where('id', $id)
			 ->limit(1);
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return NULL;
		}
		else
		{
			return $query->row();
		}
	}
	
	/**
	 * Project_model::changelog_exists_by_id()
	 * 
	 * @param  string $alias
	 * @param  string $release
	 * @param  int    $id
	 * @return bool
	 */
	public function changelog_exists_by_id ( $alias, $release, $id )
	{
		$project = $this->db->get_where('projects', array('alias' => $alias));
		$project = $project->row();
		$this->db
			 ->from('project_changelogs')
			 ->where('project_name', $project->project_name)
			 ->where('project_version', $release)
			 ->where('id', $id);
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	/**
	 * Project_model::delete_associated_changelogs()
	 * 
	 * @param  string $proj
	 * @return void
	 */
	public function delete_associated_changelogs ( $proj )
	{
		$this->db->where('project_name', $proj);
		$this->db->delete('project_changelogs');
	}
	
	/**
	 * Project_model::update_project()
	 * 
	 * @param  string $proj
	 * @param  array  $data
	 * @return void
	 */
	public function update_project ( $proj, array $data )
	{
		$this->db->where('project_name', $proj);
		$this->db->update('projects', $data);
	}	
	
	/**
	 * Project_model::commit_changelog()
	 * 
	 * @param  array $data
	 * @return void
	 */
	public function commit_changelog ( $data )
	{
		$this->db->insert( 'project_changelogs', $data );
	}
	
	/**
	 * Project_model::update_changelog()
	 * 
	 * @param  int   $id
	 * @param  array $data
	 * @return void
	 */
	public function update_changelog ( $id, array $data )
	{
		$this->db->where('id', $id);
		$this->db->update('project_changelogs', $data);
	}
	
	/**
	 * Project_model::delete_changelog()
	 * 
	 * @param  int $id
	 * @return void
	 */
	public function delete_changelog ( $id )
	{
		$this->db->where($id);
		$this->db->delete('project_changelogs');
	}
	
	/**
	 * Project_model::commit_new_project()
	 * 
	 * @param  array $data
	 * @return void
	 */
	public function commit_new_project ( array $data )
	{
		$this->db->insert( 'projects', $data );
	}
	
	/**
	 * Project_model::commit_new_release()
	 * 
	 * @param  array $data
	 * @return void
	 */
	public function commit_new_release ( array $data )
	{
		$this->db->insert( 'project_releases', $data );
	}
	
	/**
	 * Project_model::set_has_release()
	 * 
	 * @param  bool   $has_release
	 * @param  string $alias
	 * @return void
	 */
	public function set_has_release ( $has_release, $alias )
	{
		$data = array( 'has_release' => (int) $has_release );
		$this->db
			 ->where( 'alias', $alias )
			 ->update( 'projects', $data );
	}
}

?>