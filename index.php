<?php

	// GET ENV FILE VARIBALES
	$_ENV = parse_ini_file('.env');

	// GET BASE URL
	function base_url($path = null, $print = false)
	{
		if($print)
		{
			echo $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/" . $_ENV['PROJECT_NAME'] . "/" . ($path ? $path : '');
		}
		else
		{
			return $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/" . $_ENV['PROJECT_NAME'] . "/" . ($path ? $path : '');
		}
	}

	// GET BASE PATH
	function base_path($path = null, $print = false)
	{
		if($print)
		{
			echo $_SERVER["DOCUMENT_ROOT"] . "/" . $_ENV['PROJECT_NAME'] . "/" . ($path ? $path : '');
		}
		else
		{
			return $_SERVER["DOCUMENT_ROOT"] . "/" . $_ENV['PROJECT_NAME'] . "/" . ($path ? $path : '');
		}
	}

	// PRINT STATEMENTS
	function pr($data)
	{
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	// URL ROUTING
	include base_path("controller/SiteController.php");

	$urlPath = isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] ? explode("/", $_SERVER['PATH_INFO']) : null;
	unset($urlPath[0]);

	if(isset($urlPath) && $urlPath && is_array($urlPath) && count($urlPath) > 0)
	{
		if(isset($urlPath[1]) && $urlPath[1] && isset($urlPath[2]) && $urlPath[2])
		{
			$controller = $urlPath[1];
			$method = $urlPath[2];
			unset($urlPath[1]);
			unset($urlPath[2]);

			$className = ucfirst($controller)."Controller";

			include base_path("controller/".$className.".php");

			$class = new $className();

			$class->{$method}(...$urlPath);
		}
		elseif(isset($urlPath[1]) && $urlPath[1] && (!isset($urlPath[2]) || !$urlPath[2]))
		{
			$controller = $urlPath[1];
			unset($urlPath[1]);

			$className = ucfirst($controller)."Controller";
			include base_path("controller/".$className.".php");

			$class = new $className();

			if(!method_exists($class, 'index'))
			{
				echo "index method doest not exists";die;
			}

			$class->index(...$urlPath);
		}
		else
		{
			echo "page don't exists";
		}
	}


?>