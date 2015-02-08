tx_gridelements {
    setup {
        # layout ID
        xSimpleRow {
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:xSimpleRow.title
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:xSimpleRow.description
            icon = EXT:bootstrap_grids/Resources/Public/Icons/gridlayout_row.gif
            frame = 1
            topLevelLayout = 0
            config {
                colCount = 1
                rowCount = 1
                rows.1.columns.1 {
					name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.columnElements
					colPos = 111
                }
            }
            #flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_...
        }
    }
}