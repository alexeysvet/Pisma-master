<?php

/**
 * The home manager controller for Pisma.
 *
 */
class PismaHomeManagerController extends PismaMainController {
	/* @var Pisma $Pisma */
	public $Pisma;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('pisma');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->Pisma->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->Pisma->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->Pisma->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->Pisma->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->Pisma->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->Pisma->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->Pisma->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "pisma-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->Pisma->config['templatesPath'] . 'home.tpl';
	}
}