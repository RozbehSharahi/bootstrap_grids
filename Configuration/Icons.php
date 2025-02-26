<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

// Register icons
$iconList = [];
foreach ([
    'tx-bootstrapgrids-col2'       => 'gridlayout_col2.svg',
    'tx-bootstrapgrids-col3'       => 'gridlayout_col3.svg',
    'tx-bootstrapgrids-col4'       => 'gridlayout_col4.svg',
    'tx-bootstrapgrids-simpletabs' => 'grid_simpletabs.svg',
    'tx-bootstrapgrids-tabs4'      => 'grid_tabs4.svg',
    'tx-bootstrapgrids-tabs6'      => 'grid_tabs6.svg',
    'tx-bootstrapgrids-accordion'  => 'grid_accordion.svg',
] as $identifier => $path) {
    $iconList[$identifier] = [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:bootstrap_grids/Resources/Public/Icons/' . $path,
    ];
}

return $iconList;
