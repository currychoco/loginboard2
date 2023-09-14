<?php
class Template{
	var $vars;
	var $path;
	
	function __construct($path = null) {
		$this->path = $path;
	}
	
	function set_path($path) {
		$this->path = $path;
	}
	
	function set($name, $value = null) {
		if (is_array($name)){
			foreach ($name as $key => $val){
				$this->vars[$key] = $val;
			}
		}else{
			$this->vars[$name] = $value;
		}
	}
	
	function fetch($file) {
		@extract($this->vars); // 배열 속의 키값을 변수화 시켜주는 함수
		ob_start();
		include($this->path . $file);
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}
}