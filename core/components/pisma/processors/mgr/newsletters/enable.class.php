<?php

/**
 * Enable an Item
 */
class pismaNewsletterEnableProcessor extends modObjectProcessor {
	public $objectType = 'pismaNewsletter';
	public $classKey = 'pismaNewsletter';
	public $languageTopics = array('pisma');
	//public $permission = 'save';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('pisma_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var PismaItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('pisma_item_err_nf'));
			}

			$object->set('active', true);
			$object->save();
		}

		return $this->success();
	}

}

return 'pismaNewsletterEnableProcessor';