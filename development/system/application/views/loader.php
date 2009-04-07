<?php

/**
 * This file will load the required header, content and footer files.
 */
 	if( ! isset ($page) ) $page = "content.php";
 
 	// header
	$this->load->view($area . '/layout/header.php');
	
	// content
	$this->load->view($area . '/' . $module . '/' . $page);
	
	// footer
	$this->load->view($area . '/layout/footer.php');


?>