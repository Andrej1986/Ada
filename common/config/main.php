<?php
return [
	'language' => 'sk',
	'aliases'    => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'modules'    => [
		'admin' => [
			'class' => 'mdm\admin\Module',
		]
	],
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
		'user' => [
//			'class' => 'mdm\admin\models\User',
			'identityClass' => 'mdm\admin\models\User',
			'loginUrl' => ['admin/user/login'],
		],
		'as access' => [
			'class' => 'mdm\admin\components\AccessControl',
			'allowActions' => [
				'site/*',
//				'admin/*',
//				'event/*',
//				'calendar/*',
			]
		],
	],
];
