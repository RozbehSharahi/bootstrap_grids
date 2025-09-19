<?php

namespace Laxap\BootstrapGrids\Backend;

class ColumnOptionsProvider
{

    public function getTwoColumnOptions(array $config): array
    {
        return $this->getColumnOptions($config);
    }

    public function getThreeColumnOptions(array $config): array
    {
        return $this->getColumnOptions($config);
    }

    public function getFourColumnOptions(array $config): array
    {
        return $this->getColumnOptions($config);
    }

    public function getColumnOptions(array $config): array
    {
        $fieldName = $config['field'];
        $columnType = substr((string) $fieldName, 0, -1);

        $optionList = [];
        switch ($columnType) {

            case 'xsCol':
                $optionList = [
                    [$this->getLangKey('grid.label.autoLayout'), 'col'],
                    ['25%', 'col-3'],
                    ['33%', 'col-4'],
                    ['50%', 'col-6'],
                    ['66%', 'col-8'],
                    ['75%', 'col-9'],
                    [$this->getLangKey('grid.label.moreWidth'), '--div--'],
                    ['8.3%', 'col-1'],
                    ['16.7%', 'col-2'],
                    ['41.7%', 'col-5'],
                    ['58.3%', 'col-7'],
                    ['83.3%', 'col-10'],
                    ['91.7%', 'col-11'],
                    ['100%', 'col-12'],
                    [$this->getLangKey('grid.label.moreOptions'), '--div--'],
                    [$this->getLangKey('grid.label.notset'), '---'],
                    [$this->getLangKey('grid.label.variableWidth'), 'col-auto']
                ];
                break;

            case 'smCol':
                $optionList = [
                    [$this->getLangKey('grid.label.notset'), ' '],
                    ['25%', 'col-sm-3'],
                    ['33%', 'col-sm-4'],
                    ['50%', 'col-sm-6'],
                    ['66%', 'col-sm-8'],
                    ['75%', 'col-sm-9'],
                    [$this->getLangKey('grid.label.moreWidth'), '--div--'],
                    ['8.3%', 'col-sm-1'],
                    ['16.7%', 'col-sm-2'],
                    ['41.7%', 'col-sm-5'],
                    ['58.3%', 'col-sm-7'],
                    ['83.3%', 'col-sm-10'],
                    ['91.7%', 'col-sm-11'],
                    ['100%', 'col-sm-12'],
                    [$this->getLangKey('grid.label.moreOptions'), '--div--'],
                    [$this->getLangKey('grid.label.variableWidth'), 'col-sm-auto'],
                    [$this->getLangKey('grid.label.hidden'), 'd-sm-none']
                ];
                break;

            case 'mdCol':
                $optionList = [
                    [$this->getLangKey('grid.label.notset'), ' '],
                    ['25%', 'col-md-3'],
                    ['33%', 'col-md-4'],
                    ['50%', 'col-md-6'],
                    ['66%', 'col-md-8'],
                    ['75%', 'col-md-9'],
                    [$this->getLangKey('grid.label.moreWidth'), '--div--'],
                    ['8.3%', 'col-md-1'],
                    ['16.7%', 'col-md-2'],
                    ['41.7%', 'col-md-5'],
                    ['58.3%', 'col-md-7'],
                    ['83.3%', 'col-md-10'],
                    ['91.7%', 'col-md-11'],
                    ['100%', 'col-md-12'],
                    [$this->getLangKey('grid.label.moreOptions'), '--div--'],
                    [$this->getLangKey('grid.label.variableWidth'), 'col-md-auto'],
                    [$this->getLangKey('grid.label.hidden'), 'd-md-none']
                ];
                break;

            case 'lgCol':
                $optionList = [
                    [$this->getLangKey('grid.label.notset'), ' '],
                    ['25%', 'col-lg-3'],
                    ['33%', 'col-lg-4'],
                    ['50%', 'col-lg-6'],
                    ['66%', 'col-lg-8'],
                    ['75%', 'col-lg-9'],
                    [$this->getLangKey('grid.label.moreWidth'), '--div--'],
                    ['8.3%', 'col-lg-1'],
                    ['16.7%', 'col-lg-2'],
                    ['41.7%', 'col-lg-5'],
                    ['58.3%', 'col-lg-7'],
                    ['83.3%', 'col-lg-10'],
                    ['91.7%', 'col-lg-11'],
                    ['100%', 'col-lg-12'],
                    [$this->getLangKey('grid.label.moreOptions'), '--div--'],
                    [$this->getLangKey('grid.label.variableWidth'), 'col-lg-auto'],
                    [$this->getLangKey('grid.label.hidden'), 'd-lg-none']
                ];
                break;

            case 'xlCol':
                $optionList = [
                    [$this->getLangKey('grid.label.notset'), ' '],
                    ['25% (col-xl-3)', 'col-xl-3'],
                    ['33% (col-xl-4)', 'col-xl-4'],
                    ['50% (col-xl-6)', 'col-xl-6'],
                    ['66% (col-xl-8)', 'col-xl-8'],
                    ['75% (col-xl-9)', 'col-xl-9'],
                    [$this->getLangKey('grid.label.moreWidth'), '--div--'],
                    ['8.3% (col-xl-1)', 'col-xl-1'],
                    ['16.7%  (col-xl-2)', 'col-xl-2'],
                    ['41.7% (col-xl-5)', 'col-xl-5'],
                    ['58.3% (col-xl-7)', 'col-xl-7'],
                    ['83.3% (col-xl-10)', 'col-xl-10'],
                    ['91.7% (col-xl-11)', 'col-xl-11'],
                    ['100% (col-xl-12)', 'col-xl-12'],
                    [$this->getLangKey('grid.label.moreOptions'), '--div--'],
                    [$this->getLangKey('grid.label.variableWidth'), 'col-xl-auto'],
                    [$this->getLangKey('grid.label.hidden'), 'd-xl-none']
                ];
                break;
        }
        $config['items'] = array_merge($config['items'], $optionList);
        return $config;
    }

    private function getLangKey(string $key): string
    {
        return "LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:{$key}";
    }
}
