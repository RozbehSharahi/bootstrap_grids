<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Command;

use Laxap\BootstrapGrids\Service\FixtureGeneratorService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\ConnectionPool;

#[AsCommand(name: 'bootstrap-grids:setup-database', hidden: true)]
class SetupDatabaseCommand extends Command
{
    public const ADMIN_USERNAME = 'admin';
    public const ADMIN_PASSWORD = 'Password123_';

    /**
     * Must match the TYPO3_CONTEXT set in .docker/compose.base.yml - this
     * command must never run outside the docker dev environment.
     */
    private const DOCKER_CONTEXT = 'Development/BootstrapGrids/Docker';

    private int $sorting = 1;

    public function __construct(
        private readonly ConnectionPool $connectionPool,
        private readonly FixtureGeneratorService $fixtureGenerator,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!str_starts_with((string) Environment::getContext(), self::DOCKER_CONTEXT)) {
            return Command::SUCCESS;
        }

        $this->applyFixturesIfDbEmpty($output);
        $output->writeln('Database setup completed.');

        return Command::SUCCESS;
    }

    private function applyFixturesIfDbEmpty(OutputInterface $output): self
    {
        if ($this->getRowCount('pages') !== 0) {
            $output->writeln('Skipping database setup, as it already contains pages.');
            return $this;
        }

        if ($this->getRowCount('be_users') > 1) {
            $output->writeln('Skipping database setup, as it already contains a user besides the cli user.');
            return $this;
        }

        $connection = $this->connectionPool->getConnectionForTable('be_users');
        $connection->insert('be_users', [
            'username' => self::ADMIN_USERNAME,
            'password' => password_hash(self::ADMIN_PASSWORD, PASSWORD_ARGON2ID),
            'admin' => 1,
            'tstamp' => time(),
            'crdate' => time(),
            'disable' => 0,
            'starttime' => 0,
            'endtime' => 0,
            'deleted' => 0,
            'email' => self::ADMIN_USERNAME,
        ]);

        $connection->insert('pages', [
            'pid' => 0,
            'is_siteroot' => 1,
            'title' => 'Site',
            'slug' => '/',
        ]);

        $pageId = (int) $connection->lastInsertId();

        $this->connectionPool->getConnectionForTable('sys_template')
            ->insert('sys_template', [
                'pid' => $pageId,
                'title' => 'Main Template',
                'root' => 1,
                'clear' => 3,
                'include_static_file' => implode(',', [
                    'EXT:fluid_styled_content/Configuration/TypoScript/',
                    'EXT:gridelements/Configuration/TypoScript/DataProcessingLibContentElement',
                    'EXT:bootstrap_grids/Configuration/TypoScript/Frontend/',
                ]),
                'constants' => '',
                'config' => '',
                'tstamp' => time(),
                'crdate' => time(),
                'deleted' => 0,
                'hidden' => 0,
            ]);

        $this->createFixtures($pageId);

        return $this;
    }

    private function createFixtures(int $pageId): void
    {
        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            '2cols',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'mdCol1' => 'col-6',
                'mdCol2' => 'col-6',
            ]]),
            [
                101 => [['Column A', $this->dummyText('two columns, column A')]],
                102 => [['Column B', $this->dummyText('two columns, column B')]],
            ]
        );

        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            '3cols',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'mdCol1' => 'col-4',
                'mdCol2' => 'col-4',
                'mdCol3' => 'col-4',
            ]]),
            [
                101 => [['Column A', $this->dummyText('three columns, column A')]],
                102 => [['Column B', $this->dummyText('three columns, column B')]],
                103 => [['Column C', $this->dummyText('three columns, column C')]],
            ]
        );

        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            '4cols',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'mdCol1' => 'col-3',
                'mdCol2' => 'col-3',
                'mdCol3' => 'col-3',
                'mdCol4' => 'col-3',
            ]]),
            [
                101 => [['Column A', $this->dummyText('four columns, column A')]],
                102 => [['Column B', $this->dummyText('four columns, column B')]],
                103 => [['Column C', $this->dummyText('four columns, column C')]],
                104 => [['Column D', $this->dummyText('four columns, column D')]],
            ]
        );

        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            'tabsSimple',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'style' => 'tab-v1',
            ]]),
            [
                101 => [
                    ['Tab One', $this->dummyText('tabs from content elements, tab one')],
                    ['Tab Two', $this->dummyText('tabs from content elements, tab two')],
                    ['Tab Three', $this->dummyText('tabs from content elements, tab three')],
                ],
            ]
        );

        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            'tabs4',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'style' => 'tab-v1',
                'tabTitle1' => 'Tab 1',
                'tabTitle2' => 'Tab 2',
                'tabTitle3' => 'Tab 3',
                'tabTitle4' => 'Tab 4',
            ]]),
            [
                101 => [['Tab 1', $this->dummyText('tabs 4, tab 1')]],
                102 => [['Tab 2', $this->dummyText('tabs 4, tab 2')]],
                103 => [['Tab 3', $this->dummyText('tabs 4, tab 3')]],
                104 => [['Tab 4', $this->dummyText('tabs 4, tab 4')]],
            ]
        );

        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            'tabs6',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'style' => 'tab-v1',
                'tabTitle1' => 'Tab 1',
                'tabTitle2' => 'Tab 2',
                'tabTitle3' => 'Tab 3',
                'tabTitle4' => 'Tab 4',
                'tabTitle5' => 'Tab 5',
                'tabTitle6' => 'Tab 6',
            ]]),
            [
                101 => [['Tab 1', $this->dummyText('tabs 6, tab 1')]],
                102 => [['Tab 2', $this->dummyText('tabs 6, tab 2')]],
                103 => [['Tab 3', $this->dummyText('tabs 6, tab 3')]],
                104 => [['Tab 4', $this->dummyText('tabs 6, tab 4')]],
                105 => [['Tab 5', $this->dummyText('tabs 6, tab 5')]],
                106 => [['Tab 6', $this->dummyText('tabs 6, tab 6')]],
            ]
        );

        $this->createGridElement(
            $pageId,
            $this->getSortingNext(),
            'accordion',
            $this->fixtureGenerator->buildFlexForm(['sDEF' => [
                'rowclass' => 'first-opened',
            ]]),
            [
                101 => [
                    ['Item One', $this->dummyText('accordion, item one')],
                    ['Item Two', $this->dummyText('accordion, item two')],
                    ['Item Three', $this->dummyText('accordion, item three')],
                ],
            ]
        );
    }

    /**
     * @param array<int, array<int, array{0: string, 1: string}>> $columns tx_gridelements_columns (the layout's cell colPos) => list of [header, bodytext] children
     */
    private function createGridElement(
        int $pageId,
        int $sorting,
        string $layoutIdentifier,
        string $flexform,
        array $columns,
    ): void {
        $ttContent = $this->connectionPool->getConnectionForTable('tt_content');

        $childCount = array_sum(array_map('count', $columns));

        $ttContent->insert('tt_content', [
            'pid' => $pageId,
            'CType' => 'gridelements_pi1',
            'colPos' => 0,
            'tx_gridelements_backend_layout' => $layoutIdentifier,
            'tx_gridelements_children' => $childCount,
            'pi_flexform' => $flexform,
            'sorting' => $sorting,
            'tstamp' => time(),
            'crdate' => time(),
            'deleted' => 0,
            'hidden' => 0,
        ]);

        $containerId = (int) $ttContent->lastInsertId();

        foreach ($columns as $colPos => $children) {
            foreach ($children as [$childHeader, $bodytext]) {
                $ttContent->insert('tt_content', [
                    'pid' => $pageId,
                    'CType' => 'text',
                    'colPos' => -1,
                    'tx_gridelements_container' => $containerId,
                    'tx_gridelements_columns' => $colPos,
                    'header' => $childHeader,
                    'bodytext' => $bodytext,
                    'sorting' => $this->getSortingNext(),
                    'tstamp' => time(),
                    'crdate' => time(),
                    'deleted' => 0,
                    'hidden' => 0,
                ]);
            }
        }
    }

    private function getSortingNext(): int
    {
        return $this->sorting++;
    }

    private function dummyText(string $label): string
    {
        return sprintf(
            '<p>Example content &mdash; %s &mdash; Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
            htmlspecialchars($label, ENT_QUOTES)
        );
    }

    private function getRowCount(string $table): int
    {
        $query = $this->connectionPool->getQueryBuilderForTable($table);

        try {
            $rows = $query->select('*')
                ->from($table)
                ->executeQuery()
                ->fetchAllAssociative();
        } catch (\Throwable $e) {
            throw new \RuntimeException('Could not query database table: ' . $e->getMessage());
        }

        return count($rows);
    }
}
