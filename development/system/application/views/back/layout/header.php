<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>

	<?php
		if(isset($red_to)) :
		?>
		<meta http-equiv="refresh" content="<?=$red_time?>; url=<?=$red_to?>" />
	<?php
		endif;
		?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>mahcuz.com - development</title>
	<script src="/development/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	
	<style type="text/css">
	* {
		margin: 0;
	}
	html, body{
		height: 100%;
	}
	body{
		padding: 0;
		margin: 0;
		background: white;
		font: 80%/1.5 "Trebuchet MS", Verdana, sans-serif;
		color: #333;
	}
	#header{
		background-color: #963237;
		width: 100%;
		height: 75px;
		padding: 0;
		margin: 0;
	}
	#header img#new_icon{
		float: right;
	}
	#header h1{
		color: white;
		font-style: italic;
		font-size: 30px;
		font-family: serif;
		margin: 0;
		padding: 0;
		padding-left: 20px;
	}
	#header p{
		color: white;
		font-style: italic;
		font-size: 15px;
		font-family: arial;
		margin: 0;
		padding: 0;
		padding-left: 40px;
		/*width: 100%;*/
		background-color: #E7565D;
		height: 20px;
		border-top: 1px solid #EF878C;
		border-bottom: 1px solid #72272B;
	}
	#header p a{
		color: white;
		text-decoration: underline;
	}

	#content{
		padding: 20px 200px 100px 100px;
	}

	#content h1{
		margin: 10px;
		color: #009090;
	}

	#content h2{
		color: #336699;
		font-size: 15px;
		margin-top: 20px;
		margin-left: 30px;
		border-bottom: 2px dotted #ccccff;
	}

	#content p{
		padding-left: 40px;
	}

	#content p a, #content p a:visited{
		color: green;
	}

	#content p a:hover, #content p a:active{
		color: red;
	}

	#content fieldset{
		margin-left: 40px;
		padding: 20px;
		border-left: 0;
		border-right: 0;
	}

	#content fieldset legend{
		padding: 4px;
		border: 1px solid black;
	}

	#footer{
		font-size: 10px;
		font-family: georgia;
		letter-spacing: 2px;
		width: 100%;
		background-color: #963237;
		color: white;
		padding: 10px 0;
		text-align: center;
		border-top: 1px solid #72272B;
		height: 9em;
		margin: 0;
	}
	#footer a, #footer a:visited{
		color: gray;
	}
	#footer a:hover{
		color: lightblue;
	}

	.error{
		color: red;
		font-weight: bold;
		letter-spacing: 3px;
	}

	#content ul{
		margin-top: 30px;
		margin-left: 80px;
	}

	#content ul li{
		font-family: trebuchet;
		letter-spacing: 3px;
	}

	#content ul li a, #content ul li a:visited, #content ul li a:active{
		color: green;
	}

	#content ul li a:hover{
		color: red;
	}


	#errors{
		border: 1px dotted #CCC;
		padding: 20px;
		margin-bottom: 10px;
	}
	#errors h1{
		font-size: 18px;
		color: #009090;
	}
	#errors ul{
		margin-top: 10px;
	}
	#errors ul li{
		font-family: arial;
		letter-spacing: 0;
	}
	/** input styling **/
	input[type="text"], input[type="password"]{
		padding: 5px;
		border: 1px solid black;
		width: 22em;
		text-align: center;
		font-family: trebuchet;
	}
	.file{
		text-align: right;
		margin: 0;
	}
	/** Footer at bottom always! **/
	.wrapper {
		min-height: 100%;
		height: auto !important;
		height: 100%;
		margin: 0 auto -9em;
	}	
	.push {
		height: 9em;
	}
	</style>

</head>

<body>


	<div class="wrapper">
	
		<div id="header">
			<h1>Mahcuz.com</h1>
				<p>
                		<a href="<?=ROOTURIPATH?>">&raquo; Development</a>
                        <?php 
							$x = ucfirst($this->uri->segment(1));
							if ( $x != "" )
							{
								echo " <a href='".ROOTURIPATH."admin'>&raquo; {$x}</a>";
							}
							$x = ucfirst($this->uri->segment(2));
							if ( $x != "" ) 
							{
								echo " &raquo; {$x}"; 
							}
							$x = $this->uri->segment(3);
							if ( $x != "" )
							{
								echo " &raquo; {$x}";
							}
						?>
              	</p>
		</div>