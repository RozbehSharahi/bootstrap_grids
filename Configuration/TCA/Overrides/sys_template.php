<?php
// Add an entry in the static template list found in sys_templates for static TS
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function() {
    ExtensionManagementUtility::addStaticFile(
        'bootstrap_grids',
        'Configuration/TypoScript/',
        'Grids for Bootstrap (deprecated)'
    );
    ExtensionManagementUtility::addStaticFile(
        'bootstrap_grids',
        'Configuration/TypoScript/DataProcessingLibContentElement/',
        'Grids for Bootstrap (recommended, w/DataProcessing)'
    );
})();