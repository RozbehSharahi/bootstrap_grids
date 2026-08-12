<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Tests\Functional;

use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\View\ViewFactoryData;
use TYPO3\CMS\Core\View\ViewFactoryInterface;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

final class GridTemplateRenderTest extends FunctionalTestCase
{
    protected array $testExtensionsToLoad = [
        'gridelementsteam/gridelements',
        'laxap/bootstrap-grids',
    ];

    protected array $coreExtensionsToLoad = [
        'typo3/cms-tstemplate',
        'typo3/cms-fluid',
    ];

    protected bool $initializeDatabase = false;

    #[Test]
    public function twoColumnTemplateRendersBootstrapRowAndColumnClasses(): void
    {
        $html = $this->render('2cols', [
            'data' => [
                'uid' => 1,
                'flexform_rowValign' => 'align-items-center',
                'flexform_rowHalign' => 'justify-content-between',
                'flexform_rowCustom' => 'custom-row',
                'flexform_xsCol1' => 'col-6',
                'flexform_smCol1' => 'col-sm-6',
                'flexform_mdCol1' => 'col-md-4',
                'flexform_lgCol1' => '',
                'flexform_xlCol1' => '',
                'flexform_col21class' => 'first-col',
                'flexform_xsCol2' => 'col-6',
                'flexform_smCol2' => 'col-sm-6',
                'flexform_mdCol2' => 'col-md-8',
                'flexform_lgCol2' => '',
                'flexform_xlCol2' => '',
                'flexform_col22class' => 'second-col',
            ],
            'children' => [
                1 => [
                    101 => [],
                    102 => [],
                ],
            ],
            'options' => [],
            'settings' => [],
        ]);

        self::assertStringContainsString('class="row align-items-center justify-content-between custom-row"', $html);
        self::assertStringContainsString('class="col-6 col-sm-6 col-md-4   first-col"', $html);
        self::assertStringContainsString('class="col-6 col-sm-6 col-md-8   second-col"', $html);
    }

    #[Test]
    public function accordionTemplateOpensFirstItemWhenConfigured(): void
    {
        $html = $this->render('Accordion', [
            'data' => [
                'uid' => 20,
                'pi_flexform_content' => [
                    'rowclass' => 'first-opened',
                ],
            ],
            'children' => [
                1 => [
                    101 => [
                        [
                            'data' => ['uid' => 21, 'header' => 'First item'],
                            'children' => [],
                        ],
                        [
                            'data' => ['uid' => 22, 'header' => 'Second item'],
                            'children' => [],
                        ],
                    ],
                ],
            ],
            'options' => [],
            'settings' => [],
        ]);

        $html = $this->compact($html);

        self::assertStringContainsString('id="accordion-20"', $html);
        self::assertStringContainsString('class="accordion"', $html);
        self::assertStringContainsString('First item', $html);
        self::assertStringContainsString('Second item', $html);
        self::assertStringContainsString('accordion-collapse collapse show', $html);
        self::assertStringContainsString('accordion-button collapsed', $html);
    }

    #[Test]
    public function simpleTabsTemplateMarksFirstTabActive(): void
    {
        $html = $this->render('TabsSimple', [
            'data' => [
                'uid' => 30,
                'flexform_style' => 'tabs-style',
            ],
            'children' => [
                1 => [
                    101 => [
                        [
                            'data' => ['uid' => 31, 'header' => 'Tab one'],
                            'children' => [],
                        ],
                        [
                            'data' => ['uid' => 32, 'header' => 'Tab two'],
                            'children' => [],
                        ],
                    ],
                ],
            ],
            'options' => [],
            'settings' => [],
        ]);

        self::assertStringContainsString('class="simple-tabs tabs-style"', $html);
        self::assertStringContainsString('class="nav nav-tabs"', $html);
        self::assertStringContainsString('Tab one', $html);
        self::assertStringContainsString('nav-link active', $html);
        self::assertStringContainsString('tab-pane fade show active', $html);
        self::assertStringContainsString('id="nav-c31"', $html);
    }

    /**
     * @param array<string, mixed> $variables
     */
    private function render(string $template, array $variables): string
    {
        $viewFactory = $this->get(ViewFactoryInterface::class);
        $view = $viewFactory->create(new ViewFactoryData(
            templateRootPaths: ['EXT:bootstrap_grids/Resources/Private/Templates/Default/'],
            partialRootPaths: [
                'EXT:bootstrap_grids/Resources/Private/Partials/',
                'EXT:gridelements/Resources/Private/Partials/',
            ],
            layoutRootPaths: ['EXT:bootstrap_grids/Tests/Functional/Fixtures/Layouts/'],
        ));
        $view->assignMultiple($variables);

        return $view->render($template);
    }

    private function compact(string $html): string
    {
        return preg_replace('/\s+/', ' ', $html) ?? $html;
    }
}
