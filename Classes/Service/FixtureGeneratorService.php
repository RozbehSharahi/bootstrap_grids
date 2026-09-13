<?php

declare(strict_types=1);

namespace Laxap\BootstrapGrids\Service;

/**
 * Generic building blocks for generating dev fixture data (see
 * SetupDatabaseCommand).
 */
class FixtureGeneratorService
{
    /**
     * Builds a minimal, valid T3FlexForms XML value for a tt_content.pi_flexform
     * column. Only needs to contain the fields that actually matter for
     * rendering; TYPO3 treats any field missing from the XML as empty.
     *
     * @param array<string, array<string, string>> $sheetFields sheet index => [field index => value]
     */
    public function buildFlexForm(array $sheetFields): string
    {
        $sheetsXml = '';
        foreach ($sheetFields as $sheet => $fields) {
            $fieldsXml = '';
            foreach ($fields as $field => $value) {
                $fieldsXml .= sprintf(
                    '<field index="%s"><value index="vDEF">%s</value></field>',
                    htmlspecialchars($field, ENT_QUOTES),
                    htmlspecialchars($value, ENT_QUOTES)
                );
            }
            $sheetsXml .= sprintf(
                '<sheet index="%s"><language index="lDEF">%s</language></sheet>',
                htmlspecialchars($sheet, ENT_QUOTES),
                $fieldsXml
            );
        }

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>'
            . '<T3FlexForms><data>' . $sheetsXml . '</data></T3FlexForms>';
    }
}
