<?php

	class TMysql{
		private $_handle;
		private $_connected;
		private $_prefix;
		
		public function __construct($host,$username,$password,$dbname){
			//@mysql_connect($host,$username,$password) or die(''); //ToDoIt:	
			//@mysql_select_db($dbname) or die(''); //ToDoIt:
		}
		
		public function parseSQL($mask){
			$numargs = func_num_args();
			$arg_list = func_get_args();
			for($i=1;$i<$numargs;$i++){
				$mask= str_replace('%'.$i,addslashes($arg_list[$i]),$mask);
			}
			print $mask;
		}
		
	}
	
	$_system_mysql = new TMysql(cfg('mysql','host'),cfg('mysql','username'),cfg('mysql','password'),cfg('mysql','dbname'));
	$_system_mysql->parseSQL("SELECT * FROM `%1` WHERE `id`='%2'","test",15);
?>