<?php

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class tx_meplaceholder_contentPostProcHook
 */
class tx_meplaceholder_contentPostProcHook {
	/**
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 * @var array
	 */
	protected $settings = array();

	/**
	 * @var \t3lib_DB
	 */
	protected $t3Database;

	/**
	 * Initialize tx_meplaceholder_contentPostProcHook
	 */
	public function __construct() {
		$this->t3Database = $GLOBALS['TYPO3_DB'];
		$this->contentObject = GeneralUtility::makeInstance('tslib_cObj');
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
	public function contentPostProc_output($params, &$feObject) {
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