<?php
if (!defined('TYPO3_MODE')) { die('Access denied.'); }

call_user_func(
    function ($extConfString) {

        // register icons
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-col2',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col2.gif']
        );
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-col3',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col3.gif']
        );
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-col4',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_col4.gif']
        );
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-simpletabs',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_simpletabs.png']
        );
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-tabs4',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_tabs4.png']
        );
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-tabs6',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_tabs6.png']
        );
        $iconRegistry->registerIcon(
            'tx-bootstrapgrids-accordion',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:bootstrap_grids/Resources/Public/Icons/grid_accordion.png']
        );

        // Add pageTS config
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:bootstrap_grids/Configuration/TypoScript/pageTs/tsconfig.ts">');

    },$_EXTCONF
);
?>