<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');

Class createModel {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/model')) mkdir('../src/model');
		if(!file_exists('../src/model/'.$obj['table']['name'])) mkdir('../src/model/'.$obj['table']['name']);
		
		$fp = fopen('../src/model/'.$obj['table']['name'].'/'.ucfirst($obj['table']['name']).".php", "a");
		
		$text = "<?php\n";
		$text .= "// model : ".$obj['table']['name']."\n\n";

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

		$text .= "Class ". ucfirst($obj['table']['name']) ." implements JsonSerializable {\n";
		
		$escreve = fwrite($fp, $text, strlen($text));

		$this->writeAttrs ($fp, $obj);
		$this->writeConstruct ($fp, $obj);
		$this->writeGetSet ($fp, $obj);
		$this->writeJsonSerialize ($fp, $obj);

		$text = "}\n";

		$text .= "\n// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães\n";

		$text .= "?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}
	
	function writeAttrs ($fp, $obj) {
		$text = "	//atributos\n";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "	private \$obj".$key['fk']. ";\n";
			}else{
				$text .= "	private $".$key['Field']. ";\n";
			}
		}
		$text .= "\n";
		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeConstruct ($fp, $obj) {
		$text = "	//constutor\n";
		$text .= "	public function __construct\n";
		$text .= "	(\n";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "		".ucfirst($key['fk'])." \$obj".$key['fk']. " = NULL,\n";
			}else{
				$text .= "		$".$key['Field']. " = NULL,\n";
			}
		}
		$text = substr($text, 0, -2). "\n";
		
		$text .= "	)\n";
		$text .= "	{\n";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "		\$this->obj".$key['fk']."	= \$obj".$key['fk']. ";\n";
			}else{
				$text .= "		\$this->".$key['Field']."	= $".$key['Field']. ";\n";
			}
		}
		$text .= "	}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeGetSet ($fp, $obj) {
		$text = "	//Getters e Setters\n";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "	public function getObj".$key['fk']."() {\n";
				$text .= "		return \$this->obj".$key['fk'].";\n";
				$text .= "	}\n";
				$text .= "	public function setObj".$key['fk']."(\$obj".$key['fk'].") {\n";
				$text .= "		\$this->obj".$key['fk']." = \$obj".$key['fk'].";\n";
				$text .= "		return \$this;\n";
				$text .= "	}\n";
			}else{
				$text .= "	public function get".ucfirst($key['Field'])."() {\n";
				$text .= "		return \$this->".$key['Field'].";\n";
				$text .= "	}\n";
				$text .= "	public function set".ucfirst($key['Field'])."($".$key['Field'].") {\n";
				$text .= "		\$this->".$key['Field']." = $".$key['Field'].";\n";
				$text .= "		return \$this;\n";
				$text .= "	}\n";
			}
		}
		$text .= "\n";
		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeJsonSerialize ($fp, $obj) {
		$text = "	//Json Serializable\n";
		$text .= "	public function JsonSerialize () {\n";
		$text .= "		return [\n";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "			\"obj".$key['fk']."\"	=> \$this->obj".$key['fk']. ",\n";	
			}else{
				$text .= "			\"".$key['Field']."\"	=> \$this->".$key['Field']. ",\n";	
			}
		}
		$text = substr($text, 0, -2). "\n";
		$text .= "		];\n";
		$text .= "	}\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

}
?>