<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed'); 


class hook_into
{
	
	/**
	 * hook_into properties.
	 */
	var $_CI;
	
	/**
	 * Constructor.
	 * No parameters expected.
	 */
	public function hook_into ( )
	{
		# Assign our CI instance in case we need to access any CI stuff.
		$this->_CI =& get_instance( );
	}
	
	public function call ( $hook )
	{
		
	}
}


?>