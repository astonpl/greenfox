<?php

	class TMysql{
		private $_handle;
		private $_connected;
		private $_prefix;
		
		public function __construct($host,$username,$password,$dbname){
			$this->_connected=true;
			$this->_handle = @mysql_connect($host,$username,$password) or $this->_connected=false; 
			@mysql_select_db($dbname,$this->_handle) or $this->_connected=false; 
			//ToDoIt: 
		}
		
		public function isConnected(){
			return $this->_connected;
		}
		
		public function getHandle(){
			return $this->_handle;
		}
		
		public function setPrefix($pr){
			$this->_prefix = $pr;
		}
		
		public function parseSQL($mask,$arg_list){
			$mask= str_replace('%0',addslashes($this->_prefix),$mask);
			for($i=0;$i<count($arg_list);$i++){
				$mask= str_replace('%'.($i+1),addslashes($arg_list[$i]),$mask);
			}
			return $mask; //ToDoIt:
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
		return mysql_query($_system_mysql->parseSQL($mask,$ar));
	}
	
	$_system_mysql = new TMysql(cfg('mysql','host'),cfg('mysql','username'),cfg('mysql','password'),cfg('mysql','dbname'));
	$_system_mysql->setPrefix(cfg('mysql','prefix'));
	if(!$_system_mysql->isConnected()){
		sendError("Mysql Error","Błąd połączenia z bazą danych","Sprawdz poprwaność danych zawartych w pliku konfiguracyjnego mysql.php");
	}
	
?>