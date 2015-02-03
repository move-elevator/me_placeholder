<?php

class tx_meplaceholder_contentPostProcHook {

	/**
	 * @var \tslib_cObj
	 */
	protected $localContentObject;

	/**
	 * @return void
	 */
	public function __construct() {
		$this->localContentObject = t3lib_div::makeInstance('tslib_cObj');
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

		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_meplaceholder_records', '1=1 ' . $this->localContentObject->enableFields('tx_meplaceholder_records'));

		foreach ($rows as $row) {
			$pageObject->content = str_replace('###' . $row['placeholder'] . '###', $this->localContentObject->stdWrap($row['content']), $pageObject->content);
		}

		$pageObject->content = preg_replace('/#{3}[A-Za-z0-9]{1,}#{3}/i', '', $pageObject->content);

	}
}

?>
