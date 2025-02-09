<?php

/** @var $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
	'title' => 'Grids for bootstrap',
	'description' => 'Gridelements for bootstrap v5. Column grids, tabs and accordion.',
	'category' => 'misc',
	'author' => 'Rozbeh Chiryai Sharahi',
	'author_email' => 'rozbeh.sharahi+bootstrap_grids@gmail.com',
	'author_company' => '',
	'version' => '5.0.0',
	'state' => 'stable',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'constraints' => [
		'depends' => [
			'typo3' => '12.4.0-12.99.99',
			'gridelements' => '12.0.0-12.99.99',
		],
		'conflicts' => [],
        'suggests' => [],
	],
    'autoload' => [
        'psr-4' => ['Laxap\\BootstrapGrids\\' => 'Classes']
    ],
];
