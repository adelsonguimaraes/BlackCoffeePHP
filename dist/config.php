<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class config implements jsonSerializable {
	
	public $host;
	public $user;
	public $senha;
	public $banco;
	public $table = array();
	public $doc = array();

	// contrutor 
	function __construct ($host=NULL, $user=NULL, $senha=NULL, $banco=NULL, $table=NULL, $doc=NULL) {
		$this->host 	= $host;
		$this->user 	= $user;
		$this->senha 	= $senha;
		$this->banco 	= $banco;
		
		if(empty($table)) $table = array();
		$this->table = $table;

		if(empty($doc['projeto'])) $doc['projeto'] = '';
		if(empty($doc['po'])) $doc['po'] = '';
		if(empty($doc['equipe'])) $doc['equipe'] = array();
		if(empty($doc['datainicio'])) $doc['datainicio'] = '';
		$doc['dataatual'] = date('d/m/Y');
		
		$this->doc 		= $doc;
	}

	// gets sets
	public function getHost () {
		return $this->host;
	}
	public function setHost ($host) {
		$this->host = $host;
		return $this;
	}
	public function getUser () {
		return $this->user;
	}
	public function setUser ($user) {
		$this->user = $user;
		return $this;
	}
	public function getSenha () {
		return $this->senha;
	}
	public function setSenha ($senha) {
		$this->senha = $senha;
		return $this;
	}
	public function getBanco () {
		return $this->banco;
	}
	public function setBanco ($banco) {
		$this->banco = $banco;
		return $this;
	}
	public function getDoc () {
		return $this->doc;
	}
	public function setDoc ($doc) {
		$this->doc = $doc;
		return $this;
	}

	public function jsonSerialize () {
		return [
			"host" 		=> $this->host,
			"user"		=> $this->user,
			"senha"		=> $this->senha,
			"banco"		=> $this->banco,
			"table"		=> $this->table,
			"doc"		=> $this->doc
		];
	}
}
?>