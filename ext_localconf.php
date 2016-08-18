<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
	options.saveDocNew.tx_meplaceholder_records=1
');

$GLOBALS['TYPO3_CONF_VARS']['cms']['db_layout']['addTables']['tx_meplaceholder_records'][0] = array(
    'fList' => 'placeholder,content',
    'icon' => true,
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output']['tx_meplaceholder'] =
    'MoveElevator\MePlaceholder\Hooks\ContentPostProcHook->processedOutput';
