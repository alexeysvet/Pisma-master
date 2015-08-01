<?php
$xpdo_meta_map['pismaQueue']= array (
  'package' => 'pisma',
  'version' => '1.1',
  'table' => 'pisma_queue',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'newsletter' => 0,
    'subscriber' => 0,
    'sent' => 0,
  ),
  'fieldMeta' => 
  array (
    'newsletter' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
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
    'sent' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'Newsletter' => 
    array (
      'class' => 'pismaNewsletter',
      'local' => 'newsletter',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Subscriber' => 
    array (
      'class' => 'pismaSubscriber',
      'local' => 'subscriber',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
