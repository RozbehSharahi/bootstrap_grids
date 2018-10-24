tx_gridelements {
    setup {

        tabsSimple {
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:tabsSimple.title
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:tabsSimple.description
            iconIdentifier = tx-bootstrapgrids-simpletabs
            frame = 2
            topLevelLayout = 0
            config {
                colCount = 1
                rowCount = 1
                rows.1.columns.1 {
                    name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.tabElements
                    colPos = 101
                }
            }
            flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_tabs_simple.xml
        }
    }
}
