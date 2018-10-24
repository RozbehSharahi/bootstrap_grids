tx_gridelements {
    setup {
        accordion {
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:accordion.title
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:accordion.description
            iconIdentifier = tx-bootstrapgrids-accordion
            frame = 2
            topLevelLayout = 0
            config {
                colCount = 1
                rowCount = 1
                rows.1.columns.1 {
                    name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.accordionElements
                    colPos = 101
                }
            }
            flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_accordion.xml
        }
    }
}