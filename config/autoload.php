<?php

ClassLoader::addNamespaces(array
(
	'CDK',
	'CDK\FMD'
));

ClassLoader::addClasses(array
(
	'CDK\FMD\ModuleWeatherCall' => 'system/modules/weathercall/modules/ModuleWeatherCall.php'
));

TemplateLoader::addFiles(array
(
	'mod_weathercall'  => 'system/modules/weathercall/templates/modules',
	'weather_geocheck' => 'system/modules/weathercall/templates/jquery'
));
