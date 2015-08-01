<?php

/**
 * Get a list of Items
 */
class pismaGroupGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'pismaGroup';
	public $classKey = 'pismaGroup';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	//public $permission = 'list';


	/**
	 * * We doing special check of permission
	 * because of our objects is not an instances of modAccessibleObject
	 *
	 * @return boolean|string
	 */
	public function beforeQuery() {
		if (!$this->checkPermissions()) {
			return $this->modx->lexicon('access_denied');
		}

		return true;
	}


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		$query = trim($this->getProperty('query'));
		if ($query) {
			$c->where(array(
				'name:LIKE' => "%{$query}%",
				'OR:description:LIKE' => "%{$query}%",
			));
		}

		return $c;
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		$array['actions'] = array();

		// Remove
		$array['actions'][] = array(
			'cls' => '',
			'icon' => 'icon icon-trash-o action-red',
			'title' => $this->modx->lexicon('pisma_newsletter_remove'),
			'multiple' => $this->modx->lexicon('pisma_newsletters_remove'),
			'action' => 'removeItem',
			'button' => true,
			'menu' => true,
		);

		return $array;
	}

}

return 'pismaGroupGetListProcessor';