# TYPO3 Extension "me_placeholder"

Find marker in source code and replace it with editable content. To edit content is a RTE available. For placeholder you can set a storage page id. Furthermore you can individual pages exclude from replacement.

## Installation

1. just upload and activate the extension

## Configuration

## How to use

1. the best way to manage palceholders is to create a sysfolder and put all your records into it
2. add new placeholder record
3. put placeholder for example in page content or plugin template

1. Disable placeholder substitution
	* config.disable_meplaceholder = 1 # exclude page with page id 1 from replacement

2. Set storage pid
	* plugin.tx_meplaceholder.storagePageId = 123 # used placeholder only from page 123

## Contact

* typo3@move-elevator.de
* Company: http://www.move-elevator.de
* Issue-Tracker - https://github.com/move-elevator/me_placeholder

## Change Log

2016-08-18 Sascha Seyfert <sef@move-elevator.de>

	* improve sql query and table scheme
	* change codestyle


2016-01-26 Jan Maennig <jma@move-elevator.de>

	* add TYPO3 7.6 compatibility
	* update RTE configuration in TCA

2015-05-08 Jan Maennig <jma@move-elevator.de>

	* fix composer.json

2015-03-19 Jan Maennig <jma@move-elevator.de>

	* Update manual

2015-03-11 Jan Maennig <jma@move-elevator.de>

	* Refactoring after reviews

2015-02-03 Jan Maennig <jma@move-elevator.de>

	* Add storage pid for placeholder records

2014-10-15 Sascha Seyfert <sef@move-elevator.de>

	* Add possibility to disable placeholder substitution

2012-10-09  Jan Maennig  <jma@move-elevator.de>

	* Initial code generated with kickstarter
