# TYPO3 Extension "me_placeholder"

Find marker in source code and replace it with editable content. To edit content is a RTE available. For placeholder you can set a storage page id. Furthermore you can individual pages exclude from replacement.

## Configuration

1. Disable placeholder substitution
	* config.disable_meplaceholder = 1 # exclude page with page id 1 from replacement

2. Set storage pid
	* plugin.tx_meplaceholder.storagePageId = 123 # used placeholder only from page 123

## Change Log

2015-03-11  Jan Maennig  <jma@move-elevator.de>

	* Refactoring after reviews
	
2015-02-03  Jan Maennig  <jma@move-elevator.de>

	* Add storage pid for placeholder records

2014-10-15  Sascha Seyfert  <sef@move-elevator.de>

	* Add possibility to disable placeholder substitution

2012-10-09  Jan Maennig  <jma@move-elevator.de>

	* Initial code generated with kickstarter