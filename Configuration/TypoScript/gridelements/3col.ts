tx_gridelements {
    setup {

        3cols {
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:3cols.title
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:3cols.description
            iconIdentifier = tx-bootstrapgrids-col3
            frame = 3
            topLevelLayout = 0
            config {
                colCount = 3
                rowCount = 1
                rows.1 {
                    columns {
                        1 {
                            name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.leftColumn
                            colPos = 101
                        }
                        2 {
                            name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.centerColumn
                            colPos = 102
                        }
                        3 {
                            name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.rightColumn
                            colPos = 103
                        }
                    }
                }
            }
            flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_3col.xml
        }
    }
}