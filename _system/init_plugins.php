<?php
	
	$__plugins = sqlQ("SELECT `name` from `%0plugins` WHERE `active`=1");
	while($__plugin = mysql_fetch_array($__plugins)){
		print "lol";	
	}
	
?>