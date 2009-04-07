
	<div id="header">
		<img id="new_icon" src="<?=ROOTPATH?>/images/new_icon_small.png" alt=""/>
		<h1>Mahcuz.com</h1>
		<p>Development</p>
	</div>
	
	<div id="pagecontainer">
		
		<div id="content">
		
			<!-- Program name & current version go here //-->
			<h1><?=$query_obj2->name . " :: " . $query_obj2->version?></h1>
			
			<!-- description of current version goes here //-->
			<?=$query_obj2->description;?>
			
			<!-- script license agreement goes here //-->
			<h2>Program/Script License Agreement</h2>
			
			<p><?=$query_obj2->release_agreement?></p>
			
			<h2>Program/Script Download</h2>
			
			<p>This Program/Script is currently available for download.</p>
			<p>Download: <a href="<?=$query_obj2->download?>"><?=$query_obj2->name . " :: " . $query_obj2->version?></a></p>
			<p>Downloaded <?=$query_obj1->downloaded?> times.</p>
			
			<!-- version history //-->
			<h2>Version History</h2>
			
			<p>Disabled for the time being...</p>
			<p>There are no older releases than the current one.</p>
		
		</div>