<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::allowTableOnStandardPages('tx_meplaceholder_records');

$TCA['tx_meplaceholder_records'] = array(
	'ctrl' => array(
		'title'     => 'LLL:EXT:me_placeholder/locallang_db.xml:tx_meplaceholder_records',		
		'label'     => 'placeholder',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',	
		'delete' => 'deleted',	
		'enablecolumns' => array(		
			'disabled' => 'hidden',	
			'starttime' => 'starttime',	
			'endtime' => 'endtime',	
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_tx_meplaceholder_records.gif',
	),
);
?>