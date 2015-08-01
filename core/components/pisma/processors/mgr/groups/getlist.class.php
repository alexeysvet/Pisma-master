<?php
class pismaGroupGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'pismaGroup';
	public $classKey = 'pismaGroup';
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

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('pisma_group_remove'),
			'multiple' => $this->modx->lexicon('pisma_groups_remove'),
			'action' => 'removeItem',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'pismaGroupGetListProcessor';