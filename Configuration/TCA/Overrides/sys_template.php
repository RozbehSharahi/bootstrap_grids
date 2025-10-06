<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function(): void {
    ExtensionManagementUtility::addStaticFile(
        'bootstrap_grids',
        'Configuration/TypoScript/Frontend/',
        'Grids for Bootstrap'
    );
})();
