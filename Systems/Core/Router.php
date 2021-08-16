<?php

class Router{
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
		list($route, $method) = $args;
		if(!in_array(strtoupper($name), $this->supportedHttpMethods)){
			$this->invalidMethodHandler();
		}
		
		$this->{strtolower($name)}[$this->formatRoute($route)] = $method;
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
}

?>