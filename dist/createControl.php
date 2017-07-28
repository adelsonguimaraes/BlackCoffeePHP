<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createControl {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/control')) mkdir('../src/control');
		
		$fp = fopen('../src/control/'.ucfirst($obj['table']['name'])."Control.php", "a");
		
		$text = "<?php\n";
		$text .= "// control : ".$obj['table']['name']."\n\n";

		// escreve documentação
		$text .= "/*\n";
		$text .= "	Projeto: ".$obj['doc']['projeto'].".\n";
		$text .= "	Project Owner: ".$obj['doc']['po'].".\n";

		if(!empty($obj['doc']['equipe'])) {
			foreach ($obj['doc']['equipe'] as $key) {
				$text .= "	".$key['funcao'].": ".$key['nome'].".\n";
			}
		}
		
		$text .= "	Data de início: ".$obj['doc']['datainicio'].".\n";
		$text .= "	Data Atual: ".$obj['doc']['dataatual'].".\n"; 
		$text .= "*/\n\n";

		$text .= "Class ".ucfirst($obj['table']['name'])."Control {\n";
		$text .= "	//atributos\n";
		$text .= "	protected \$con;\n";
		$text .= "	protected \$obj;\n";
		$text .= "	protected \$objDAO;\n\n";

		$text .= "	//construtor\n";
		$text .= "	public function __construct(".ucfirst($obj['table']['name'])." \$obj=NULL) {\n";
		$text .= "		\$this->con = Conexao::getInstance()->getConexao();\n";
		$text .= "		\$this->objDAO = new ".ucfirst($obj['table']['name'])."DAO(\$this->con);\n";
		$text .= "		\$this->obj = \$obj;\n";
		$text .= "	}\n\n";

		$text .= "	//metodos\n";
		$text .= "	function cadastrar () {\n";
		$text .= "		return \$this->objDAO->cadastrar(\$this->obj);\n";
		$text .= "	}\n";

		$text .= "	function buscarPorId () {\n";
		$text .= "		return \$this->objDAO->buscarPorId(\$this->obj);\n";
		$text .= "	}\n";
		
		$text .= "	function listar () {\n";
		$text .= "		return \$this->objDAO->listar();\n";
		$text .= "	}\n";

		$text .= "	function atualizar () {\n";
		$text .= "		return \$this->objDAO->atualizar(\$this->obj);\n";
		$text .= "	}\n";

		$text .= "	function deletar () {\n";
		$text .= "		return \$this->objDAO->deletar(\$this->obj);\n";
		$text .= "	}\n";

		$text .= "	function listarPaginado (\$start, \$limit) {\n";
		$text .= "	return \$this->objDAO->listarPaginado(\$start, \$limit);\n";
		$text .= "	}\n";
		
		$text .= "	function qtdTotal () {\n";
		$text .= "		return \$this->objDAO->qtdTotal();\n";
		$text .= "	}\n";

		$text .= "}\n";
		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";
		$text .= "?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}
}
?>