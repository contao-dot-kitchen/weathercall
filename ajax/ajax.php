<?php

$arrPost = $_POST;
unset($_POST);

define('TL_MODE', 'FE');
require('../../../../system/initialize.php');

$_POST = $arrPost;

class CDKAjaxRequest extends \Frontend
{
	public function __construct()
	{
		parent::__construct();
		define('BE_USER_LOGGED_IN', $this->getLoginStatus('BE_USER_AUTH'));
		define('FE_USER_LOGGED_IN', $this->getLoginStatus('FE_USER_AUTH'));
		\Controller::setStaticUrls('TL_FILES_URL', $GLOBALS['TL_CONFIG']['staticFiles']);
		\Controller::setStaticUrls('TL_SCRIPT_URL', $GLOBALS['TL_CONFIG']['staticSystem']);
		\Controller::setStaticUrls('TL_PLUGINS_URL', $GLOBALS['TL_CONFIG']['staticPlugins']);
	}

	public function run()
	{
		if(\Input::Get('id'))
		{
			$objModule = $this->Database->prepare("SELECT * FROM tl_module WHERE id=?")->execute(\Input::Get('id'));
			$strClass  = $this->findFrontendModule($objModule->type);

			if ($this->classFileExists($strClass))
			{
				$objModule->typePrefix = 'mod_';
				$objModule = new $strClass($objModule, $strColumn);
				echo $objModule->compile();
			}
		}
	}
}

$CDKAjaxRequest = new CDKjaxRequest();
$CDKAjaxRequest->run();