<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

Class createConnection {
	private $obj;

	function __construct (Config $obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/util')) mkdir('../src/util');
		
		$fp = fopen("../src/util/conexao.php", "a");
		
		$text = "<?php\n";

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

		$text .= "Class Conexao {\n";
		$text .= "	private \$con;\n\n";
		
		$text .= "	protected function __construct () {\n";
		$text .= "		\$this->con = mysqli_connect(\"".$obj->host."\",\"".$obj->user."\",\"".$obj->senha."\", \"".$obj->banco."\");\n";
		$text .= "		if (mysqli_connect_error()) {\n";
		$text .= "			echo \"Falha na conexão com MySQL: \" . mysqli_connect_error();\n";
		$text .= "		}\n";
		$text .= "	}\n";
		
		$text .= "	public static function getInstance () {\n";
		$text .= "		static \$instance = null;\n";
		$text .= "		if (null === \$instance){\n";
		$text .= "			\$instance = new static();\n";
		$text .= "		}\n";
		$text .= "		return \$instance;\n";
		$text .= "	}\n";
	
		$text .= "	public function getConexao () {\n";
		$text .= "		mysqli_query(\$this->con, \"SET NAMES 'utf8'\");\n";
		$text .= "		mysqli_query(\$this->con, 'SET character_set_connection=utf8');\n";
		$text .= "		mysqli_query(\$this->con, 'SET character_set_client=utf8');\n";
		$text .= "		mysqli_query(\$this->con, 'SET character_set_result=utf8');\n";
		$text .= "		return \$this->con;\n";
		$text .= "	}\n";

		$text .= "}\n\n";
		$text .= "// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";
		$text .= "?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}
}

?>