<?php

/**
 * Class PismaMainController
 */
abstract class PismaMainController extends modExtraManagerController {
	/** @var Pisma $Pisma */
	public $Pisma;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('pisma_core_path', null, $this->modx->getOption('core_path') . 'components/pisma/');
		require_once $corePath . 'model/pisma/pisma.class.php';

		$this->Pisma = new Pisma($this->modx);
		$this->addCss($this->Pisma->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->Pisma->config['jsUrl'] . 'mgr/pisma.js');
		$this->addHtml('
		<script type="text/javascript">
			Pisma.config = ' . $this->modx->toJSON($this->Pisma->config) . ';
			Pisma.config.connector_url = "' . $this->Pisma->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('pisma:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends PismaMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'newsletters';
	}
}