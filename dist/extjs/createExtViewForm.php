<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createExtViewForm {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/view')) mkdir('../src/app/view');
		if(!file_exists('../src/app/view/'.$obj['table']['name'])) mkdir('../src/app/view/'.$obj['table']['name']);
		
		$fp = fopen('../src/app/view/'.$obj['table']['name'].'/'.ucfirst($obj['table']['name'])."Form.js", "a");
		
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


		$text .= "Ext.define('sgaf.view.".$obj['table']['name'].".".ucfirst($obj['table']['name'])."Form',{\n";
	
		$text .= "	extend:	'Ext.panel.Panel',\n";
		$text .= "	alias:	'widget.".$obj['table']['name']."form',\n";
	
		$text .= "	iconCls: 	'menu_icon_".$obj['table']['name']."',\n";
		$text .= "	title: 		'Editar/Criar ".ucfirst($obj['table']['name'])."',\n";
		$text .= "	autoShow: 	true,\n";
		$text .= "	flex: 1,\n";
	
		$text .= "	items: [\n";
		$text .= "		{\n";
	    $text .= "			xtype: 'form',\n";
	    $text .= "			bodyPadding: 10,\n";
	    $text .= "			defaults: {\n";
	    $text .= "				anchor: '100%',\n";
	    $text .= "				msgTarget: 'under'\n";
	    $text .= "			},\n";
	    	
	    $text .= "			items: [\n";
	    $text .= "				{\n";
	    $text .= "				   	xtype: 'hiddenfield',\n";
	    $text .= "				   	name: 'id'\n";
	    $text .= "				},\n";

		foreach ($obj['table']['fields'] as $key) {
			if($key['Field'] !== 'id' && $key['Field'] !== 'datacadastro' && $key['Field'] !== 'dataedicao') {
				$text .= "				{\n";
				$text .= $this->getType($key);
				$text .= "				},\n";
			}
		}

		$text = substr($text, 0, -2) . "\n";

		$text .= "			]\n";
		$text .= "		}\n";
		$text .= "	],\n";

		//docked
		$text .= "	dockedItems: [\n";
	    $text .= "		{\n";
	    $text .= "		 	xtype:	'toolbar',\n";
	    $text .= "		  	dock:		'bottom',\n";
	    $text .= "		  	layout: {\n";
	    $text .= "				  type:	'hbox',\n";
	    $text .= "				  pack:	'end'\n";
	    $text .= "		 	},\n";
	    $text .= "		  	items: [\n";
	    $text .= "		     	{\n";
	    $text .= "		    	 	xtype: 	'button',\n";
	    $text .= "		    	  	text: 	'Cancelar',\n";
	    $text .= "		    	 	itemId: 	'cancela".ucfirst($obj['table']['name'])."',\n";
	    $text .= "			    	iconCls: 	'icon-reset'\n";
	    $text .= "				},\n";
	    $text .= "			    {\n";
	    $text .= "			    	xtype: 	'button',\n";
	    $text .= "			    	text: 	'Salvar',\n";
	    $text .= "			    	itemId: 	'salva".ucfirst($obj['table']['name'])."',\n";
	    $text .= "			    	iconCls: 	'icon-save'\n";
	    $text .= "				}\n";
	    $text .= "			]\n";
	    $text .= "		}\n";
		$text .= "	]\n";

		$text .= "});\n";

		$text .= "\n// Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}

	function getType ($obj) {
		$type = $obj['Type'];

		if(strripos($type, "(")) $type = substr($type, 0, strripos($type, "("));
		
		$t = '';

		if(!empty($obj['fk'])) {
			$t .= "					xtype: 'combo',\n";
			$t .= "					fieldLabel:'".ucfirst($obj['fk'])."',\n";
			$t .= "					queryMode: 'local',\n";
			$t .= "					emptyText:'Selecione ".ucfirst($obj['fk'])."...',\n";
			$t .= "					name: 'id".$obj['fk']."',\n";
			$t .= "					allowBlank : false,\n";
			$t .= "					store: '".ucfirst($obj['fk'])."',\n";
			$t .= "					displayField: 'descricao',\n";
			$t .= "					valueField: 'id'\n";

			return $t;
		}

		if(
			$type == "int" ||
			$type == "tinyint" ||
			$type == "bigint" ||
			$type == "smallint" ||
			$type == "bit" ||
			$type == "real"
		) {
			$t .= "					xtype: 'numberfield',\n";
	    	$t .= "					fieldLabel:'".ucfirst($obj['Field'])."',\n";
	    	$t .= "					name: '".$obj['Field']."',\n";
	    	$t .= "					allowBlank: false\n";
		}
		else if(
			$type == "double" ||
			$type == "float" ||
			$type == "decimal" ||
			$type == "numeric"
		) {
			$t .= "					xtype: 'numberfield',\n";
	    	$t .= "					fieldLabel:'".ucfirst($obj['Field'])."',\n";
	    	$t .= "					name: '".$obj['Field']."',\n";
	    	$t .= "					allowBlank: false\n";
		}
		else if (
			$type == "date" ||
			$type == "time" ||
			$type == "timestamp" ||
			$type == "datetime"
		) {
			$t .= "					xtype: 'datefield',\n";
            $t .= "					anchor: '100%',\n";
            $t .= "					fieldLabel: '".ucfirst($obj['Field'])."',\n";
            $t .= "					name: '".$obj['Field']."',\n";
            $t .= "					format: 'd/m/Y',\n";
            $t .= "					submitFormat: 'Y-m-d',\n";
            $t .= "					allowBlank: false,\n";
            $t .= "					editable: false\n";
		}
		else {
			$t .= "					xtype: 'textfield',\n";
	    	$t .= "					fieldLabel:'".ucfirst($obj['Field'])."',\n";
	    	$t .= "					name: '".$obj['Field']."',\n";
	    	$t .= "					allowBlank: false\n";
		}

		return $t;
	}
}