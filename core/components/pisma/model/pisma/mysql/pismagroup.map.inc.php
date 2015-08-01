<?php
$xpdo_meta_map['pismaGroup']= array (
  'package' => 'pisma',
  'version' => '1.1',
  'table' => 'pisma_groups',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'public' => 0,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'public' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'Subscribers' => 
    array (
      'class' => 'pismaGroupSubscribers',
      'local' => 'id',
      'foreign' => 'group',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'validation' => 
  array (
    'rules' => 
    array (
      'name' => 
      array (
        'preventBlank' => 
        array (
          'type' => 'xPDOValidationRule',
          'rule' => 'xPDOMinLengthValidationRule',
          'value' => '1',
          'message' => 'Name is required.',
        ),
      ),
    ),
  ),
);
