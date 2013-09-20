<?php

include_once dirname(__FILE__) . '/../HTTPSocket.php';

abstract class DA_Api {

	/**
	 * @var HTTPSocket
	 */
	protected $sock;

	/**
	 * The default domain
	 * @var string
	 */
	protected $domain;

	/**
	 * The cache array
	 * @var array
	 */
	protected $cache = array();

	/**
	 * an instance of HTTPSocket which can be set to default, so you don't have to pass this into every DA_Api instance
	 * @var HTTPSocket
	 */
	static public $DEFAULT_SOCKET;

	/**
	 * The default domain
	 * @var string
	 */
	static public $DEFAULT_DOMAIN;

	/**
	 *
	 * @param HTTPSocket $sock
	 * @return
	 */
	public function __construct($sock = null, $domain = null){

		$this->sock = self::$DEFAULT_SOCKET;
		if ($sock instanceof HTTPSocket) $this->sock = $sock;
		if (!($this->sock instanceof HTTPSocket)){
			throw new DA_Exception('The socket is not an instance of HTTPSocket, set the first argument or the DA_Api::$DEFAULT_SOCKET variables');
		}

		$this->domain = self::$DEFAULT_DOMAIN;
		if ($domain !== null) $this->domain = $domain;

	}

	public function setDomain($domain){
		$this->domain = $domain;
	}

	public function getDomain($domain = null){
		if (!$domain) $domain = $this->domain;
		if (empty($domain)){
			include_once dirname(__FILE__) . '/Exception.php';
			throw new DA_Exception('No domain set, use the setDomain method to set one!');
		}
		return $domain;
	}

	/**
	 * Query the socket and cache the result
	 * 
	 * @author    Jelle De Loecker <jelle@codedor.be>
	 * @since     1.1.0
	 * @version   1.1.0
	 *
	 * @param     string   $command   Command to get
	 * @param     array    $options   Options to pass
	 *
	 */
	public function query($command, $options = array()) {

		$hash = $command . '-' . json_encode($options);

		if (!isset($this->cache[$hash])) {
			// Make the request
			$this->sock->query($command, $options);
			
			// Get the response
			$this->cache[$hash] = $this->sock->fetch_parsed_body();
		}

		// Return the result in the cache
		return $this->cache[$hash];
	}

}
