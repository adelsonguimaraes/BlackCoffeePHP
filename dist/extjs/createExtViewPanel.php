<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

Class createExtViewPanel {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/view')) mkdir('../src/app/view');
		if(!file_exists('../src/app/view/'.$obj['table']['name'])) mkdir('../src/app/view/'.$obj['table']['name']);
		
		$fp = fopen('../src/app/view/'.$obj['table']['name'].'/'.ucfirst($obj['table']['name'])."Panel.js", "a");
		
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


		$text .= "Ext.define('sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."Panel',{\n";
		$text .= "	extend: 'Ext.panel.Panel',\n";
		$text .= "	alias: 'widget.".$obj['table']['name']."panel',\n";

		$text .= "	requires: ['sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."TabPanel','sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."Grid'],\n";
			
		$text .= "	width: 600,\n";
		$text .= "	height: 400,\n";
		$text .= "  layout: {\n";
		$text .= "		type: 'border',\n";
		$text .= "	    align: 'stretch',\n";    
		$text .= "	    padding: 0\n";
		$text .= "	},\n";
		$text .= "	items: [{\n";
		$text .= "		xtype: '".$obj['table']['name']."grid',\n";
		$text .= "	    region: 'center',\n";
		    
		$text .= "	    layout: 'fit'\n";                        
		$text .= "	},\n";
		$text .= "	{\n";
		$text .= "		xtype: 'panel',\n";
		$text .= "		region: 'south',\n";
		$text .= "		itemId: 'sul',\n";
		$text .= "		collapsible: true,\n";
		$text .= "		collapsed: true,\n";
		$text .= "		title: 'Formulários',\n";
		$text .= "		iconCls: 'menu_icon_".$obj['table']['name']."',\n";
		$text .= "		split: true,\n";
		$text .= "		flex: 1,\n";
		$text .= "		autoScroll: true,\n";
		$text .= "		hidden: true\n";
			       
		$text .= "	},\n";
		$text .= "	{\n";
		$text .= "		xtype: 'panel',\n";
		$text .= "	    itemId: 'oeste',\n";
		$text .= "		region: 'east',\n";
		$text .= "		collapsible: true,\n";
		$text .= "		collapsed: true,\n";
		$text .= "		title: 'Formulários',\n";
		$text .= "		iconCls: 'menu_icon_".$obj['table']['name']."',\n";
		$text .= "		split: true,\n";
		$text .= "		flex: 1,\n";
		$text .= "		autoScroll: true,\n";
		$text .= "		items: [{ xtype:'".$obj['table']['name']."tabpanel'}]\n";
		$text .= "	}]\n";
		$text .= "});\n";

		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}
}