<?php
class App{
	public $name, $config = [], $route, $body, $code;
	
	public function __construct($name = DEF_NAME, $code = "DEFAULT"){
		$this->name = $name;
		$this->code = $code;
		$this->route = Input::get("route");
		
		
	}
	
	public function name($name = ""){
		$this->name = $name;
	}
	
	public function config($config = []){
		$this->config = $config;
	}
	
	public function route($route = ""){
		$this->route = $route;
	}
	
	public function body($body){
		$this->body = $body;
	}
	
	public function run(){		
		define("APP_CODE", $this->code);
		define("APP_NAME", $this->name);
		define("APP", APPS . APP_CODE . "/");
		define("VIEW", APP . "View/");
		define("CLASSES", APP . "Classes/");
		define("ASSET", APP . "Assets/");
		
		if(!is_dir(APPS . $this->code)){
			@mkdir(APPS . $this->code . "/Classes", 0777, true);
			@mkdir(APPS . $this->code . "/Controller", 0777, true);
			@mkdir(APPS . $this->code . "/View/", 0777, true);
			@mkdir(APPS . $this->code . "/Assets/", 0777, true);
			
			file_put_contents(APPS . $this->code . "/Classes/index.php", "<?php\n//written by hpf");
			file_put_contents(APPS . $this->code . "/Controller/index.php", "<?php\n//written by hpf");
			file_put_contents(APPS . $this->code . "/View/index.php", "<?php\n//written by hpf");
			file_put_contents(APPS . $this->code . "/Assets/index.php", "<?php\n//written by hpf");
			
			$o = fopen(APPS . $this->code . "/configure.json", "w+");
			fwrite($o, <<<'T'
{
	"databases": [
		{
			"host": "127.0.0.1",
			"database": "",
			"username": "",
			"password": ""
		}
	],
	"constants": [
		{
			"PORTAL": 	"http://localhost/"
		}
	],
	"miscs": [
		"asset_loader.php"
	],
	"headers": []
}
T
);
			fclose($o);
			
			$o = fopen(APPS . $this->code . "/App.php", "w+");
			fwrite($o, <<<'T'
<?php
//A journey start with a step

T
);
			fclose($o);
		}
		
		if(file_exists(APPS . $this->code . "/configure.json")){
			$json = file_get_contents(APPS . $this->code . "/configure.json");
			$obj = json_decode($json);
			
			if(isset($obj->miscs)){
				foreach($obj->miscs as $misc){
					include_once(MISC . $misc);
				}
			}
			
			if(isset($obj->constants)){
				foreach($obj->constants as $value){
					$value = (array)$value;
					if(!defined(key($value))){
						define(key($value), $value[key($value)]);
					}
				}
			}
			
			if(isset($obj->headers)){
				foreach($obj->headers as $header){
					header($header);
				}
			}
		}
		
		include_once(APPS . $this->code . "/App.php");
		is_callable($this->body) ? call_user_func($this->body) : "";
	}
	
	public static function execute($app){
		call_user_func($app);
	}
}





















