<?php
	
	class SiteController {
		function __construct()
		{

		}

		function adminLayout($path = null, $variables = [], $partials = true)
		{
			if(file_exists(base_path("views/partials/header.php")) && $partials)
			{
				include base_path("views/partials/header.php");
			}
			if(isset($path) && $path)
			{
				extract($variables);
				include base_path("views/".$path.".php");
			}
			if(file_exists(base_path("views/partials/footer.php")) && $partials)
			{
				include base_path("views/partials/footer.php");
			}
		}

		function OuterLayout($path = null, $variables = [], $partials = true)
		{
			if(file_exists(base_path("views/partials/header-outer.php")) && $partials)
			{
				include base_path("views/partials/header-outer.php");
			}
			if(isset($path) && $path)
			{
				extract($variables);
				include base_path("views/".$path.".php");
			}
			if(file_exists(base_path("views/partials/footer-outer.php")) && $partials)
			{
				include base_path("views/partials/footer-outer.php");
			}
		}
	}

