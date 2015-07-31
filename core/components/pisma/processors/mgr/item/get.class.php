<?php

/**
 * Get an Item
 */
class PismaItemGetProcessor extends modObjectGetProcessor {
	public $objectType = 'PismaItem';
	public $classKey = 'PismaItem';
	public $languageTopics = array('pisma:default');
	//public $permission = 'view';


	/**
	 * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return mixed
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		return parent::process();
	}

}

return 'PismaItemGetProcessor';