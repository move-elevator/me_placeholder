<?php

class tx_meplaceholder_contentPostProcHook {
	/**
	 * @var \tslib_cObj
	 */
	protected $localContentObject;

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
		$this->localContentObject = t3lib_div::makeInstance('tslib_cObj');
		if (
			isset($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_meplaceholder.'])
			&& is_array($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_meplaceholder.'])
		) {
			$this->settings = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_meplaceholder.'];
		}
	}

	/**
	 * @param array $params
	 * @param tslib_fe $feObject
	 * @return void
	 */
	public function contentPostProc_output(&$params, $feObject) {

		if (isset($feObject->config['config']['disable_meplaceholder']) && $feObject->config['config']['disable_meplaceholder'] === '1') {
			return;
		}
		$pageObject = &$params['pObj'];

		$rows = $this->getPlaceholderFromDatabase();

		foreach ($rows as $row) {
			$pageObject->content = str_replace('###' . $row['placeholder'] . '###', $this->localContentObject->stdWrap($row['content']), $pageObject->content);
		}

		$pageObject->content = preg_replace('/#{3}[A-Za-z0-9]{1,}#{3}/i', '', $pageObject->content);

	}

	/**
	 * @return array|NULL
	 */
	protected function getPlaceholderFromDatabase() {
		$whereClause = '1=1 ' . $this->localContentObject->enableFields('tx_meplaceholder_records');
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