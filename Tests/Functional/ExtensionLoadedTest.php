<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Tests\Functional;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

final class ExtensionLoadedTest extends FunctionalTestCase
{
    protected array $testExtensionsToLoad = [
        'gridelementsteam/gridelements',
        'laxap/bootstrap-grids',
    ];

    protected array $coreExtensionsToLoad = [
        'typo3/cms-tstemplate',
    ];

    protected bool $initializeDatabase = false;

    #[Test]
    public function bootstrapGridsIsLoaded(): void
    {
        self::assertTrue(ExtensionManagementUtility::isLoaded('bootstrap_grids'));
    }

    #[Test]
    public function gridelementsIsLoaded(): void
    {
        self::assertTrue(ExtensionManagementUtility::isLoaded('gridelements'));
    }

    #[Test]
    public function staticTypoScriptIsRegistered(): void
    {
        $items = $GLOBALS['TCA']['sys_template']['columns']['include_static_file']['config']['items'] ?? [];
        $values = [];
        foreach ($items as $item) {
            $values[] = is_array($item) ? ($item['value'] ?? $item[1] ?? '') : '';
        }

        self::assertContains(
            'EXT:bootstrap_grids/Configuration/TypoScript/Frontend/',
            $values
        );
    }
}
