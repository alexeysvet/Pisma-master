<?php

/**
 * Create an Item
 */
class pismaGroupCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'pismaGroup';
	public $classKey = 'pismaGroup';
	public $languageTopics = array('pisma');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('pisma_group_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('pisma_group_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'pismaGroupCreateProcessor';