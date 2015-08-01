<?php
$xpdo_meta_map['pismaSubscriber']= array (
  'package' => 'pisma',
  'version' => '1.1',
  'table' => 'pisma_subscribers',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'firstname' => '',
    'lastname' => '',
    'company' => '',
    'email' => '',
    'code' => '',
    'active' => 0,
    'signupdate' => 0,
  ),
  'fieldMeta' => 
  array (
    'firstname' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'lastname' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'company' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
    ),
    'code' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '32',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'active' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'signupdate' => 
    array (
      'dbtype' => 'int',
      'precision' => '20',
      'phptype' => 'timestamp',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'Groups' => 
    array (
      'class' => 'pismaGroupSubscribers',
      'local' => 'id',
      'foreign' => 'subscriber',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Queue' => 
    array (
      'class' => 'pismaQueue',
      'local' => 'id',
      'foreign' => 'subscriber',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'validation' => 
  array (
    'rules' => 
    array (
      'email' => 
      array (
        'validEmail' => 
        array (
          'type' => 'preg_match',
          'rule' => '/^[_a-zA-Z0-9-]+(\\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\\.[a-zA-Z0-9-]+)+$/i',
          'message' => 'Email address invalid',
        ),
      ),
    ),
  ),
);
