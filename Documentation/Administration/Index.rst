.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt
.. include:: Images.txt


Administration Manual
=====================


Installation
------------

- Install the extension. If gridelements is not installed yet, it will be installed automatically.

- Include the static templates as shown in the following screenshot.

|img-includestatic|


Import gridelements
-------------------

The gridelement records have to be imported manually. An import file (bootstrap_grids-x-x-x.t3d) is located in the extension directory Resources/Private/Import/.

Import the .t3d file into a sysfolder. Right-click on the sysfolder icon and select **Import from .t3d**

|img-import1|

**Note**: Up to (at least) Version 6.2.4 the gridelements are imported into the root page. See https://forge.typo3.org/issues/59616

Upload the file and import the gridelement records. You may move the grids to a sysfolder manually if they get imported to the root page.

|img-import2|

