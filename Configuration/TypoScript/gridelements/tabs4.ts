tx_gridelements {
    setup {
        tabs4 {
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:tabs4.title
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:tabs4.description
            iconIdentifier = tx-bootstrapgrids-tabs4
            frame = 2
            topLevelLayout = 0
            config {
                colCount = 4
                rowCount = 1
                rows.1.columns {
                    1 {
                        name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.tab1
                        colPos = 101
                    }
                    2 {
                        name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.tab2
                        colPos = 102
                    }
                    3 {
                        name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.tab3
                        colPos = 103
                    }
                    4 {
                        name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.tab4
                        colPos = 104
                    }
                }
            }
            flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_tabs4.xml
        }
    }
}
