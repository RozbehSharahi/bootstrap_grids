<?php

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

(static function () {

    // register icons
    $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-col2',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col2.svg']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-col3',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col3.svg']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-col4',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col4.svg']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-simpletabs',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_simpletabs.svg']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-tabs4',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_tabs4.svg']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-tabs6',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_tabs6.svg']
    );
    $iconRegistry->registerIcon(
        'tx-bootstrapgrids-accordion',
        SvgIconProvider::class,
        ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_accordion.svg']
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
