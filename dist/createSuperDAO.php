<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createSuperDAO {
	private $className = 'super';
	private $obj;

	function __construct (Config $obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/model')) mkdir('../src/model');
		if(!file_exists('../src/model/'.$this->className)) mkdir('../src/model/'.$this->className);
		
		$fp = fopen('../src/model/'.$this->className.'/'.ucfirst($this->className)."DAO.php", "a");
		
		$text = "<?php\n";
		$text .= "// dao : ".$this->className."\n\n";

		// escreve documentação
		$text .= "/*\n";
		$text .= "	Projeto: ".$obj->doc['projeto'].".\n";
		$text .= "	Project Owner: ".$obj->doc['po'].".\n";
		if(!empty($obj->doc['equipe'])) {
			foreach ($obj->doc['equipe'] as $key) {
				$text .= "	".$key['funcao'].": ".$key['nome'].".\n";
			}
		}
		$text .= "	Data de início: ".$obj->doc['datainicio'].".\n";
		$text .= "	Data Atual: ".$obj->doc['dataatual'].".\n"; 
		$text .= "*/\n\n";

		$text .= "Class ".ucfirst($this->className)."DAO {\n";
		$text .= "	//atributos\n";
		$text .= "	private \$con;\n";
		$text .= "	private \$tabela;\n";
    	$text .= "	private \$success = false;\n";
    	$text .= "	private \$data;\n";
    	$text .= "	private \$msg;\n";
    	$text .= "	private \$total = 0;\n\n";

		$text .= "	//construtor\n";
		$text .= "	public function __construct( \$tabela ) {\n";
		$text .= "		\$this->con = Conexao::getInstance()->getConexao();";
		$text .= "		\$this->tabela = \$tabela;\n";
		$text .= "	}\n\n";
		
		$escreve = fwrite($fp, $text, strlen($text));

		$this->writeGetSets ( $fp );
		$this->writeVerificaDependentes ($fp);
		$this->writeResetResponse ( $fp );
		$this->writeGetResponse ( $fp );
		
		$text = "}\n\n";

		$text .= "// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}

	function writeGetSets ( $fp ) {
		$text = "	/*Gets Sets*\n";
	    $text .= "	* @return mixed\n";
	    $text .= "	*/\n";
	    $text .= "	public function getTabela()\n";
	    $text .= "	{\n";
	    $text .= "		return \$this->tabela;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @param mixed \$tabela\n";
	    $text .= "	* @return SuperDAO\n";
	    $text .= "	*/\n";
	    $text .= "	public function setTabela(\$tabela)\n";
	    $text .= "	{\n";
	    $text .= "		\$this->tabela = \$tabela;\n";
	    $text .= "		return \$this;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @return mixed\n";
	    $text .= "	*/\n";
	    $text .= "	public function getSuccess()\n";
	    $text .= "	{\n";
	    $text .= "		return \$this->success;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @param mixed \$success\n";
	    $text .= "	* @return SuperDAO\n";
	    $text .= "	*/\n";
	    $text .= "	public function setSuccess(\$success)\n";
	    $text .= "	{\n";
	    $text .= "	    \$this->success = \$success;\n";
	    $text .= "	    return \$this;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @return mixed\n";
	    $text .= "	*/\n";
	    $text .= "	public function getData()\n";
	    $text .= "	{\n";
	    $text .= "	    return \$this->data;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @param mixed \$data\n";
	    $text .= "	* @return SuperDAO\n";
	    $text .= "	*/\n";
	    $text .= "	public function setData(\$data)\n";
	    $text .= "	{\n";
	    $text .= "	    \$this->data = \$data;\n";
	    $text .= "		return \$this;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @return mixed\n";
	    $text .= "	*/\n";
	    $text .= "	public function getMsg()\n";
	    $text .= "	{\n";
	    $text .= "	    return \$this->msg;\n";
	    $text .= "	}\n\n";

	    $text .= "	/**\n";
	    $text .= "	* @param mixed \$msg\n";
	    $text .= "	* @return SuperDAO\n";
	    $text .= "	*/\n";
	    $text .= "	public function setMsg(\$msg)\n";
	    $text .= "	{\n";
	    $text .= "		\$this->msg = \$msg;\n";
	    $text .= "		return \$this;\n";
	    $text .= "	}\n\n";

	    $text .= "	public function getTotal () {\n";
	    $text .= "		return \$this->total;\n";
	    $text .= "	}\n\n";

	    $text .= "	public function setTotal ( \$total ) {\n";
	    $text .= "		\$this->total = \$total;\n";
	    $text .= "		return \$this->total;\n";
	    $text .= "	}\n\n";

	    $escreve = fwrite($fp, $text, strlen($text));
	}

	function writeVerificaDependentes ( $fp ) {
		$text = "	//verifica dependentes\n";
		$text .= "	function verificaDependentes( \$id )\n";
	    $text .= "	{\n";
	    $text .= "	    \$count = 0;\n";
	    $text .= "	    \$nome_banco = \"\";\n";
	    $text .= "	    if (\$resultado = mysqli_query(\$this->con, \"SELECT DATABASE()\")) {\n";
	    $text .= "	        \$nome_banco = mysqli_fetch_row( \$resultado );\n";
	    $text .= "	    }\n\n";

	    $text .= "	    \$this->sql = \"SELECT TABLE_NAME, COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE\";\n";
	    $text .= "	    \$this->sql .= \" WHERE TABLE_SCHEMA = '\" . \$nome_banco[0] . \"' AND REFERENCED_TABLE_NAME = '\" . \$this->tabela . \"' GROUP BY TABLE_NAME\";\n";
	    $text .= "	    \$result = mysqli_query(\$this->con, \$this->sql);\n";
	    $text .= "	    if ( !\$result ) die ( mysqli_error( \$this->con) );\n\n";


	    $text .= "	    while ( \$row = mysqli_fetch_object( \$result ) ) {\n";

	    $text .= "	        \$this->sql = \"SELECT COUNT(*) AS total FROM \$row->TABLE_NAME WHERE \$row->COLUMN_NAME = \$id\";\n";
	    $text .= "	        \$result2 = mysqli_query( \$this->con, \$this->sql );\n";
	    $text .= "	        if ( !\$result2 ) die ( mysqli_error( \$this->con ) );\n";
	    $text .= "	        \$row2 = mysqli_fetch_object( \$result2 );\n";
	    $text .= "	        \$count = \$count + \$row2->total;\n";
	    $text .= "	    }\n\n";


	    $text .= "		return \$count;\n";
	    $text .= "	}\n\n";

	    $escreve = fwrite($fp, $text, strlen($text));
	}

	function writeResetResponse ( $fp ) {
		$text = "	//cadastrar\n";
		$text .= "	function resetResponse () {\n";
        $text .= "		\$this->success = false;\n";
        $text .= "		\$this->data = \"\";\n";
        $text .= "		\$this->msg = \"\";\n";
        $text .= "		\$this->total = 0;\n";
    	$text .= "	}\n\n";

    	$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeGetResponse ( $fp ) {
		$text = "	//cadastrar\n";
		$text .= "	function getResponse () {\n";
        $text .= "		return array( 'success' => \$this->success, 'data' => \$this->data, 'msg' => \$this->msg, 'total' => \$this->total );\n";
    	$text .= "	}\n\n";

    	$escreve = fwrite($fp, $text, strlen($text));
	}

}
?>