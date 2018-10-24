tx_gridelements {
    setup {
        slider {
            title = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:slider.title
            description = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:slider.description
            iconIdentifier = tx-bootstrapgrids-slider
            frame = 1
            topLevelLayout = 0
            config {
                colCount = 1
                rowCount = 1
                rows.1.columns.1 {
                    name = LLL:EXT:bootstrap_grids/Resources/Private/Language/locallang_db.xlf:celayout.sliderElements
                    colPos = 101
                }
            }
            flexformDS = FILE:EXT:bootstrap_grids/Configuration/FlexForm/flexform_slider.xml
        }
    }
}