<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createDAO {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/model')) mkdir('../src/model');
		if(!file_exists('../src/model/'.$obj['table']['name'])) mkdir('../src/model/'.$obj['table']['name']);
		
		$fp = fopen('../src/model/'.$obj['table']['name'].'/'.ucfirst($obj['table']['name'])."DAO.php", "a");
		
		$text = "<?php\n";
		$text .= "// dao : ".$obj['table']['name']."\n\n";

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

		$text .= "Class ".ucfirst($obj['table']['name'])."DAO {\n";
		$text .= "	//atributos\n";
		$text .= "	private \$con;\n";
		$text .= "	private \$sql;\n";
		$text .= "	private \$obj;\n";
		$text .= "	private \$lista = array();\n\n";

		$text .= "	//construtor\n";
		$text .= "	public function __construct(\$con) {\n";
		$text .= "		\$this->con = \$con;\n";
		$text .= "	}\n\n";
		
		$escreve = fwrite($fp, $text, strlen($text));

		$this->writeCadastrar ($fp, $obj);
		$this->writeBuscarPorId ($fp, $obj);
		$this->writeListar ($fp, $obj);
		$this->writeAtualizar ($fp, $obj);
		$this->writeDeletar ($fp, $obj);
		$this->writeListarPaginado ($fp, $obj);
		$this->writeQuantidadeTotal ($fp, $obj);
		
		$text = "}\n\n";

		$text .= "// Classe gerada com BlackCoffeePHP 1.0 - by Adelson Guimarães\n?>";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}

	function writeCadastrar ($fp, $obj) {
		$text = "	//cadastrar\n";
		$text .= "	function cadastrar (".ucfirst($obj['table']['name'])." \$obj) {\n";
		$text .= "		\$this->sql = sprintf(\"INSERT INTO ".$obj['table']['name']."(";
		$values = "		VALUES(";
		$objs = "";
		foreach($obj['table']['fields'] as $key) {
			if($key['Field'] == 'dataedicao' || $key['Field'] == 'datacadastro' || $key['Field'] == "id") {
				//
			}else{
				$text .= $key['Field']. ", ";
				$values .= $this->getType ($key['Type']) . ", ";
				if(!empty($key['fk'])) {
					$objs .= "			mysqli_real_escape_string(\$this->con, \$obj->getObj".$key['fk']."()->getId()),\n";
				}else{
					$objs .= "			mysqli_real_escape_string(\$this->con, \$obj->get".ucfirst($key['Field'])."()),\n";
				}
			}
		}
		$text = substr($text, 0 , -2) . ")\n";
		$values = substr($values, 0 , -2) . ")\",\n";
		$objs = substr($objs, 0 , -2) . ");\n";
			
		$text .= $values . $objs;
		
		$text .= "		if(!mysqli_query(\$this->con, \$this->sql)) {\n";
		$text .= "			die('[ERRO]: Class('.get_class(\$obj).') | Metodo(Cadastrar) | Erro('.mysqli_error(\$this->con).')');\n";
		$text .= "		}\n";
		$text .= "		return mysqli_insert_id(\$this->con);\n";
		$text .= "	}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeAtualizar ($fp, $obj) {
		$text = "	//atualizar\n";
		$text .= "	function atualizar (".ucfirst($obj['table']['name'])." \$obj) {\n";
		$text .= "		\$this->sql = sprintf(\"UPDATE ".$obj['table']['name']." SET ";
		$objs = "";
		foreach($obj['table']['fields'] as $key) {
			if($key['Field'] != 'datacadastro' && $key['Field'] != "id") {
				$text .=  $key['Field']. " = ". $this->getType ($key['Type']). ", ";
				if($key['Field'] == "dataedicao") {
					$objs .= "			mysqli_real_escape_string(\$this->con, date('Y-m-d')),\n";
				}else{
					if(!empty($key['fk'])) {
						$objs .= "			mysqli_real_escape_string(\$this->con, \$obj->getObj".$key['fk']."()->getId()),\n";
					}else{
						$objs .= "			mysqli_real_escape_string(\$this->con, \$obj->get".ucfirst($key['Field'])."()),\n";
					}
				}
			}
		}
		$text = substr($text, 0 , -2);
		$text .=  " WHERE id = %d \",\n";
		$objs .= "			mysqli_real_escape_string(\$this->con, \$obj->getId()));\n";
		
		$text .= $objs;

		$text .= "		if(!mysqli_query(\$this->con, \$this->sql)) {\n";
		$text .= "			die('[ERRO]: Class('.get_class(\$obj).') | Metodo(Atualizar) | Erro('.mysqli_error(\$this->con).')');\n";
		$text .= "		}\n";
		$text .= "		return mysqli_insert_id(\$this->con);\n";
		$text .= "	}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeBuscarPorId ($fp, $obj) {
		$text = "	//buscarPorId\n";
		$text .= "	function buscarPorId (".ucfirst($obj['table']['name'])." \$obj) {\n";
		$text .= "		\$this->sql = sprintf(\"SELECT * FROM ".$obj['table']['name']." WHERE id = %d\",\n";
		$text .= "			mysqli_real_escape_string(\$this->con, \$obj->getId()));\n";
		$text .= "		\$resultSet = mysqli_query(\$this->con, \$this->sql);\n";
		$text .= "		if(!\$resultSet) {\n";
		$text .= "			die('[ERRO]: Class('.get_class(\$obj).') | Metodo(BuscarPorId) | Erro('.mysqli_error(\$this->con).')');\n";
		$text .= "		}\n";
		$text .= "		while(\$row = mysqli_fetch_object(\$resultSet)) {\n";
		$objs = "";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "			//classe ".$key['fk']."\n";
				$text .= "			\$control".ucfirst($key['fk'])." = new ".ucfirst($key['fk'])."Control(new ".ucfirst($key['fk'])."(\$row->".$key['Field']."));\n";
				$text .= "			\$obj".ucfirst($key['fk'])." = \$control".ucfirst($key['fk'])."->buscarPorId();\n";
				$objs .= "\$obj".ucfirst($key['fk']). ", ";
			}else{
				$objs .= "\$row->".$key['Field']. ", ";
			}
		}
		$objs = substr($objs, 0 , -2) . "";
		$text .= "			\$this->obj = new ".ucfirst($obj['table']['name'])."(".$objs.");\n";
		
		$text .= "		}\n";
		$text .= "		return \$this->obj;\n";
		$text .= "	}\n\n";
	
		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeListar ($fp, $obj) {
		$text = "	//listar\n";
		$text .= "	function listar (".ucfirst($obj['table']['name'])." \$obj) {\n";
		$text .= "		\$this->sql = \"SELECT * FROM ".$obj['table']['name']."\";\n";
		$text .= "		\$resultSet = mysqli_query(\$this->con, \$this->sql);\n";
		$text .= "		if(!\$resultSet) {\n";
		$text .= "			die('[ERRO]: Class(Banco) | Metodo(Listar) | Erro('.mysqli_error(\$this->con).')');\n";
		$text .= "		}\n";
		$text .= "		while(\$row = mysqli_fetch_object(\$resultSet)) {\n";
		$objs = "";
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "			//classe ".$key['fk']."\n";
				$text .= "			\$control".ucfirst($key['fk'])." = new ".ucfirst($key['fk'])."Control(new ".ucfirst($key['fk'])."(\$row->".$key['Field']."));\n";
				$text .= "			\$obj".ucfirst($key['fk'])." = \$control".ucfirst($key['fk'])."->buscarPorId();\n";
				$objs .= "\$obj".ucfirst($key['fk']). ", ";
			}else{
				$objs .= "\$row->".$key['Field']. ", ";
			}
		}
		$objs = substr($objs, 0 , -2) . "";
		$text .= "			\$this->obj = new ".ucfirst($obj['table']['name'])."(".$objs.");\n";
		
		$text .= "			array_push(\$this->lista, \$this->obj);\n";
		$text .= "		}\n";
		$text .= "		return \$this->lista;\n";
		$text .= "	}\n\n";
	
		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeDeletar ($fp, $obj) {
		$text = "	//deletar\n";
		$text .= "	function deletar (".ucfirst($obj['table']['name'])." \$obj) {\n";
		$text .= "		\$this->sql = sprintf(\"DELETE FROM ".$obj['table']['name']." WHERE id = %d\",\n";
		$text .= "			mysqli_real_escape_string(\$this->con, \$obj->getId()));\n";
		$text .= "		\$resultSet = mysqli_query(\$this->con, \$this->sql);\n";
		$text .= "		if(!\$resultSet) {\n";
		$text .= "			die('[ERRO]: Class('.get_class(\$obj).') | Metodo(Deletar) | Erro('.mysqli_error(\$this->con).')');\n";
		$text .= "		}\n";
		$text .= "		return true;\n";
		$text .= "	}\n\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeListarPaginado ($fp, $obj) {
		$text = "	//listar paginado\n";
		$text .= "	function listarPaginado(\$start, \$limit) {\n";
		$text .= "		\$this->sql = \"SELECT * FROM ".$obj['table']['name']." limit \" . \$start . \", \" . \$limit;\n";
		$text .= "		\$result = mysqli_query ( \$this->con, \$this->sql );\n";
		$text .= "		if (! \$result) {\n";
		$text .= "			die ( '[ERRO]: ' . mysqli_error ( \$this->con ) );\n";
		$text .= "		}\n";
		
		$text .= "		\$this->lista = array();\n";
		
		$text .= "		while ( \$row = mysqli_fetch_assoc ( \$result ) ) {\n";
		$text .= "			\$this->lista=\$row;\n";
		$text .= "		}\n";
		$text .= "		//teste\n";
		$text .= "		return \$this->lista;\n";
		$text .= "	}\n";

		$escreve = fwrite($fp, $text, strlen($text));
	}

	function writeQuantidadeTotal ($fp, $obj) {
		$text = "	//quantidade total\n";
		$text .= "	function qtdTotal() {\n";
		$text .= "		\$this->sql = \"SELECT count(*) as quantidade FROM ".$obj['table']['name']."\";\n";
		$text .= "		\$result = mysqli_query ( \$this->con, \$this->sql );\n";
		$text .= "		if (! \$result) {\n";
		$text .= "			die ( '[ERRO]: ' . mysqli_error ( \$this->con ) );\n";
		$text .= "		}\n";
		$text .= "		\$total = 0;\n";
		$text .= "		while ( \$row = mysqli_fetch_object ( \$result ) ) {\n";
		$text .= "			\$total = \$row->quantidade;\n";
		$text .= "		}\n";
		
		$text .= "		return \$total;\n";
		$text .= "	}\n";

		$escreve = fwrite($fp, $text, strlen($text));
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
		) {$t = "%d";}
		else if(
			$type == "double" ||
			$type == "float" ||
			$type == "decimal" ||
			$type == "numeric"
		) {$t = "%f";}
		else {$t = "'%s'";}

		return $t;
	}
}
?>