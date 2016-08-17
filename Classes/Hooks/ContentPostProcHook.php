<?php

namespace MoveElevator\MePlaceholder\Hooks;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ContentPostProcHook
 *
 * @package MoveElevator\MePlaceholder\Hooks
 */
class ContentPostProcHook {
	/**
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 * @var array
	 */
	protected $settings = array();

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $t3Database;

	/**
	 * Initialize ContentPostProcHook
	 */
	public function __construct() {
		$this->t3Database = $GLOBALS['TYPO3_DB'];

		/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
		$objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->contentObject = $objectManager->get('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

		if (
			isset($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_meplaceholder.'])
			&& is_array($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_meplaceholder.'])
		) {
			$this->settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_meplaceholder.'];
		}
	}

	/**
	 * @param array $params
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $feObject
	 * @return void
	 */
	public function processedOutput($params, &$feObject) {
		if (
			isset($feObject->config['config']['disable_meplaceholder'])
			&& $feObject->config['config']['disable_meplaceholder'] === '1'
		) {
			return;
		}

		$rows = $this->getPlaceholderFromDatabase();

		foreach ($rows as $row) {
			$feObject->content = str_replace(
				'###' . $row['placeholder'] . '###',
				$this->contentObject->stdWrap($row['content']),
				$feObject->content
			);
		}
		$feObject->content = preg_replace('/#{3}[A-Za-z0-9_]{1,}#{3}/i', '', $feObject->content);
	}

	/**
	 * @return array|NULL
	 */
	protected function getPlaceholderFromDatabase() {
		$whereClause = '1=1 ' . $this->contentObject->enableFields('tx_meplaceholder_records');
		if (
			isset($this->settings['storagePageId'])
			&& intval($this->settings['storagePageId']) > 0
		) {
			$whereClause .= ' AND pid = ' . intval($this->settings['storagePageId']);
		}
		$placeholder = $this->t3Database->exec_SELECTgetRows(
			'*',
			'tx_meplaceholder_records',
			$whereClause
		);

		return $placeholder;
	}
}
