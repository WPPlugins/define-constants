<?php
class Define_Constants {
	
	var $constants;
	
	function __construct()
	{
		$this->constants = get_option('defined_constants');
		add_action('setup_theme',array(&$this,'add_constants'),1);
	}
	
	function add_constants()
	{
		if(!is_array($this->constants)) return;
		
		foreach($this->constants as $constant) {
			if(!defined($constant['name'])) define($constant['name'],$constant['value']);
		}
	}

}