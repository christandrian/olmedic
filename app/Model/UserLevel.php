<?php
App::uses('AppModel', 'Model');
/**
 * UserLevel Model
 *
 */
class UserLevel extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'user_level';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Level';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'Level';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'Level' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
