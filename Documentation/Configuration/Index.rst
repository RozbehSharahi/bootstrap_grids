.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


Configuration
=============

The typoscript setup for the gridelements is based on gridelement uid 1 to 9. The 2-col grid is supposed to have uid 1, the row grid uid 9.

If you have created gridelements before importing the included .t3d file you will have to change the assignment of the grids.

The grid configurations are defined in lib.bootstrap_grids.2cols, lib.bootstrap_grids.3cols and so on.

**Example:** If you have created 3 gridelements before importing the package you would have to reassign the setups as shown below.

:typoscript:`tt_content.gridelements_pi1.20.10.setup.4 < lib.bootstrap_grids.2cols`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.5 < lib.bootstrap_grids.3cols`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.6 < lib.bootstrap_grids.4cols`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.7 < lib.bootstrap_grids.simpleTabs`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.8 < lib.bootstrap_grids.4tabs`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.9 < lib.bootstrap_grids.6tabs`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.10 < lib.bootstrap_grids.accordion`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.11 < lib.bootstrap_grids.slider`

:typoscript:`tt_content.gridelements_pi1.20.10.setup.12 < lib.bootstrap_grids.simpleRow`