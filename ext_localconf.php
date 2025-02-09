<?php

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

(static function () {

    // register icons
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-col2',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col2.gif']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-col3',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col3.gif']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-col4',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col4.gif']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-simpletabs',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_simpletabs.png']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-tabs4',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_tabs4.png']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-tabs6',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_tabs6.png']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-accordion',
        BitmapIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_accordion.png']
    );

    // Add pageTS config
    ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_grids/Configuration/TypoScript/Backend/setup.typoscript">');

    if(getenv('TYPO3_CONTEXT') === 'Development/BootstrapGrids/Docker') {
        ExtensionManagementUtility::addTypoScript(
            'bootstrap_grids',
            'setup',
            "@import 'EXT:bootstrap_grids/Configuration/TypoScript/Contribution/setup.typoscript'",
        );
    }
})();