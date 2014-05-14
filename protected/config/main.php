<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
//echo dirname(__FILE__).'/../extensions/bootstrap';die;
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
        'defaultController'=>'site/login',
	// preloading 'log' component
	'preload'=>array('log'),
        
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
        'theme'=>'blackboot', //'bootstrap',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                            'bootstrap.gii',
                        ),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
                        'loginUrl'=>array('accounts/login'),
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
                'cache'=>array( 
                    'class'=>'system.caching.CDbCache'
                ),
                'bootstrap'=>array(
                    'class'=>'bootstrap.components.Bootstrap',
                ),
		// uncomment the following to enable URLs in path-format
		
		/*'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),*/
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=blog',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
                        'enabled' => YII_DEBUG,
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning , trace',
				),
				// uncomment the following to show log messages on web pages
                                
				array(
					'class'=>'CWebLogRoute',
                                        'levels'=>'error, warning , info',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'uploads' => 'images/thumbs',
	),
);