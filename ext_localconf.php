<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function() {
    ExtensionManagementUtility::addPageTSConfig('
        @import "EXT:bootstrap_grids/Configuration/TypoScript/Backend/setup.tsconfig"
    ');
})();