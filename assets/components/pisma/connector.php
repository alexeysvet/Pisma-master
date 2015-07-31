<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var Pisma $Pisma */
$Pisma = $modx->getService('pisma', 'Pisma', $modx->getOption('pisma_core_path', null, $modx->getOption('core_path') . 'components/pisma/') . 'model/pisma/');
$modx->lexicon->load('pisma:default');

// handle request
$corePath = $modx->getOption('pisma_core_path', null, $modx->getOption('core_path') . 'components/pisma/');
$path = $modx->getOption('processorsPath', $Pisma->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));