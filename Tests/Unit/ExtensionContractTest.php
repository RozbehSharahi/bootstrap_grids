<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ExtensionContractTest extends TestCase
{
    #[Test]
    #[DataProvider('flexFormFileProvider')]
    public function flexFormXmlIsWellFormed(string $path): void
    {
        $document = new \DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $loaded = $document->load($path);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        self::assertTrue($loaded, $path . ' ' . $this->formatLibxmlErrors($errors));
    }

    public static function flexFormFileProvider(): array
    {
        $files = glob(self::root() . '/Configuration/FlexForm/*.xml') ?: [];
        self::assertNotEmpty($files, 'Expected FlexForm XML files');

        $cases = [];
        foreach ($files as $file) {
            $cases[basename($file)] = [$file];
        }

        return $cases;
    }

    #[Test]
    public function iconMapFilesExist(): void
    {
        $source = file_get_contents(self::root() . '/Configuration/Icons.php');
        self::assertNotFalse($source);
        self::assertSame(1, preg_match('/\$iconsMap = (\[[\s\S]*?\]);/', $source, $matches));

        /** @var array<string, string> $iconsMap */
        $iconsMap = eval('return ' . $matches[1] . ';');
        self::assertNotEmpty($iconsMap);

        foreach ($iconsMap as $identifier => $filename) {
            $path = self::root() . '/Resources/Public/Icons/' . $filename;
            self::assertFileExists($path, $identifier . ' => ' . $filename);
        }
    }

    #[Test]
    public function staticTypoScriptPathFromSysTemplateExists(): void
    {
        $source = file_get_contents(self::root() . '/Configuration/TCA/Overrides/sys_template.php');
        self::assertNotFalse($source);
        self::assertSame(
            1,
            preg_match("/addStaticFile\(\s*'bootstrap_grids',\s*'([^']+)'/", $source, $matches)
        );

        $directory = self::root() . '/' . $matches[1];
        self::assertDirectoryExists($directory);
        self::assertFileExists($directory . 'setup.typoscript');
    }

    #[Test]
    public function emconfMinimumsMatchComposerRequires(): void
    {
        $composer = json_decode(
            (string)file_get_contents(self::root() . '/composer.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $_EXTKEY = 'bootstrap_grids';
        $EM_CONF = [];
        require self::root() . '/ext_emconf.php';

        $depends = $EM_CONF[$_EXTKEY]['constraints']['depends'];
        [$gridelementsMin] = explode('-', $depends['gridelements'], 2);

        self::assertSame('12.4.0-13.99.99', $depends['typo3']);
        self::assertSame('12.1.0', $gridelementsMin);
        self::assertStringContainsString('^12.4', $composer['require']['typo3/cms-core']);
        self::assertStringContainsString('^13.4.7', $composer['require']['typo3/cms-core']);
        self::assertStringContainsString('^12.1', $composer['require']['gridelementsteam/gridelements']);
        self::assertStringContainsString('^13.0', $composer['require']['gridelementsteam/gridelements']);
    }

    private static function root(): string
    {
        return dirname(__DIR__, 2);
    }

    /**
     * @param list<\LibXMLError> $errors
     */
    private function formatLibxmlErrors(array $errors): string
    {
        return implode('; ', array_map(
            static fn(\LibXMLError $error): string => trim($error->message) . ' on line ' . $error->line,
            $errors
        ));
    }
}
