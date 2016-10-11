<?php
namespace Laxap\BootstrapGrids\Controller;

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

class FlexFormController {

    /**
     * @param array $config
     * @return array
     */
    public function getTwoColumnOptions($config) {
        // default for 2 columns
        $defaultOption = array('50% (col-md-6)', 'col-md-6');
        return \Laxap\BootstrapGrids\Controller\FlexFormController::getColumnOptions($config, $defaultOption);
    }

    /**
     * @param array $config
     * @return array
     */
    public function getThreeColumnOptions($config) {
        // default for 3 columns
        $defaultOption = array('33% (col-md-4)', 'col-md-4');
        return \Laxap\BootstrapGrids\Controller\FlexFormController::getColumnOptions($config, $defaultOption);
    }

    /**
     * @param array $config
     * @return array
     */
    public function getFourColumnOptions($config) {
        // default for 4 columns
        $defaultOption = array('25% (col-md-3)', 'col-md-3');
        return \Laxap\BootstrapGrids\Controller\FlexFormController::getColumnOptions($config, $defaultOption);
    }

    /**
     * @param array $config
     * @param array $defaultOption
     * @return array
     */
    public static function getColumnOptions($config, $defaultOption) {
        // mdCol, smCol, xsCol or lgCol
        $fieldName = $config['field'];
        $columnType = substr($fieldName, 0, -1);

        $optionList = array();
        switch ( $columnType ) {
            // medium device with
            case 'mdCol':
                // new grids: flexform not yet saved => add default setting as first option
                if ( isset($config['flexParentDatabaseRow']['pi_flexform']['data']) && count($config['flexParentDatabaseRow']['pi_flexform']['data']) == 0 ) {
                    $optionListStart = array($defaultOption,
                                             array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.notset', ' '));
                } else {
                    $optionListStart = array(array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.notset', ' '),
                                             $defaultOption);
                }

                switch ( $defaultOption[1] )  {
                    case 'col-md-6':
                        $optionListStart =  array_merge($optionListStart, array(array('25% (col-md-3)', 'col-md-3'),
                                                                                array('33% (col-md-4)', 'col-md-4')));
                        break;
                    case 'col-md-4':
                        $optionListStart =  array_merge($optionListStart, array(array('25% (col-md-3)', 'col-md-3'),
                                                                                array('50% (col-md-6)', 'col-md-6')));
                        break;
                    case 'col-md-3':
                        $optionListStart =  array_merge($optionListStart, array(array('33% (col-md-4)', 'col-md-4'),
                                                                                array('50% (col-md-6)', 'col-md-6')));
                        break;
                }

                $optionList = array_merge($optionListStart, array(array('66% (col-md-8)', 'col-md-8'),
                                                                  array('75% (col-md-9)', 'col-md-9'),
                                                                  array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreWidth', '--div--'),
                                                                  array('8.3% (col-md-1)', 'col-md-1'),
                                                                  array('16.7%  (col-md-2)', 'col-md-2'),
                                                                  array('41.7% (col-md-5)', 'col-md-5'),
                                                                  array('58.3% (col-md-7)', 'col-md-7'),
                                                                  array('83.3% (col-md-10)', 'col-md-10'),
                                                                  array('91.7% (col-md-11)', 'col-md-11'),
                                                                  array('100% (col-md-12)', 'col-md-12'),
                                                                  array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreOptions', '--div--'),
                                                                  array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.hidden', 'hidden-md'),
                                                                  array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.visible', 'visible-md')));
                break;

            // small device with
            case 'smCol':
                $optionList = array(array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.notset', ' '),
                                    array('25% (col-sm-3)', 'col-sm-3'),
                                    array('33% (col-sm-4)', 'col-sm-4'),
                                    array('50% (col-sm-6)', 'col-sm-6'),
                                    array('66% (col-sm-8)', 'col-sm-8'),
                                    array('75% (col-sm-9)', 'col-sm-9'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreWidth', '--div--'),
                                    array('8.3% (col-sm-1)', 'col-sm-1'),
                                    array('16.7%  (col-sm-2)', 'col-sm-2'),
                                    array('41.7% (col-sm-5)', 'col-sm-5'),
                                    array('58.3% (col-sm-7)', 'col-sm-7'),
                                    array('83.3% (col-sm-10)', 'col-sm-10'),
                                    array('91.7% (col-sm-11)', 'col-sm-11'),
                                    array('100% (col-sm-12)', 'col-sm-12'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreOptions', '--div--'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.hidden', 'hidden-sm'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.visible', 'visible-sm'));
                break;


            // extra small
            case 'xsCol':
                $optionList = array(array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.notset', ' '),
                                    array('25% (col-xs-3)', 'col-xs-3'),
                                    array('33% (col-xs-4)', 'col-xs-4'),
                                    array('50% (col-xs-6)', 'col-xs-6'),
                                    array('66% (col-xs-8)', 'col-xs-8'),
                                    array('75% (col-xs-9)', 'col-xs-9'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreWidth', '--div--'),
                                    array('8.3% (col-xs-1)', 'col-xs-1'),
                                    array('16.7%  (col-xs-2)', 'col-xs-2'),
                                    array('41.7% (col-xs-5)', 'col-xs-5'),
                                    array('58.3% (col-xs-7)', 'col-xs-7'),
                                    array('83.3% (col-xs-10)', 'col-xs-10'),
                                    array('91.7% (col-xs-11)', 'col-xs-11'),
                                    array('100% (col-xs-12)', 'col-xs-12'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreOptions', '--div--'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.hidden', 'hidden-xs'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.visible', 'visible-xs'));
                break;

            // extra large
            case 'lgCol':
                $optionList = array(array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.notset', ' '),
                                    array('25% (col-lg-3)', 'col-lg-3'),
                                    array('33% (col-lg-4)', 'col-lg-4'),
                                    array('50% (col-lg-6)', 'col-lg-6'),
                                    array('66% (col-lg-8)', 'col-lg-8'),
                                    array('75% (col-lg-9)', 'col-lg-9'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreWidth', '--div--'),
                                    array('8.3% (col-lg-1)', 'col-lg-1'),
                                    array('16.7%  (col-lg-2)', 'col-lg-2'),
                                    array('41.7% (col-lg-5)', 'col-lg-5'),
                                    array('58.3% (col-lg-7)', 'col-lg-7'),
                                    array('83.3% (col-lg-10)', 'col-lg-10'),
                                    array('91.7% (col-lg-11)', 'col-lg-11'),
                                    array('100% (col-lg-12)', 'col-lg-12'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.moreOptions', '--div--'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.hidden', 'hidden-lg'),
                                    array('LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:grid.label.visible', 'visible-lg'));
                break;
        }
        $config['items'] = array_merge($config['items'], $optionList);
        return $config;
    }


}
