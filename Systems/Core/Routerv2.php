<?php
class Routerv2{
	private $request;
	private $supportedHttpMethods = array(
		"GET",
		"POST"
	);
	private $methods;
	
	function __construct(IRequest $request, ...$methods){
		$this->request = $request;
		$this->methods = $methods;
	}
  
	function __call($name, $args){
		echo $name;
		///*
		list($route, $method) = $args;
		if(!in_array(strtoupper($name), $this->supportedHttpMethods)){
			$this->invalidMethodHandler();
		}
		
		$this->{strtolower($name)}[$this->formatRoute($route)] = $method;
		//*/
		
	}
	
	private function formatRoute($route){
		$result = rtrim($route, '/');
		if($result === ''){
			return '/';
		}
		
		return $result;
	}
  
	private function invalidMethodHandler(){
		header("{$this->request->serverProtocol} 405 Method Not Allowed");
		echo "405";
	}
  
	private function defaultRequestHandler(){
		header("{$this->request->serverProtocol} 404 Not Found");
		echo "404";
	}
	
	function resolve(){
		$methodDictionary = $this->{strtolower($this->request->requestMethod)};
		$formatedRoute = $this->formatRoute("/" . ROUTE);
		
		if(isset($methodDictionary[$formatedRoute])){
			$method = $methodDictionary[$formatedRoute];
		}else{
			$method = null;
		}
		
		if(is_null($method))
		{
			$this->defaultRequestHandler();
			return;
		}
		
		call_user_func_array($method, $this->methods);
	}
  
	function __destruct(){
		$this->resolve();
	}
	
	
	public static function get($type){
		$arr = explode("/", ROUTE);
		
		if(count($arr) > 0){
			switch($type){
				case "main":
					return (isset($arr[0]) && !empty($arr[0])) ? $arr[0] : "index";
				break;
				
				case "sub":
					return isset($arr[1]) ? $arr[1] : false;
				break;
				
				case "view":
					return isset($arr[2]) ? $arr[2] : false;
				break;
				
				case "path":
					array_shift($arr);
					return implode("/", $arr);
				break;
				
				default:
					return isset($arr[$type]) ? $arr[$type] : "";
				break;
			}
		}else{
			return "index";
		}
	}
}