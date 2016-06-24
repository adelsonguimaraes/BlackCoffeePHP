<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

Class createExtController {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src/app')) mkdir('../src/app');
		if(!file_exists('../src/app/controller')) mkdir('../src/app/controller');
		
		$fp = fopen('../src/app/controller/'.ucfirst($obj['table']['name']).".js", "a");
		
		$text = "// controller : ".$obj['table']['name']."\n\n";

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

		$text .= "Ext.define('sgaf.controller.".ucfirst($obj['table']['name'])."',{\n";
		$text .= "	extend: 'Ext.app.Controller',\n";
	
		$text .= "	stores: ['".ucfirst($obj['table']['name'])."'],\n";
	
		$text .= "	models: ['".ucfirst($obj['table']['name'])."'],\n";
	
		$text .= "	views: ['".$obj['table']['name'].'.'.ucfirst($obj['table']['name'])."Panel'],\n";
	
		$text .= "	requires: ['sgaf.util.Alert', 'sgaf.util.TelaUsuarioController'],\n";
		
		$escreve = fwrite($fp, $text, strlen($text));

		$this->writeReferences ($fp, $obj);
		$this->writeInit ($fp, $obj);
		$this->writeOnRender ($fp, $obj);
		$this->writeNovo ($fp, $obj);
		$this->writePosicaoForm ($fp, $obj);
		$this->writeEditar ($fp, $obj);
		$this->writeUpdate ($fp, $obj);
		$this->writeDeletar ($fp, $obj);
		$this->writeCancelar ($fp, $obj);

		$text = "}\n";
		$text .= "\n// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}

	function writeReferences ($fp, $obj) {
		$text = "	//refs\n";
		$text .= "	refs: [\n";
        $text .= "		{\n";
        $text .= "			ref: '".$obj['table']['name']."Panel',\n";
        $text .= "			selector: '".$obj['table']['name']."panel'\n";
        $text .= "		},\n";
    	$text .= "		{\n";
	    $text .= "	 	   ref: '".$obj['table']['name']."Grid',\n";
	    $text .= "	 	   selector: '".$obj['table']['name']."grid'\n";
    	$text .= "		},\n";
    	$text .= "		{\n";
        $text .= "		    ref: 'TabPanel',\n";
        $text .= "		    selector: '".$obj['table']['name']."tabpanel'\n";
        $text .= "		},\n";
    	$text .= "		{\n";
        $text .= "	 	   ref: 'Form',\n";
        $text .= "	 	   selector: '".$obj['table']['name']."form form'\n";
        $text .= "		},\n";
        $text .= "		{\n";
        $text .= "		    ref: 'PanelOeste',\n";
        $text .= "		    selector: '".$obj['table']['name']."panel panel#oeste'\n";
        $text .= "		},\n";
        $text .= "		{\n";
        $text .= "		    ref: 'PanelSul',\n";
        $text .= "	 	   selector: '".$obj['table']['name']."panel panel#sul'\n";
        $text .= "		}\n";
    	
    	$text .= "	],\n\n";

    	$escreve = fwrite($fp, $text, strlen($text));
	}
	function writeInit ($fp, $obj) {
		$text = "	//init\n";
		$text .= "	init: function(){\n";
		$text .= "		this.controller({\n";
		$text .= "			// '".$obj['table']['name']."grid dataview': {\n";
		$text .= "			// 	itemdblclick: this.editar".ucfirst($obj['table']['name'])."\n";
		$text .= "			// },\n";
		$text .= "			'".$obj['table']['name']."grid':  {\n";
		$text .= "				select: this.editar".ucfirst($obj['table']['name']).",\n";
		$text .= "				itemdblclick: this.editar".ucfirst($obj['table']['name']).",\n";
		$text .= "				render: this.onRender\n";
		$text .= "			},\n";
		$text .= "			'".$obj['table']['name']."grid button#add".ucfirst($obj['table']['name'])."': {\n";
		$text .= "				click: this.novo".ucfirst($obj['table']['name'])."\n";
		$text .= "			},\n";
		$text .= "			'".$obj['table']['name']."grid button#delete".ucfirst($obj['table']['name'])."': {\n";
		$text .= "				click: this.delete".ucfirst($obj['table']['name'])."\n";
		$text .= "			},\n";
		$text .= "			'menu#posform".$obj['table']['name']." menuitem': {\n";
		$text .= "				click: this.posicaoForm\n";
		$text .= "			},\n";
		$text .= "			'".$obj['table']['name']."form button#salva".ucfirst($obj['table']['name'])."': {\n";
		$text .= "				click: this.update".ucfirst($obj['table']['name'])."\n";
		$text .= "			},\n";
		$text .= "			'".$obj['table']['name']."form button#cancela".ucfirst($obj['table']['name'])."': {\n";
		$text .= "				click: this.cancela".ucfirst($obj['table']['name'])."\n";
		$text .= "			}\n";
		$text .= "		});\n";
		$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeOnRender ($fp, $obj) {
		$text = "	//onRender\n";
		$text .= "	onRender: function( grid, eOpts ){\n";
		$text .= "		var store = this.get".ucfirst($obj['table']['name'])."Store();\n";
		$text .= "		store.load();\n";
		$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeNovo ($fp, $obj) {
		$text = "	//Novo\n";
		$text .= "	novo".ucfirst($obj['table']['name']).": function(){\n";
		$text .= "		var oeste 	= this.getPanelOeste();\n";
        $text .= "		var sul		= this.getPanelSul();\n";

		$text .= "		if( sul.isVisible() == true ){\n";
		$text .= "			sul.expand(true);\n";
		$text .= "		}else if(oeste.isVisible() == true){\n";
		$text .= "			oeste.expand(true);\n";
		$text .= "		}else{\n";
		$text .= "			//\n";
		$text .= "		}\n";
		$text .= "		this.getForm().getForm().reset();\n";
		$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writePosicaoForm ($fp, $obj) {
		$text = "	//posicaoForm\n";
		$text .= "	posicaoForm: function(item, e, options) {\n";

		$text .= "		var button = item.up('button');\n";

	    $text .= "	    var oeste 	= this.getPanelOeste();\n";
	    $text .= "	    var sul		= this.getPanelSul();\n";
	    $text .= "	    var form 	= this.getTabPanel();\n";
	        
	    $text .= "	    switch (item.itemId) {\n";
	    $text .= "	        case 'bottom':\n";
	    $text .= "	            oeste.hide();\n";
	    $text .= "	            sul.show();\n";
	    $text .= "	            sul.add(form);\n";
	    $text .= "	            button.setIconCls('bottom');\n";
	    $text .= "	            button.setText('Abaixo');\n";
	    $text .= "	           	break;\n";
	    $text .= "	        case 'right':\n";
	    $text .= "	            sul.hide();\n";
	    $text .= "	            oeste.show();\n";
	    $text .= "	            oeste.add(form);\n";
	    $text .= "	            button.setIconCls('right');\n";
	    $text .= "	            button.setText('À Direita');\n";
	    $text .= "	            break;\n";
	    $text .= "	        default:\n";
	    $text .= "	            sul.hide();\n";
	    $text .= "	            oeste.hide();\n";
	    $text .= "	            button.setIconCls('hide');\n";
	    $text .= "	            button.setText('Oculto');\n";
	    $text .= "	            break;\n";
	    $text .= "		}\n";
    	$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeEditar ($fp, $obj) {
		$text = "	//editar\n";
		$text .= "	editar".ucfirst($obj['table']['name']).": function(grid, record) {\n";
		
		$text .= "		var oeste 	= this.getPanelOeste();\n";
        $text .= "		var sul		= this.getPanelSul();\n";
		
		$text .= "		if( sul.isVisible() == true ){\n";
		$text .= "			sul.expand(true);\n";
		$text .= "		}else if(oeste.isVisible() == true){\n";
		$text .= "			oeste.expand(true);\n";
		$text .= "		}else{\n";
		$text .= "			//\n";
		$text .= "		}\n";
				
		$text .= "		if(record){\n";
		$text .= "			this.getForm().loadRecord(record);\n";
		$text .= "		}\n";
		
		$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeUpdate ($fp, $obj) {
		$text = "	//update\n";
		$text .= "	update".ucfirst($obj['table']['name']).": function(button){\n";
		$text .= "		var winoeste = this.getPanelOeste();\n";
		$text .= "		var winsul = this.getPanelSul();\n";
		$text .= "		var permissao = false;\n";
		$text .= "		form = this.getForm();\n";
		$text .= "		record = form.getRecord();\n";
			
		$text .= "		values = form.getValues();\n";
		
		$text .= "		var novo = false;\n";
		
		$text .= "		if( form.isValid() )\n";
		$text .= "		{\n";
		$text .= "			if(values.id > 0){\n";
		$text .= "				record.set(values);\n";
		$text .= "				permissao = sgaf.util.TelaUsuarioController.verify({'tela':'".$obj['table']['name']."crud','acao':'atualizar'});\n";
		$text .= "			}else{\n";
		$text .= "				record = Ext.create('sgaf.model.".ucfirst($obj['table']['name'])."');\n";
		$text .= "				record.set(values);\n";
		$text .= "				this.get".ucfirst($obj['table']['name'])."Store().add(record);\n";
		$text .= "				novo = true;\n";
		$text .= "				permissao = sgaf.util.TelaUsuarioController.verify({'tela':'".$obj['table']['name']."crud','acao':'cadastrar'});\n";
		$text .= "			}\n";

		$text .= "			var session = JSON.parse(localStorage[\"sessionSgaf\"]);\n";
		$text .= "			var usuario = Ext.encode(session.usuario);\n";
		$text .= "			var store = this.get".ucfirst($obj['table']['name'])."Store();\n";
		$text .= "			store.getProxy().setExtraParam('usuario',usuario);\n";
			
		$text .= "			if(permissao) {\n";
		$text .= "				store.sync();\n";
		$text .= "			}\n";
			
		$text .= "			/*-- Se o novo for true da reload na grid para atualizar a lista --*/\n";
		$text .= "			setTimeout( function () {store.load()}, 500);\n";
			
		$text .= "			/*-- Limpa Form --*/\n";
		$text .= "			form.getForm().reset();\n";
			
		$text .= "			/*-- Minimiza a Tab --*/\n";
		$text .= "			if(winoeste){\n";
		$text .= "				winoeste.collapse( false );\n";
		$text .= "			}else if(winsul){\n";
		$text .= "				winsul.collapse( false );\n";
		$text .= "			}else{\n";
		$text .= "				//nada\n";
		$text .= "			}\n";
		$text .= "		}\n";
		
		$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}
	function writeDeletar ($fp, $obj) {
		$text = "	//deletar\n";
		$text .= "	delete".ucfirst($obj['table']['name']).": function(btn, e, opts){\n";
		$text .= "		var form = this.getForm();\n";
		$text .= "		var permissao = false;\n";
		$text .= "		permissao = sgaf.util.telaUsuarioController.verify({'tela':'".$obj['table']['name']."crud','acao':'deletar'});\n";
		$text .= "		if(!permissao) return false;\n";
		
		$text .= "		Ext.MessageBox.confirm('Atenção', 'Deseja realmente deletar?', function(botton){\n";
			
		$text .= "			if(botton == 'yes'){\n";
				
		$text .= "				var grid = btn.up('grid');\n";
		$text .= "				records = grid.getSelectionModel().getSelection(),\n";
	    $text .= "				store = grid.getStore();\n";
	    		
		$text .= "				/*-- Verificando se os dados tem dependentes --*/\n";
					
		$text .= "	    		form.getForm().reset();\n";
			    	
		$text .= "	    		sgaf.util.Alert.msg('Successo!', '".ucfirst($obj['table']['name'])." Deletado!');\n";
		    		
		$text .= "				store.remove(records);\n";
				    
		$text .= "				var session = JSON.parse(localStorage[\"sessionSgaf\"]);\n";
		$text .= "				var usuario = Ext.encode(session.usuario);\n";
		$text .= "				store.getProxy().setExtraParam('usuario',usuario);\n";
		$text .= "				store.sync();\n";
				    	
		$text .= "			}else if(botton == 'no'){\n";
		$text .= "				return false;\n";
		$text .= "			}\n";
		$text .= "		});  	\n";
		
		$text .= "	},\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}
	function writeCancelar ($fp, $obj) {
		$text = "	//cancelar\n";
		$text .= "	cancela".ucfirst($obj['table']['name']).": function(button){\n";
		
		$text .= "		var winoeste = this.getPanelOeste();\n";
		$text .= "		var winsul = this.getPanelSul();\n";
		$text .= "		var form = this.getForm();\n";
		
		$text .= "		form.getForm().reset();\n";
		
		$text .= "		if(winoeste){\n";
		$text .= "			winoeste.collapse( false );\n";
		$text .= "		}else if(winsul){\n";
		$text .= "			winsul.collapse( false );\n";
		$text .= "		}else{\n";
		$text .= "			//nada\n";
		$text .= "		}\n";
		
		$text .= "	}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}
}