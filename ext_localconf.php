<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// --- Get extension configuration ---
$extConf = array();
if ( strlen($_EXTCONF) ) {
	$extConf = unserialize($_EXTCONF);
}

// Define grids by pageTS config
// Special thank goes to Daniel Corn.
// Only if not set to use old record based uids
if ( ! isset($extConf['useOldRecordIds']) || ! $extConf['useOldRecordIds'] ) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_grids/Configuration/TypoScript/tsconfig.ts">');

	// Only if enabled
	if ( isset($extConf['enableGridSimpleRow']) && $extConf['enableGridSimpleRow'] ) {
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_grids/Configuration/TypoScript/simpleRow/tsconfig.ts">');
	}
}
?>