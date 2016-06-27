<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

Class createExtViewTabPanel {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/view')) mkdir('../src/app/view');
		if(!file_exists('../src/app/view/'.$obj['table']['name'])) mkdir('../src/app/view/'.$obj['table']['name']);
		
		$fp = fopen('../src/app/view/'.$obj['table']['name'].'/'.ucfirst($obj['table']['name'])."TabPanel.js", "a");
		
		$text = "// view : ".$obj['table']['name']."\n\n";

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


		$text .= "Ext.define('sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."TabPanel',{\n";
		$text .= "	extend: 'Ext.tab.Panel',\n";
		$text .= "	alias: 'widget.".$obj['table']['name']."tabpanel',\n";

		$text .= "	requires: ['sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."Form'],\n";
			
		$text .= "	activeTab: 0,\n";

		$text .= "	items: [{\n";
		$text .= "		xtype: '".$obj['table']['name']."form',\n";
		$text .= "		closable: false,\n";
		$text .= "	}]\n";
		$text .= "});\n";

		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}
}