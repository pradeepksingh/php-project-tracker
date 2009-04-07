<?php

class User_model extends Model 
{

	function User_model()
	{
		parent::Model();
	}
	
	public function username_exists ( $username )
	{
		$this->db->select('username')->from('project_users')->where('username', $username);
		$x = $this->db->count_all_results();
		if ( $x > 0 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function password_username_match ( $username, $password )
	{
		$data = array ( 'username' => $username, 'password' => $password );
		$this->db->select('username')->from('project_users')->where( $data );
		$x = $this->db->count_all_results();
		if ( $x > 0 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_access_level ( $username )
	{
		$this->db->select('access_level')->from('project_users')->where('username', $username);
		$x = $this->db->count_all_results();
		if ( $x > 0 )
		{
			$query = $this->db->get('project_users');
			$row   = $query->row();
			return $row->access_level;
		}
		else
		{
			return 0;
		}
	}
	
}

?>