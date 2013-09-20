<?php
require_once dirname(__FILE__) . '/Api.php';

/**
 * DirectAdmin Site information class
 *
 * @author    Jelle De Loecker <jelle@codedor.be>
 * @since     1.1.0
 * @version   1.1.0
 */
class DA_Site extends DA_Api {

	/**
	 * Fetch user usage info
	 *
	 * @author    Jelle De Loecker <jelle@codedor.be>
	 * @since     1.1.0
	 * @version   1.1.0
	 *
	 * @param     string   $domain
	 *
	 * @return    array
	 */
	public function fetchUsage($domain = null){
		$domain = $this->getDomain($domain);
		$row = $this->query('/CMD_API_SHOW_USER_USAGE');
		return $row;
	}

	/**
	 * Fetch user configuration
	 *
	 * @author    Jelle De Loecker <jelle@codedor.be>
	 * @since     1.1.0
	 * @version   1.1.0
	 *
	 * @param     string   $domain
	 *
	 * @return    array
	 */
	public function fetchConfig($domain = null){
		$domain = $this->getDomain($domain);
		$row = $this->query('/CMD_API_SHOW_USER_CONFIG');
		return $row;
	}

	/**
	 * Get domain bandwith usage in megabytes
	 *
	 * @author    Jelle De Loecker <jelle@codedor.be>
	 * @since     1.1.0
	 * @version   1.1.0
	 *
	 * @return    array
	 */
	public function bandwidth() {
		$usage = $this->fetchUsage();
		$config = $this->fetchConfig();

		$result = array(
			'used'       => $usage['bandwidth'],
			'allowed'    => $config['bandwidth'],
			'additional' => $config['additional_bandwidth'],
			'total'      => 0,
		);

		$result['total'] = $result['allowed'] + $result['additional'];

		return $result;
	}

	/**
	 * Get domain diskspace usage in megabytes
	 *
	 * @author    Jelle De Loecker <jelle@codedor.be>
	 * @since     1.1.0
	 * @version   1.1.0
	 *
	 * @return    array
	 */
	public function diskspace() {
		$usage = $this->fetchUsage();
		$config = $this->fetchConfig();

		$result = array(
			'used'    => $usage['quota'],
			'allowed' => $config['quota'],
		);

		return $result;
	}

}