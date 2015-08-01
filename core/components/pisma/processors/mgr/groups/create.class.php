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
		$title = trim($this->getProperty('title'));
		if (empty($title)) {
			$this->modx->error->addField('title', $this->modx->lexicon('pisma_newsletters_err_title'));
		}
		elseif ($this->modx->getCount($this->classKey, array('title' => $title))) {
			$this->modx->error->addField('title', $this->modx->lexicon('pisma_newsletters_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'pismaGroupCreateProcessor';