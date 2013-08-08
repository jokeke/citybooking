<?php

// change the following paths if necessary

// DELETE IF YOU SEE IT
/*$link = mysql_connect('mysqlserver', 'citybooking', 'citybooking11');
if (!$link) {
    die('Не удалось соединиться : ' . mysql_error());
}
mysql_select_db("citybooking_yii");

$result = mysql_query("SELECT * FROM `hotels`");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	if(is_null($row['images'])) {		
    	$insert = mysql_query("UPDATE `hotels` SET `images`='a:0:{}' WHERE `id` = ".$row['id']);
	}
}*/


// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

$yii=dirname(__FILE__).'/yii/framework/yii.php';
//$config=dirname(__FILE__).'/protected/config/main.php';
// Include config files
$configMain = require_once( dirname( __FILE__ ) . '/protected/config/main.php' );
$configServer = require_once( dirname( __FILE__ ) . '/protected/config/server.php' );
 
// Include Yii framework
require_once( $yii );
 
// Run application
$config = CMap::mergeArray( $configMain, $configServer );
Yii::createWebApplication( $config )->run();


