<?php

	class TMysql{
		private $_handle;
		private $_connected;
		private $_prefix;
		
		public function __construct($host,$username,$password,$dbname){
			@mysql_connect($host,$username,$password) or $this->_connected=false; 
			@mysql_select_db($dbname) or $this->_connected=false; 
			//ToDoIt:
		}
		
		public function isConnected(){
			return $this->_connected;
		}
		
		public function parseSQL($mask,$arg_list){
			for($i=0;$i<count($arg_list);$i++){
				$mask= str_replace('%'.($i+1),addslashes($arg_list[$i]),$mask);
			}
			print $mask; //ToDoIt:
		}
		
	}
	
	function sqlQ($mask){
		global $_system_mysql;
		$arg_list = func_get_args();
		$num      = func_num_args();
		$ar = array();
		for($i=1;$i<$num;$i++){
			$ar[] = $arg_list[$i];
		}
		print_r($ar); //ToDoIt:
		return $_system_mysql->parseSQL($mask,$ar);
	}
	
	$_system_mysql = new TMysql(cfg('mysql','host'),cfg('mysql','username'),cfg('mysql','password'),cfg('mysql','dbname'));
	sqlQ("SELECT * FROM `%1` WHERE `id`='%2'","test",15);
	var_dump($_system_mysql->isConnected());
?>