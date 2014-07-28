<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "bootstrap_grids"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Grids for bootstrap',
	'description' => 'Gridelements for bootstrap_core. Column grids, grids for simple accordions, tabs and content slider.',
	'category' => 'misc',
	'author' => 'Pascal Mayer',
	'author_email' => 'typo3@simple.ch',
	'author_company' => 'simplicity gmbh',
	'shy' => '',
	'version' => '1.0.0',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-6.2.99',
			'gridelements' => '2.9.99-0.0.0',
		),
		'conflicts' => array(
		),
	),
);

?>