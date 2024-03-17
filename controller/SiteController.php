<?php
	
	class SiteController {
		function _construct()
		{

		}

		function frontLayout($path = null)
		{
			if(file_exists(base_path("views/partials/header.php")))
			{
				include base_path("views/partials/header.php");
			}
			if(isset($path) && $path)
			{
				include base_path("views/".$path);
			}
			if(file_exists(base_path("views/partials/footer.php")))
			{
				include base_path("views/partials/footer.php");
			}
		}
	}

