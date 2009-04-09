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
		
		//
		$this->output->enable_profiler(TRUE);
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
	}
	
	public function download()
	{
	
	}
	
}

?>