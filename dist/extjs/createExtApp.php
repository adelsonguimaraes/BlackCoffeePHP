<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createExtApp {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app')) mkdir('../src/app');
		
		$fp = fopen('../src/app/app.js', "a");
		
		$text = "// app \n\n";

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


		$text .= "Ext.Loader.setConfig({enabled: true});\n";

		$text .= "Ext.application({\n";
		$text .= "	name: 'sgaf',\n";
		$text .= "	requires: [\n";
		$text .= "		''\n";
		$text .= "	],\n";
		$text .= "	views: [\n";
		$text .= "		''\n";
		$text .= "	],\n";
		$text .= "	controllers: [\n";

		foreach ($obj->table as $key) {
			$text .= "		'".ucfirst($key['name'])."',\n";
		}

		$text = substr($text, 0, -2) . "\n";

		$text .= "	]\n";

		$text .= "	//configs...\n\n";

		$text .= "\n// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}
}