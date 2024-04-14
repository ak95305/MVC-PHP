<?php

class WelcomeController extends SiteController{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->adminLayout("welcome");
	}
}

