<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createExtViewGrid {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/view')) mkdir('../src/app/view');
		if(!file_exists('../src/app/view/'.$obj['table']['name'])) mkdir('../src/app/view/'.$obj['table']['name']);
		
		$fp = fopen('../src/app/view/'.$obj['table']['name'].'/'.ucfirst($obj['table']['name'])."Grid.js", "a");
		
		$text = "// view Grid : ".$obj['table']['name']."\n\n";

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


		$text .= "Ext.define('sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."Grid',{\n";
		$text .= "	extend: 	'Ext.grid.Panel',\n";
		$text .= "	alias: 		'widget.".$obj['table']['name']."grid',\n";
		$text .= "	title: 		'Cadastro de ".ucfirst($obj['table']['name'])."',\n";
		$text .= "	iconCls: 	'icon-grid',\n";
		$text .= "	store: 		'".ucfirst($obj['table']['name'])."',\n";

		//columns
		$text .= "	columns: [\n";

		foreach ($obj['table']['fields'] as $key) {
			$text .= $this->getType($key);
		}

		$text = substr($text, 0, -2) . "\n";

		$text .= "	],\n";

		$text .= "	dockedItems: [\n";
		$text .= "		{\n";
		$text .= "			xtype: 'toolbar',\n";
		$text .= "			dock: 	'top',\n";
		$text .= "			items: [\n";
		$text .= "				{\n";
		$text .= "					xtype: 'button',\n";
		$text .= "					text: 'Novo',\n";
		$text .= "					itemId: 'add".ucfirst($obj['table']['name'])."',\n";
		$text .= "					iconCls: 'icon-add'\n";
		$text .= "				},\n";
		$text .= "				{\n";
		$text .= "					xtype: 'button',\n";
		$text .= "					text: 'Excluir',\n";
		$text .= "					itemId: 'delete".ucfirst($obj['table']['name'])."',\n";
		$text .= "					iconCls: 'icon-delete'\n";
		$text .= "				},\n";
		$text .= "				{\n";
		$text .= "					xtype: 'button',\n";
		$text .= "					iconCls: 'right',\n";
		$text .= "					text: 'À Direita',\n";
		$text .= "					menu: {\n";
		$text .= "						xtype: 'menu',\n";
		$text .= "						itemId: 'posform".$obj['table']['name']."',\n";
		$text .= "						// width: 120,\n";
		$text .= "						items: [\n";
		$text .= "							{\n";
		$text .= "								xtype: 'menuitem',\n";
		$text .= "								itemId: 'hide',\n";
		$text .= "								iconCls: 'hide',\n";
		$text .= "								text: 'Formulário Oculto'\n";
		$text .= "							},\n";
		$text .= "							{\n";
		$text .= "								xtype: 'menuitem',\n";
		$text .= "								itemId: 'bottom',\n";
		$text .= "								iconCls: 'bottom',\n";
		$text .= "								text: 'Formulário  Abaixo'\n";
		$text .= "							},\n";
		$text .= "							{\n";
		$text .= "								xtype: 'menuitem',\n";
		$text .= "								itemId: 'right',\n";
		$text .= "								iconCls: 'right',\n";
		$text .= "								text: 'Formulário À Direita'\n";
		$text .= "							}\n";
		$text .= "						]\n";
		$text .= "					}\n";
		$text .= "				}\n";
		$text .= "			]\n";
		$text .= "		},\n";
		$text .= "		{\n";
		$text .= "			xtype: 	'pagingtoolbar',\n";
		$text .= "			store: 	'".ucfirst($obj['table']['name'])."',\n";
		$text .= "			dock:	'bottom',\n";
		$text .= "			displayInfo: true,\n";
		$text .= "			empyMsg: 'Nenhum dado encontrado'\n";
		$text .= "		}\n";
		$text .= "	]\n";
		$text .= "});\n";
	
		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}

	function getType ($obj) {
		$type = $obj['Type'];

		if(strripos($type, "(")) $type = substr($type, 0, strripos($type, "("));
		
		$t = '';

		if(!empty($obj['fk'])) {
			$t .= "		{\n";
			$t .= "			text: '".ucfirst($obj['fk'])."',\n";
			$t .= "			dataIndex: '".$obj['Field']."',\n";
			$t .= "			renderer: function (value, metaData, record) {\n";
			$t .= "				var Store = Ext.getStore('".ucfirst($obj['fk'])."');\n";
			$t .= "				var obj = Store.findRecord('id', value);\n";
			$t .= "				return obj != null ? obj.get('id') : value;\n";
			$t .= "			}\n";
			$t .= "		},\n";

			return $t;
		}

		if (
			$type == "date" ||
			$type == "time" ||
			$type == "timestamp" ||
			$type == "datetime"
		) {
			$t .= "		{text: '".ucfirst($obj['Field'])."',	dataIndex: '".$obj['Field']."',	renderer : Ext.util.Format.dateRenderer('d/m/Y')},\n";
		}
		else {
			$t .= "		{text: '".ucfirst($obj['Field'])."',	dataIndex: '".$obj['Field']."'},\n";
		}

		return $t;
	}
}