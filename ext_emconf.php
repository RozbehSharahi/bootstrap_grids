<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "bootstrap_grids"
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Grids for bootstrap',
	'description' => 'Gridelements for bootstrap. Column grids, grids for simple accordions, tabs and content slider.',
	'category' => 'misc',
	'author' => 'Pascal Mayer',
	'author_email' => 'typo3@bsdist.ch',
	'author_company' => '',
	'shy' => '',
	'version' => '1.2.0',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-7.6.99',
			'gridelements' => '3.3.0-0.0.0',
		),
		'conflicts' => array(
		),
	),
);

?>