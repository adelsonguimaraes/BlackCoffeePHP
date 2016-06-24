<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

Class createExtModel {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/model')) mkdir('../src/app/model');
		
		$fp = fopen('../src/app/model/'.ucfirst($obj['table']['name']).".js", "a");
		
		$text = "// model : ".$obj['table']['name']."\n\n";

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


		$text .= "Ext.define('sgaf.model.".ucfirst($obj['table']['name'])."', {\n";
		$text .= "	extend: 'Ext.data.Model',\n";
		$text .= "	fields: [\n";

		foreach ($obj['table']['fields'] as $key) {
			$text .= "		{name: '".$key['Field']."', type:".$this->getType($key['Type'])."},\n";
		}
		$text = substr($text, 0, -2) . "\n";

		$text .= "	]\n";
		$text .= "});\n";

		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}

	function getType ($type) {
		if(strripos($type, "(")) $type = substr($type, 0, strripos($type, "("));
		
		$t = '';
		if(
			$type == "int" ||
			$type == "tinyint" ||
			$type == "bigint" ||
			$type == "smallint" ||
			$type == "bit" ||
			$type == "real"
		) {$t = "'int'";}
		else if(
			$type == "double" ||
			$type == "float" ||
			$type == "decimal" ||
			$type == "numeric"
		) {$t = "'float'";}
		else if (
			$type == "date" ||
			$type == "time" ||
			$type == "timestamp" ||
			$type == "datetime"
		) {$t = "'date', dateFormat: 'c'";}
		else {$t = "'string'";}

		return $t;
	}
}