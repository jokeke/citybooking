<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
		// uncomment the following to use a MySQL database
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=citybooking',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
	)
);