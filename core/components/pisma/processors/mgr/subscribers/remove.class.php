<?php

/**
 * Remove an Items
 */
class pismaSubscriberRemoveProcessor extends modObjectProcessor {
	public $objectType = 'pismaSubscriber';
	public $classKey = 'pismaSubscriber';
	public $languageTopics = array('pisma');
	//public $permission = 'remove';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('pisma_subscriber_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var PismaItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('pisma_subscriber_err_nf'));
			}

			$object->remove();
		}

		return $this->success();
	}

}

return 'pismaSubscriberRemoveProcessor';