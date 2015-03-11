<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_meplaceholder_records=1
');

$TYPO3_CONF_VARS['EXTCONF']['cms']['db_layout']['addTables']['tx_meplaceholder_records'][0] = array (
    'fList' => 'placeholder,content',
    'icon' => TRUE,
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output']['tx_meplaceholder'] = 'EXT:me_placeholder/class.tx_meplaceholder_contentPostProcHook.php:&tx_meplaceholder_contentPostProcHook->contentPostProc_output';