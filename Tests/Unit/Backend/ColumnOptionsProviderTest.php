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
