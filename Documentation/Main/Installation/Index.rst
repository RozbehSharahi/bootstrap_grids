.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt
.. include:: Images.txt


Installation
============

1. Install the extension bootstrap_grids. If ext:gridelements is not installed, it will be installed automatically.

2. Include the static templates as shown in the screenshot. Keep in mind that the order of templates is important.

|img-includestatic|


TYPO3 7.6.x and fluid_styled_content
------------------------------------

The gridelement static templates have to be included after the fluid_styled_content static templates.

|img-includestatic76|

**Attention:** The **header layout** of content elements used in accordion and simple tab elements has to be set to **hidden** to not show up again in the accordion/tab panel.

