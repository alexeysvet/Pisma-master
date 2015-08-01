<?php
$xpdo_meta_map['pismaNewsletter']= array (
  'package' => 'pisma',
  'version' => '1.1',
  'table' => 'pisma_newsletters',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'title' => '',
    'date' => 0,
    'message' => '',
    'attachment' => '',
  ),
  'fieldMeta' => 
  array (
    'title' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'date' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 0,
    ),
    'message' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'attachment' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'composites' => 
  array (
    'Queue' => 
    array (
      'class' => 'pismaQueue',
      'local' => 'id',
      'foreign' => 'newsletter',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
