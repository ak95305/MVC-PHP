<?php

	class UsersController extends SiteController{
		function _construct()
		{

		}

		public function index($param = null)
		{
			pr($param);
			pr("hey");
		}

		public function add()
		{
			$this->frontLayout();
		}
	}

