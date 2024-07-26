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

#[UpgradeWizard('rewriteHiddenClasses')]
class RewriteHiddenClasses implements UpgradeWizardInterface
{
    public function getTitle(): string
    {
        return 'Rewrite "hidden-*" classes in FlexForm source';
    }

    public function getDescription(): string
    {
        return 'Rewrites FlexForm data to make any "hidden-xs" through "hidden-xl" variables into new syntax';
    }

    public function executeUpdate(): bool
    {
        $connection = $this->createConnection('tt_content');
        $querBuilder = $connection->createQueryBuilder();
        $result = $querBuilder->select('uid', 'pi_flexform')->from('tt_content')->where(
            $querBuilder->expr()->eq('CType', $querBuilder->createNamedParameter('gridelements_pi1')),
            $querBuilder->expr()->like(
                'pi_flexform',
                $querBuilder->createNamedParameter('%<value index="vDEF">hidden-%')
            )
        )->executeQuery();

        while ($row = $result->fetchAssociative()) {
            $source = str_replace(
                [
                    '<value index="vDEF">hidden-xs</value>',
                    '<value index="vDEF">hidden-sm</value>',
                    '<value index="vDEF">hidden-md</value>',
                    '<value index="vDEF">hidden-lg</value>',
                    '<value index="vDEF">hidden-xl</value>',
                    '<value index="vDEF">hidden-xxl</value>',
                ],
                [
                    '<value index="vDEF">d-none</value>',
                    '<value index="vDEF">d-sm-none</value>',
                    '<value index="vDEF">d-md-none</value>',
                    '<value index="vDEF">d-lg-none</value>',
                    '<value index="vDEF">d-xl-none</value>',
                    '<value index="vDEF">d-xxl-none</value>',
                ],
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
                $querBuilder->createNamedParameter('%<value index="vDEF">hidden-%')
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
