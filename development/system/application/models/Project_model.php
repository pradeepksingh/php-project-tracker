<?php

class Project_model extends Model 
{
	
	/**
	 * Properties
	 */
	private $_project;
	
	function Project_model()
	{
		parent::Model();
	}
	
	/**
	 * Does as the label suggests - checks if the project exists.
	 * Returns: boolean.
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
	
	public function test ()
	{
		$this->db
			 ->from('db_test');
		die($query->num_rows());
	}
	
	/**
	 * Grabs all information from 'projects' table.
	 * Does NOT return things like download hits, download path, etc.
	 * If there are no projects, NULL is the return value.
	 */
	public function get_all_projects ( )
	{
		// We omit the 'select' method, because if it's not present
		// CI assumes we want to select everything - which we do. :)
		$this->db
			 ->from( 'projects' );
		$query = $this->db->get();
		if ( $query->num_rows() < 1 )
		{
			// If we have no results, return NULL.
			return NULL;
		}
		else
		{
			return $query;
		}
	}
	
	public function get_all_projects_info ( )
	{
		
	}
	
	/**
	 * Grabs data for ONE project.
	 * The project ALIAS is expected.
	 * Does NOT return things like download hits, download path, etc.
	 * If there is no matching project, NULL is returned.
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
	
	public function get_project_by_alias ( $alias )
	{
		return $this->get_project( $alias );
	}
	
	/**
	 * Grabs LATEST info for ONE project.
	 * Returns: project name, version ...
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
	
	public function get_project_changelog ( $project )
	{
		
	}
	
	/**
	 * Returns the LATEST changelog for given project.
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
				// Return as resource. 
				// Because this could hold more than one row,
				// we need to traverse it through a loop.
				return $query;
			}
		}
	}
	
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
	
	public function commit_changelog ( $data )
	{
		$this->db->insert( 'project_changelogs', $data );
	}
	public function update_changelog ( $id, $data )
	{
		$this->db->where('id', $id);
		$this->db->update('project_changelogs', $data);
	}
	
	/**
	 * Commits the given information into the projects table.
	 */
	public function commit_new_project ( $data )
	{
		$this->db->insert( 'projects', $data );
	}
	
	public function commit_new_release ( $data )
	{
		$this->db->insert( 'project_releases', $data );
	}
	
	public function set_has_release ( $has_release, $alias )
	{
		$data = array( 'has_release' => (int) $has_release );
		$this->db
			 ->where( 'alias', $alias )
			 ->update( 'projects', $data );
	}
}

?>