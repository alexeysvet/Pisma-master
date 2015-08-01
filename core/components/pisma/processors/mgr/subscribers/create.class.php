<?php

class pismaSubscriberCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'pismaSubscriber';
	public $classKey = 'pismaSubscriber';
	public $languageTopics = array('pisma');



	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('pisma_subscriber_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('pisma_subscriber_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'pismaSubscriberCreateProcessor';