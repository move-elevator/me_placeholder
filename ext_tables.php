<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_meplaceholder_records');

$TCA['tx_meplaceholder_records'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:me_placeholder/Resources/Private/Language/locallang_db.xlf:tx_meplaceholder_records',
        'label' => 'placeholder',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
            'fe_group' => 'fe_group',
        ),
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) .
            'Configuration/TCA/tx_meplaceholder_records.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) .
            'Resources/Public/Icons/tx_meplaceholder_records.gif',
    ),
);
