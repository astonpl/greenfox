<?php
	define("PATH_CONFIG",'_config/');

	function ErrorHandler($errno, $errstr, $errfile, $errline)
	{
		if (!(error_reporting() & $errno)) {
			// This error code is not included in error_reporting
			return;
		}
		print '<div>Error : '.$errno.' ['.$errstr.'] in <em>'.$errfile.'</em> on <em>'.$errline.'</em></div>';
	}
	
	set_error_handler("ErrorHandler");
	
	function loadConf($name){
		if( file_exists(PATH_CONFIG.$name.'.php') ){
			return include PATH_CONFIG.$name.'.php';	
		}else{
			//ToDoIt : Podpięcie pod parser błędów.	
		}
	}
	
	class TConfigDepo{
		private $_count;
		private $_cfgs;
		
		public function __construct(){
			$this->_count = 0;
			
		}
		
		public function Add($cfgs,$name){
			$this->_cfgs[$name] = $cfgs;
		} 
		
		public function Get($name,$parm){
			return $this->_cfgs[$name][$parm];
		}
	}
	
	$_system_cfgdepo = new TConfigDepo();
	function Acfg($name,$cfgs){
		global $_system_cfgdepo;
		$_system_cfgdepo->Add($cfgs,$name);
	}
	
	function cfg($name,$parm){
		global $_system_cfgdepo;
		return $_system_cfgdepo->Get($name,$parm);	
	} 
	
	
	
	Acfg('website',loadConf('website'));
	Acfg('mysql',loadConf('mysql'));
?>