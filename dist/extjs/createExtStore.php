<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createExtStore {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/store')) mkdir('../src/app/store');
		
		$fp = fopen('../src/app/store/'.ucfirst($obj['table']['name']).".js", "a");
		
		$text = "// store : ".$obj['table']['name']."\n\n";

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

		$text .= "Ext.define('sgaf.store.".ucfirst($obj['table']['name'])."',{\n";
		$text .= "	extend: 'Ext.data.Store',\n";
	
		$text .= "	model: 'sgaf.model.".ucfirst($obj['table']['name'])."',\n";
	
		$text .= "	pageSize: 20,\n";
	
		$text .= "	proxy: {\n";
		$text .= "		type: 'rest',\n";
		
		$text .= "		url: 'http://api.akto.com.br/src/rest/".$obj['table']['name'].".php',\n";
		
		$text .= "		reader: {\n";
		$text .= "			type: 'json',\n";
		$text .= "			root: 'data'\n";
		$text .= "		},\n";
		
		$text .= "		writer: {\n";
		$text .= "			type: 'json',\n";
		$text .= "			root: 'data',\n";
		$text .= "			encode: true\n";
		$text .= "		}\n";
		$text .= "	}\n";
		$text .= "});\n";
		
		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}
}