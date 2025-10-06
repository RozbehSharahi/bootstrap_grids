<?php

/** @var $_EXTKEY */
$EM_CONF[$_EXTKEY] = [
	'title' => 'Grids for bootstrap',
	'description' => 'Gridelements for bootstrap v5. Column grids, tabs and accordion.',
	'category' => 'misc',
	'author' => 'Rozbeh Chiryai Sharahi',
	'author_email' => 'rozbeh.sharahi+bootstrap_grids@gmail.com',
	'author_company' => '',
	'version' => '13.0.0',
	'state' => 'stable',
	'constraints' => [
		'depends' => [
			'typo3' => '13.4.0-13.4.99',
			'gridelements' => '13.0.0-13.99.99',
		],
		'conflicts' => [],
        'suggests' => [],
	],
    'autoload' => [
        'psr-4' => ['Laxap\\BootstrapGrids\\' => 'Classes']
    ],
];
