<?php

namespace CDK;

class ModuleWeatherCall extends \Module
{
	protected $strTemplate = 'mod_weathercall';

	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['weathercall'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}

	public function compile()
	{
		$strLocation = $this->location;

		if(FE_USER_LOGGED_IN)
		{
			$this->Import('FrontendUser', 'Member');

			if($this->use_userSetting && $this->Member->city)
			{
				$strLocation = $this->Member->city;
			}
		}

		if(\Input::Get('lat') && \Input::Get('lon'))
		{
			$_SESSION['lat'] = \Input::Get('lat');
			$_SESSION['lon'] = \Input::Get('lon');

			$strSearch = "lat=" . \Input::Get('lat') . "&lon=" . \Input::Get('lon');
		}
		elseif($_SESSION['lat'] && $_SESSION['lon'])
		{
			$strSearch = "lat=" . $_SESSION['lat'] . "&lon=" . $_SESSION['lon'];
		}
		else
		{
			$strSearch = "q=" . urlencode($strLocation);
		}

		$objXML = @simplexml_load_string(file_get_contents("http://api.openweathermap.org/data/2.5/weather?" . $strSearch . "&lang=de&units=metric&mode=xml&appid=" . $this->owm_apikey));

		if($objXML)
		{
			if(\Input::Get('isAjax'))
			{
				echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
				echo "<weather>\n";
				echo "    <city>" . trim($objXML->city->attributes()['name']) . "</city>\n";
				echo "    <temperature>" . round(trim($objXML->temperature->attributes()['value']), 1) . "</temperature>\n";
				echo "    <icon>http://openweathermap.org/img/w/" . trim($objXML->weather->attributes()['icon']) . ".png</icon>\n";
				echo "</weather>\n";
			}
			else
			{
				if($this->use_geoLocation)
				{
					$objJSTemplate = new \FrontendTemplate('weather_geocheck');
					$objJSTemplate->id = $this->id;

					$GLOBALS['TL_JQUERY']['weather_call'] = '<script>' . $objJSTemplate->parse() . '</script>';
				}

				$this->Template->city = trim($objXML->city->attributes()['name']);
				$this->Template->temperature = round(trim($objXML->temperature->attributes()['value']), 1);
				$this->Template->icon = "http://openweathermap.org/img/w/" . trim($objXML->weather->attributes()['icon']) . ".png";
			}
		}
	}
}