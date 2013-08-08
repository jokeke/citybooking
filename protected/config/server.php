<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
		// uncomment the following to use a MySQL database
    'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=mysqlserver;dbname=citybooking_yii',
			'emulatePrepare' => true,
			'username' => 'citybooking',
			'password' => 'citybooking11',
			'charset' => 'utf8',
		),
    )
);