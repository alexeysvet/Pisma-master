<?php
/**
 * The base class for Pisma.
 */
class Pisma {
	/* @var modX $modx */
	public $modx;
	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()) {
		$this->modx =& $modx;
		$corePath = $this->modx->getOption('pisma_core_path', $config, $this->modx->getOption('core_path') . 'components/pisma/');
		$assetsUrl = $this->modx->getOption('pisma_assets_url', $config, $this->modx->getOption('assets_url') . 'components/pisma/');
		$connectorUrl = $assetsUrl . 'connector.php';
		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $connectorUrl,
			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);
		$this->modx->addPackage('pisma', $this->config['modelPath']);
		$this->modx->lexicon->load('pisma:default');
	}
}