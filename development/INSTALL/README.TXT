Project Author: Mark Skilbeck.

INSTALlATION GUIDE.

1. 	Open 
		system->application->config->config.php
   	with your favourite text editor.
   
2. 	Set the variable 
		$config['base_url']
   	to point to your install of PHP Project Tracker. It should be something such as
   		$config['base_url'] = 'http://yoursite.com/php-project-tracker/'
   	Remember the trailing slash!

3. 	If you are an experienced CodeIgniter developer, you may also change the
		$config['index_page']
    variable to suit your needs. Otherwise, close the file.
	Note: You can read PHP Project Manager's web page to understand the use of these
	variables. http://blog.mahcuz.com/php-project-tracker

4.	Open
		system->application->config->database.php
	with your favourite text editor.
	In this file we will edit the $db array to reflect your database credentials.

5. 	Edit
		$db['default']['hostname']
		$db['default']['username']
		$db['default']['password']
		$db['default']['database']
	to the information you need to connect to your database.
	Note: PHP Project Tracker may not work correctly if you use a database driver
	other than 'mysql'. If you encounter problems using different drivers, please
	let me know (http://blog.mahcuz.com/php-project-tracker).
	If you are an experienced CodeIgniter developer or PHP developer, you may
	edit the rest of the $db array to suit your needs. Otherwise, close the file.
	
6.	Now we're going to set up the database tables used for PHP Project Tracker.
	Open up your phpMyAdmin page, and navigate to the 'Import' area.
	Using the file browser, navigate to this folder and then into the SQL folder, and
	select the file 'php-project-tracker.sql'. Once done, hit the 'Go' button.
	phpMyAdmin should then create the database tables. If you hit any errors,
	please contact me at http://blog.mahcuz.com/php-project-tracker
	
7.	With phpMyAdmin still opened, navigate to your newly created 'project_users' table.

8. 	Create your administration user data - this will be used for logging in and viewing the admin
	back-end. You may grant other users access by setting up accounts for them, too.
	Remember to give the account an access level of 4.
	
9.	Done. You should now be able to go ahead and start publishing your projects!

Thank you for using PHP Project Tracker. If you have any problems/questions, features or suggestions,
feel free to ask me at http://blog.mahcuz.com/php-project-tracker.