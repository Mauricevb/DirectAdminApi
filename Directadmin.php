<?php
require_once 'Source/HTTPSocket.php';
require_once 'Source/DA/Emails.php';
require_once 'Source/DA/Site.php';

/**
 * The Directadmin wrapper class
 *
 * @author    Jelle De Loecker <jelle@codedor.be>
 * @since     1.1.0
 * @version   1.1.0
 */
class Directadmin {

	/**
	 * Construct the class
	 *
	 * @author    Jelle De Loecker <jelle@codedor.be>
	 * @since     1.1.0
	 * @version   1.1.0
	 *
	 * @param     string   $host      The hostname of the DA installation
	 * @param     integer  $port      The port to use (probably 2222)
	 * @param     string   $login     The DA login
	 * @param     string   $password  The DA password
	 * @param     string   $domain    The domain to get information for
	 */
	public function __construct($host, $port, $login, $password, $domain) {

		$this->socket = new HTTPSocket();
		$this->socket->connect($host, $port);
		$this->socket->set_login($login, $password);

		$this->email = new DA_Emails($this->socket, $domain);
		$this->site  = new DA_Site($this->socket, $domain);
	}
}