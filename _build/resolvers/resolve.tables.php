<?php

if ($object->xpdo) {
	/** @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$modelPath = $modx->getOption('pisma_core_path', null, $modx->getOption('core_path') . 'components/pisma/') . 'model/';
			$modx->addPackage('pisma', $modelPath);

			$manager = $modx->getManager();
			$objects = array(
				'pismaNewsletter',
				'pismaSubscriber',
				'pismaGroup',
				'pismaGroupSubscribers',
				'pismaQueue',
			);
			foreach ($objects as $tmp) {
				$manager->createObjectContainer($tmp);
			}
			break;

		case xPDOTransport::ACTION_UPGRADE:
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			break;
	}
}
return true;
