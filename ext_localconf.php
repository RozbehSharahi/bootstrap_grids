<?php
if (!defined('TYPO3_MODE')) { die('Access denied.'); }

call_user_func(
    function ($extConfString) {

        // Add pageTS config
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_grids/Configuration/TypoScript/tsconfig.ts">');

        // Get ext configuration
        strlen($extConfString)?$extConf = unserialize($extConfString):$extConf = array();

        // Only if enabled
        if ( isset($extConf['enableGridSimpleRow']) && $extConf['enableGridSimpleRow'] ) {
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_grids/Configuration/TypoScript/simpleRow/tsconfig.ts">');
        }

    },$_EXTCONF
);
?>