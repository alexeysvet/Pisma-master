<?php

/**
 * Create an Item
 */
class PismaItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'PismaItem';
	public $classKey = 'PismaItem';
	public $languageTopics = array('pisma');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('pisma_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('pisma_item_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'PismaItemCreateProcessor';