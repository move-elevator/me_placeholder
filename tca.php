<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_meplaceholder_records'] = array(
	'ctrl' => $TCA['tx_meplaceholder_records']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'hidden,starttime,endtime,fe_group,placeholder,content'
	),
	'feInterface' => $TCA['tx_meplaceholder_records']['feInterface'],
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
				'default' => '0'
			)
		),
		'starttime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
				'checkbox' => '0'
			)
		),
		'endtime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'checkbox' => '0',
				'default' => '0',
				'range' => array(
					'upper' => mktime(3, 14, 7, 1, 19, 2038),
					'lower' => mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))
				)
			)
		),
		'fe_group' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
					array('LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.any_login', -2),
					array('LLL:EXT:lang/locallang_general.xml:LGL.usergroups', '--div--')
				),
				'foreign_table' => 'fe_groups'
			)
		),
		'placeholder' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_placeholder/locallang_db.xml:tx_meplaceholder_records.placeholder',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'max' => '20',
				'eval' => 'required,trim,alphanum_x,upper',
			)
		),
		'content' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:me_placeholder/locallang_db.xml:tx_meplaceholder_records.content',
			'config' => array(
				'type' => 'text',
				'renderType' => 't3editor',
				'format' => 'html',
				'rows' => 42,
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => 'hidden;;1;;1-1-1, placeholder, content')
	),
	'palettes' => array(
		'1' => array('showitem' => 'starttime, endtime, fe_group')
	)
);