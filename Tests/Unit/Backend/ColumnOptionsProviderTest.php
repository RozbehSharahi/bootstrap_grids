<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Tests\Unit\Backend;

use Laxap\BootstrapGrids\Backend\ColumnOptionsProvider;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ColumnOptionsProviderTest extends TestCase
{
    private ColumnOptionsProvider $subject;

    protected function setUp(): void
    {
        $this->subject = new ColumnOptionsProvider();
    }

    #[Test]
    #[DataProvider('breakpointFieldProvider')]
    public function lastCharacterOfFieldNameSelectsBreakpoint(string $field, string $expectedClass): void
    {
        $values = $this->values($this->subject->getColumnOptions($this->config($field)));

        self::assertContains($expectedClass, $values);
    }

    public static function breakpointFieldProvider(): array
    {
        return [
            'xs column 1' => ['xsCol1', 'col-6'],
            'xs column 2' => ['xsCol2', 'col-6'],
            'sm' => ['smCol1', 'col-sm-6'],
            'md' => ['mdCol1', 'col-md-6'],
            'lg' => ['lgCol1', 'col-lg-6'],
            'xl' => ['xlCol1', 'col-xl-6'],
        ];
    }

    #[Test]
    public function xsOptionsIncludeAutoLayoutAndNotSetSentinel(): void
    {
        $values = $this->values($this->subject->getColumnOptions($this->config('xsCol1')));

        self::assertContains('col', $values);
        self::assertContains('col-auto', $values);
        self::assertContains('---', $values);
        self::assertNotContains('d-sm-none', $values);
    }

    #[Test]
    #[DataProvider('hiddenClassProvider')]
    public function largerBreakpointsIncludeHiddenClass(string $field, string $hiddenClass): void
    {
        $values = $this->values($this->subject->getColumnOptions($this->config($field)));

        self::assertContains($hiddenClass, $values);
        self::assertContains(' ', $values);
    }

    public static function hiddenClassProvider(): array
    {
        return [
            'sm' => ['smCol1', 'd-sm-none'],
            'md' => ['mdCol1', 'd-md-none'],
            'lg' => ['lgCol1', 'd-lg-none'],
            'xl' => ['xlCol1', 'd-xl-none'],
        ];
    }

    #[Test]
    public function unknownFieldLeavesItemsUnchanged(): void
    {
        $config = $this->config('unknownField');
        $result = $this->subject->getColumnOptions($config);

        self::assertSame($config['items'], $result['items']);
    }

    #[Test]
    public function existingItemsAreKeptInFront(): void
    {
        $existing = [['Existing', 'keep-me']];
        $result = $this->subject->getColumnOptions($this->config('xsCol1', $existing));

        self::assertSame($existing[0], $result['items'][0]);
        self::assertContains('col-6', $this->values($result));
    }

    #[Test]
    public function languageLabelsUseExtensionXlf(): void
    {
        $items = $this->subject->getColumnOptions($this->config('xsCol1'))['items'];
        $labels = array_column($items, 0);
        $lllLabels = array_filter(
            $labels,
            static fn (string $label): bool => str_starts_with($label, 'LLL:')
        );

        self::assertNotEmpty($lllLabels);
        foreach ($lllLabels as $label) {
            self::assertStringStartsWith(
                'LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:',
                $label
            );
        }
    }

    #[Test]
    public function twoThreeAndFourColumnHelpersMatchGetColumnOptions(): void
    {
        $config = $this->config('xsCol1');

        self::assertSame(
            $this->subject->getColumnOptions($config),
            $this->subject->getTwoColumnOptions($config)
        );
        self::assertSame(
            $this->subject->getColumnOptions($config),
            $this->subject->getThreeColumnOptions($config)
        );
        self::assertSame(
            $this->subject->getColumnOptions($config),
            $this->subject->getFourColumnOptions($config)
        );
    }

    #[Test]
    #[DataProvider('exactValueListProvider')]
    public function breakpointExposesExactBootstrapClasses(string $field, array $expectedValues): void
    {
        $values = $this->values($this->subject->getColumnOptions($this->config($field)));

        self::assertSame($expectedValues, $values);
        self::assertContains('--div--', $values);
        self::assertSame(2, count(array_keys($values, '--div--', true)));
    }

    public static function exactValueListProvider(): array
    {
        return [
            'xs' => [
                'xsCol1',
                [
                    'col', 'col-3', 'col-4', 'col-6', 'col-8', 'col-9', '--div--',
                    'col-1', 'col-2', 'col-5', 'col-7', 'col-10', 'col-11', 'col-12', '--div--',
                    '---', 'col-auto',
                ],
            ],
            'sm' => [
                'smCol1',
                [
                    ' ', 'col-sm-3', 'col-sm-4', 'col-sm-6', 'col-sm-8', 'col-sm-9', '--div--',
                    'col-sm-1', 'col-sm-2', 'col-sm-5', 'col-sm-7', 'col-sm-10', 'col-sm-11', 'col-sm-12', '--div--',
                    'col-sm-auto', 'd-sm-none',
                ],
            ],
            'md' => [
                'mdCol1',
                [
                    ' ', 'col-md-3', 'col-md-4', 'col-md-6', 'col-md-8', 'col-md-9', '--div--',
                    'col-md-1', 'col-md-2', 'col-md-5', 'col-md-7', 'col-md-10', 'col-md-11', 'col-md-12', '--div--',
                    'col-md-auto', 'd-md-none',
                ],
            ],
            'lg' => [
                'lgCol1',
                [
                    ' ', 'col-lg-3', 'col-lg-4', 'col-lg-6', 'col-lg-8', 'col-lg-9', '--div--',
                    'col-lg-1', 'col-lg-2', 'col-lg-5', 'col-lg-7', 'col-lg-10', 'col-lg-11', 'col-lg-12', '--div--',
                    'col-lg-auto', 'd-lg-none',
                ],
            ],
            'xl' => [
                'xlCol1',
                [
                    ' ', 'col-xl-3', 'col-xl-4', 'col-xl-6', 'col-xl-8', 'col-xl-9', '--div--',
                    'col-xl-1', 'col-xl-2', 'col-xl-5', 'col-xl-7', 'col-xl-10', 'col-xl-11', 'col-xl-12', '--div--',
                    'col-xl-auto', 'd-xl-none',
                ],
            ],
        ];
    }

    #[Test]
    public function twoDigitColumnIndexIsNotTreatedAsBreakpoint(): void
    {
        $result = $this->subject->getColumnOptions($this->config('xsCol10'));

        self::assertSame([], $result['items']);
    }

    private function config(string $field, array $items = []): array
    {
        return [
            'field' => $field,
            'items' => $items,
        ];
    }

    /**
     * @return list<string>
     */
    private function values(array $config): array
    {
        return array_column($config['items'], 1);
    }
}
