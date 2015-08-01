<?php
class pismaSubscriberGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'pismaSubscriber';
	public $classKey = 'pismaSubscriber';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	//public $permission = 'list';

	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}
		return true;
	}

	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();

		// Edit
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-edit',
			'title' => $this->modx->lexicon('pisma_subscriber_update'),
			'action' => 'updateItem',
			'button' => true,
			'menu' => true,
		);

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('pisma_subscriber_remove'),
			'multiple' => $this->modx->lexicon('pisma_subscribers_remove'),
			'action' => 'removeItem',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'pismaSubscriberGetListProcessor';