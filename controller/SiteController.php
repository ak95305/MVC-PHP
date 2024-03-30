<?php
	
	class SiteController {
		function __construct()
		{

		}

		function frontLayout($path = null, $variables = [], $partials = true)
		{
			if(file_exists(base_path("views/partials/header.php")) && $partials)
			{
				include base_path("views/partials/header.php");
			}
			if(isset($path) && $path)
			{
				extract($variables);
				include base_path("views/".$path);
			}
			if(file_exists(base_path("views/partials/footer.php")) && $partials)
			{
				include base_path("views/partials/footer.php");
			}
		}

		function adminLayout($path = null, $variables = [], $partials = true)
		{
			if(file_exists(base_path("views/admin/partials/header.php")) && $partials)
			{
				include base_path("views/admin/partials/header.php");
			}
			if(isset($path) && $path)
			{
				extract($variables);
				include base_path("views/admin/".$path.".php");
			}
			if(file_exists(base_path("views/admin/partials/footer.php")) && $partials)
			{
				include base_path("views/admin/partials/footer.php");
			}
		}
	}

