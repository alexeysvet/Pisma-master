<?php
$xpdo_meta_map['pismaGroupSubscribers']= array (
  'package' => 'pisma',
  'version' => '1.1',
  'table' => 'pisma_groups_subscribers',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'subscriber' => 0,
    'group' => 0,
  ),
  'fieldMeta' => 
  array (
    'subscriber' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'group' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
  ),
  'aggregates' => 
  array (
    'Subscriber' => 
    array (
      'class' => 'pismaSubscriber',
      'local' => 'subscriber',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Group' => 
    array (
      'class' => 'pismaGroup',
      'local' => 'group',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
