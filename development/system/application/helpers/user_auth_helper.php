<?php
	
/**
 * User Authentication Helper.
 * Checks for valid session, and current permission, etc.
 */

function session_exists ( $for, $against, $in )
{
	// For: 		what to search for (the key).
	// Againast:	what $for should evaluate against.
	// In:			where to search (session?).
	$CI =& get_instance();
	if ( ! isset ( $CI->session ) )
	{
		die ( 'User Auth Helper requires the <code>session</code> library to be loaded.' );
	}
	if ( gettype( $in ) == 'array' && count( $in ) > 0 )
	{
		if ( $in[$for] == $against )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	elseif ( $in == 'session' )
	{
		$sess = @$CI->session->userdata( $for );
		if ( $sess == $against )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	else { }
}
	 
?>