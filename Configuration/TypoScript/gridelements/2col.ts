tx_gridelements {
    setup {
        # mixed; This will be the layout ID. It can be a string or a integer.
        2cols {
            # string; "LLL:" can be used.
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:2cols.title
            # string; "LLL:" can be used.
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:2cols.description
            iconIdentifier = tx-bootstrapgrids-col2
            # integer; Colored frame. 0, 1 = red, 2 = green, 3 = blue
            frame = 3
            # boolean;
            topLevelLayout = 0
            # Normal grid configuration
            config {
                colCount = 2
                rowCount = 1
                rows.1 {
                    columns {
                        1 {
                            name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.leftColumn
                            colPos = 101
                        }

                        2 {
                            name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.rightColumn
                            colPos = 102
                        }
                    }
                }
            }

            # string; "FILE:" can be used
            flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_2col.xml
        }
    }
}