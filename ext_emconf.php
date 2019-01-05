<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "bootstrap_grids"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
	'title' => 'Grids for bootstrap',
	'description' => 'Gridelements for bootstrap. Column grids, grids for simple accordions, tabs and content slider.',
	'category' => 'misc',
	'author' => 'Pascal Mayer',
	'author_email' => 'typo3@lascap.ch',
	'author_company' => '',
	'version' => '1.4.1',
	'state' => 'stable',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'constraints' => [
		'depends' => [
			'typo3' => '8.7.0-9.5.99',
			'gridelements' => '8.0.0-0.0.0',
		],
		'conflicts' => [
		],
	],
    'autoload' => [
        'psr-4' => ['Laxap\\BootstrapGrids\\' => 'Classes']
    ],
];

?>