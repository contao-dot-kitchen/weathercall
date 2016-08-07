<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['weathercall'] = '{title_legend},name,headline,type;{config_legend},use_geoLocation,use_userSetting,owm_apikey,location;{template_legend:hide},navigationTpl,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['owm_apikey'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['owm_apikey'],
	'exclude'                 => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['location'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['location'],
	'exclude'                 => true,
	'sorting'                 => true,
	'flag'                    => 1,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['use_userSetting'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['use_userSetting'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['use_geoLocation'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['use_geoLocation'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "char(1) NOT NULL default ''"
);