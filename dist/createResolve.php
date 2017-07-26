<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createResolve {
	private $className = 'resolve';
	private $obj;

	function __construct (Config $obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/util')) mkdir('../src/util');
		
		$fp = fopen('../src/util/'.ucfirst($this->className)."MysqlError.php", "a");
		
		$text = "<?php\n";
		$text .= "// util : ".$this->className."\n\n";

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

		$escreve = fwrite($fp, $text, strlen($text));

		$this->writeResolve ( $fp );
		
		$text = "// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}

	function writeResolve ( $fp ) {
		$text = "	/*resolve mysql erro*/\n";
		$text .= "	function resolve ( \$cod, \$msgerror, \$class, \$metodo ) {\n";
		$text .= "		\$msg = \"<strong>Atenção!</strong> Ocorreu um erro, por favor contate o suporte.\";\n\n";

		$text .= "		switch ( \$cod ) {\n";

		$text .= "			case '0001':\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong> Impossível remover este dado, existem \".\$msgerror.\" registro(s) depente(s).\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				// \$msg .= \"<br><strong>[Log]:</strong>: \" . \$msgerror;\n";
		$text .= "				break;\n\n";

		$text .= "			case '1054':\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong> Tentativa manipulação em um campo inexistente.\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				\$msg .= \"<br><strong>[Log]:</strong>: \" . \$msgerror;\n";
		$text .= "				break;\n\n";

		$text .= "			case '1146':\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong> Tentativa acesso a uma tabela inexistente.\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				\$msg .= \"<br><strong>[Log]:</strong> \" . \$msgerror;\n";
		$text .= "				break;\n\n";

		$text .= "			case '1452':\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong> Tentativa de cadastro de uma chave estrangeira inexistente.\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				\$msg .= \"<br><strong>[Log]:</strong> \" . \$msgerror;\n";
		$text .= "				break;\n\n";

		$text .= "			case '1451':\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong> Tentativa de exclusão de dados que contém dependentes.\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				\$msg .= \"<br><strong>[Log]:</strong> \" . \$msgerror;\n";
		$text .= "				break;\n\n";

		$text .= "			case '1064':\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong> Erro de Sintax no código SQL.\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				\$msg .= \"<br><strong>[Log]:</strong> \" . \$msgerror;\n";
		$text .= "				break;\n\n";

		$text .= "			default:\n";
		$text .= "				\$msg .= \"<br><strong>[Código]:</strong> \". \$cod;\n";
		$text .= "				\$msg .= \"<br><strong>[Ocorrência]:</strong>: Indefinida.\";\n";
		$text .= "				\$msg .= \"<br><strong>[Classe]:</strong> \" . \$class;\n";
		$text .= "				\$msg .= \"<br><strong>[Metodo]:</strong> \" . \$metodo;\n";
		$text .= "				\$msg .= \"<br><strong>[Log]:</strong> \" . \$msgerror;\n";
		$text .= "				break;\n\n";
		$text .= "		}\n";

		$text .= "		return \$msg;\n";
		$text .= "	}\n\n";

	    $escreve = fwrite($fp, $text, strlen($text));
	}

}
?>