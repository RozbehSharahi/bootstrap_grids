<?php
namespace Laxap\BootstrapGrids\Updates;

/*
 *
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *
 */

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('rewriteExtraSmallColumnWidth')]
class RewriteExtraSmallColumnWidth implements UpgradeWizardInterface
{
    public function getTitle(): string
    {
        return 'Rewrite "col-xs" classes in FlexForm source';
    }

    public function getDescription(): string
    {
        return 'Rewrites FlexForm data to make any "col-xs-1" through "col-xs-12" variables into just "col-" prefixed';
    }

    public function executeUpdate(): bool
    {
        $connection = $this->createConnection('tt_content');
        $querBuilder = $connection->createQueryBuilder();
        $result = $querBuilder->select('uid', 'pi_flexform')->from('tt_content')->where(
            $querBuilder->expr()->eq('CType', $querBuilder->createNamedParameter('gridelements_pi1')),
            $querBuilder->expr()->like(
                'pi_flexform',
                $querBuilder->createNamedParameter('%<value index="vDEF">col-xs-%')
            )
        )->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $source = str_replace(
                '<value index="vDEF">col-xs-',
                '<value index="vDEF">col-',
                $row['pi_flexform']
            );

            $connection->update('tt_content', ['pi_flexform' => $source], ['uid' => $row['uid']]);
        }

        return true;
    }

    public function updateNecessary(): bool
    {
        $connection = $this->createConnection('tt_content');
        $querBuilder = $connection->createQueryBuilder();
        $count = $querBuilder->select('*')->from('tt_content')->where(
            $querBuilder->expr()->eq('CType', $querBuilder->createNamedParameter('gridelements_pi1')),
            $querBuilder->expr()->like(
                'pi_flexform',
                $querBuilder->createNamedParameter('%<value index="vDEF">col-xs-%')
            )
        )->executeQuery()->rowCount();
        return $count > 0;
    }

    public function getPrerequisites(): array
    {
        return [];
    }

    private function createConnection(string $table): Connection
    {
        /** @var  $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        return $connectionPool->getConnectionForTable($table);
    }
}
