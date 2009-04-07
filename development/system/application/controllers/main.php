<?php

/**
 * @author Mark Skilbeck
 * @copyright 2008
 */

class Main extends Controller
{
	/**
	 * Member variables
	 */
	
	/**
	 * Main::Main()
	 * 
	 * @return void
	 */
	function Main()
	{
		parent::Controller();
	}
	
	/**
	 * main::index()
	 * 
	 * @return void
	 * This is a function that is called when the class is 
	 * instantiated without any function calls.
	 */
	public function index()
	{
		/**
		 * Get module
		 */
		$this->load->view('main_view');
	}
	
	public function view()
	{
		
		sleep( 25 );
		$data = array('db_x' => "it work?");
		$this->db->insert('db_test', $data);
		
	}
	
	public function download()
	{
	
	}
	
}

?>