<?php

$settings = array();

$tmp = array(
	'core_path' => array(
		'xtype' => 'textfield',
		'value' => '{base_path}Pisma-master/core/components/pisma/',
		'namespace' => 'pisma',
		'area' => 'settings',
	),
	'assets_path' => array(
		'xtype' => 'textfield',
		'value' => '{base_path}Pisma-master/assets/components/pisma/',
		'namespace' => 'pisma',
		'area' => 'settings',
	),
	'assets_url' => array(
		'xtype' => 'textfield',
		'value' => '/Pisma-master/assets/components/pisma/',
		'namespace' => 'pisma',
		'area' => 'settings',
	),
);


foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'pisma_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
