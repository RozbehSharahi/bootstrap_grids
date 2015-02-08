<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// --- Get extension configuration ---
$extConf = array();
if ( strlen($_EXTCONF) ) {
	$extConf = unserialize($_EXTCONF);
}

// Add static typoscript configurations
// Default stuff and grid definitions
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Grids for Bootstrap');

// Grids based on db record uid vs. new version with names as layout ids
if ( isset($extConf['useOldRecordIds']) && $extConf['useOldRecordIds'] ) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/old', 'Grids for db records (uids)');
}

?>