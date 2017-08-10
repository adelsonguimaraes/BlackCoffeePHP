<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createTeste {
	private $obj;

	function __construct ($obj) {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/teste')) mkdir('../src/teste');
		
		$fp = fopen('../src/teste/'.$obj['table']['name'].".html", "a");
		
		$text = "<html>\n";
		$text .= "<head>\n";
		$text .= "	<title>Teste ".ucfirst($obj['table']['name'])."</title>\n";

		$text .= "	<meta charset=\"utf-8\">\n";
    	$text .= "	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    	$text .= "	<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";

    	$text .= "	<!-- Latest compiled and minified CSS -->\n";
		$text .= "	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" integrity=\"sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7\" crossorigin=\"anonymous\">\n";

		$text .= "	<style type=\"text/css\">\n";
		$text .= "		body {\n";
		$text .= "			background: #ddd;\n";
		$text .= "			background-image: url('../../dist/img/txtmad2.jpg');\n";
		$text .= "		}\n";
		$text .= "		.cx-msg {\n";
		$text .= "			width: 100%;\n";
		$text .= "			position: fixed;\n";
		$text .= "			text-align: center;\n";
		$text .= "			top:70px;\n";
		$text .= "			z-index: 1;\n";
		$text .= "		}\n";
		$text .= "		.cx-content {\n";
		$text .= "			padding: 15px;\n";
		$text .= "			border-radius: 5px;\n";
		$text .= "			background: rgba(0, 255, 0, 0.4);\n";
		$text .= "			font: 16px \"Open Sans\", Helvetica;\n";
		$text .= "			font-weight: 700;\n";
		$text .= "		}\n";
		$text .= "	</style>\n";

		$text .= "</head>\n";
		$text .= "<body>\n";
		$text .= "<div class=\"float-logo\"></div>\n";
		$text .= "	<nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">\n";
    	$text .= "		<div class=\"container-fluid\">\n";
    	$text .= "			<div class=\"navbar-header\">\n";
	    $text .= "        		<a class=\"navbar-brand\" href=\"index.php\">\n";
	    $text .= "           		 ../Home\n";
	    $text .= "        		</a>\n";
        $text .= "			</div>\n";
    	$text .= "		</div>\n";
		$text .= "	</nav>\n";

		$text .= "	<div class=\"cx-msg hide\">\n";
		$text .= "		<span class=\"cx-content\">\n";
		$text .= "			Operação bem sucedida\n";
		$text .= "		</span>\n";
		$text .= "	</div>\n";
		
		$text .= "	<br><br><br><br>\n";

		$text .= "	<div class=\"panel\">\n";
		$text .= "		<div class=\"container-fluid\">\n";
		$text .= "			<h3>Teste da Classe  ".ucfirst($obj['table']['name'])."</h3>\n";
		$text .= "		</div>\n";
		$text .= "	</div>\n";

		$text .= "	<div class=\"container-fluid\">\n";
		
		//cadastrar
		$text .= " 		<div class=\"row\">\n";
		$text .= " 			<div class=\"col-md-12\">\n";
		$text .= " 				<div class=\"panel panel-default\">\n";
		$text .= " 					<div class=\"panel-heading\">\n";
		$text .= " 						<h3>Cadastro / Atualização</h3>\n"; 
		$text .= " 					</div>\n";
		$text .= " 					<div class=\"panel-body\">\n";
		$text .= " 						<form>\n";
		$text .= " 							<div class=\"form-group\">\n";
									
		foreach ($obj['table']['fields'] as $key) {
			if($key['Field'] != "datacadastro" && $key['Field'] != "dataedicao") {
				if($key['Field'] == "id") {
					$text .= "								<input class=\"form-control\" type=\"hidden\" id=\"".$key['Field']."_cadastrar\" name=\"".$key['Field']."_cadastro\" />\n";
				}else{ 
					if(!empty($key['fk'])) {
						$text .= "								".ucfirst($key['fk']).":\n";
						$text .= "								<select class=\"form-control\" id=\"".$key['Field']."_cadastrar\" name=\"".$key['Field']."_cadastrar\">\n";
						//$text .= "								".ucfirst($key['Field']).": <input class=\"form-control\" type=\"text\" id=\"".$key['Field']."_cadastrar\" name=\"".$key['Field']."_cadastro\" />\n";
						$text .= "								</select>\n";
					}else{
						$text .= "								".ucfirst($key['Field']).": <input class=\"form-control\" type=\"text\" id=\"".$key['Field']."_cadastrar\" name=\"".$key['Field']."_cadastro\" />\n";
					}
				}
			}
		}

		$text .= " 							</div>\n";
		$text .= " 							<button type=\"button\" class=\"btn btn-success\" id=\"salvar\">Salvar</button>\n";
		$text .= " 						</form>\n";
		$text .= " 					</div>\n";
		$text .= " 				</div>\n";
		$text .= " 			</div>\n";

		$text .= " 		</div>\n";
		
		$text .= "		<div class=\"row\">\n";
		$text .= " 			<div class=\"col-md-12\">\n";
		$text .= " 				<div class=\"panel  panel-default\">\n";
		$text .= " 					<div class=\"panel-heading\">\n";
		$text .= " 						<h3>Listar / BuscarPorId / Deletar</h3>\n"; 
		$text .= " 					</div>\n";
		$text .= " 					<div class=\"panel-body\">\n";

		$text .= " 						<table class=\"table table-striped\">\n";
 		$text .= " 							<thead>\n";
 		$text .= " 								<tr>\n";
 		foreach ($obj['table']['fields'] as $key) {
 			$text .= " 									<td>".ucfirst($key['Field'])."</td>\n";
 		}
 		$text .= " 									<td>Ações</td>\n";
 		$text .= " 								</tr>\n";
 		$text .= " 							</thead>\n";
 		$text .= " 							<tbody id=\"trbody\">\n";
 		$text .= " 							</tbody>\n";
 		$text .= " 						</table>\n";
		
		$text .= " 						<div id=\"lista\"></div>\n";
		$text .= " 					</div>\n";
		$text .= " 				</div>\n";
		$text .= " 			</div>\n";
		$text .= " 		</div>\n";
		
		$text .= "	</div>\n";

		$text .= "	<br><br><br><br>\n";

		$text .= "	<nav class=\"navbar navbar-inverse navbar-fixed-bottom\" role=\"navigation\">\n";
    	$text .= "		<footer>\n";
	    $text .= "		    <div class=\"container\" style=\"padding-top:15px; text-align:center; color:#fff;\">\n";
	    $text .= "	        	<p>BlackCoffeePHP 2017 - by Adelson Guimarães</p>\n";
	    $text .= "	    	</div>\n";
	    $text .= "		</footer>\n";
		$text .= "	</nav>\n";
		
		$text .= "	<script   ../src=\"https://code.jquery.com/jquery-2.2.4.min.js\"   integrity=\"sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=\"   crossorigin=\"anonymous\"></script>\n";

		$text .= "	<!-- Latest compiled and minified JavaScript -->\n";
		$text .= "	<script ../src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\" integrity=\"sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS\" crossorigin=\"anonymous\"></script>\n";

		$text .= "	<script>\n";
		$text .= "		$(function () {\n";
		
		foreach ($obj['table']['fields'] as $key) {
			if(!empty($key['fk'])) {
				$text .= "		function lista".ucfirst($key['fk'])." () {\n";
				$text .= "			$.ajax({\n";
				$text .= "				url: '../rest/".$key['fk'].".php',\n";
				$text .= "				type: 'POST',\n";
				$text .= "				data: {'metodo':'listar'},\n";
				$text .= "				success: function (data) {\n";
				$text .= "					if(data) {\n";
				$text .= "						var data = $.parseJSON(data);\n";
				$text .= "						var collection = '';\n";
				$text .= "						$.each(data.data, function (index, value) {\n";
				$text .= "						collection += '<option value=\"'+value.id+'\">'+JSON.stringify(value)+'</option>';\n";
				$text .= "						});\n";
				$text .= "						$('#".$key['Field']."_cadastrar').append(collection);\n";
				$text .= "					}\n";
				$text .= "				}\n";
				$text .= "			});\n";
				$text .= "		}\n";
				$text .= "		lista".ucfirst($key['fk'])."();\n";
			}
		}
		
		$text .= "			function listar () {\n";
		$text .= "				\$.ajax({\n";
		$text .= "					url: '../rest/".$obj['table']['name'].".php',\n";
		$text .= "					type: 'POST',\n";
		$text .= "					data: {'metodo':'listar'},\n";
		$text .= "					success: function (data) {\n";
		$text .= "						if(data) {\n";
		$text .= "							var data = \$.parseJSON(data);\n";
		$text .= "							var collection = '';\n";
		$text .= "							$.each(data.data, function (index, value) {\n";
		$text .= "								collection += '<tr>';\n";
		$text .= "								$.each(value, function (index2, value2) {\n";
		$text .= "									if(value2 !== null && typeof(value2)==='object') {\n";
		$text .= "										collection += '<td>'+value2.id+'</td>';\n";
		$text .= "									}else{\n";
		$text .= "										collection += '<td>'+value2+'</td>';\n";
		$text .= "									}\n";
		$text .= "								});\n";
		$text .= "								collection += '<td><div class=\"btn-group\"><button class=\"btn btn-warning atualizar\" type=\"button\" value=\"'+value.id+'\"><i class=\"glyphicon glyphicon-pencil\"></i></button>';\n";
 		$text .= "								collection += '<button class=\"btn btn-danger deletar\"  type=\"button\" value=\"'+value.id+'\"><i class=\"glyphicon glyphicon-trash\"></i></button></div></td>';\n";
		$text .= "								collection += '</tr>';\n";
		$text .= "							});\n";
		$text .= "							$('#trbody').find('td').remove();\n";
		$text .= "							$('#trbody').append(collection);\n";
		$text .= "							funcs();\n";
		$text .= "						}\n";
		$text .= "					}\n";
		$text .= "				});\n";
		$text .= "			}\n";

		$text .= "			listar();\n\n";

		$text .= "			function funcs () {\n";
		$text .= "				$('.atualizar').click( function () {\n";
		$text .= "					var dados = {\"id\":$(this).val()}\n";

		$text .= "					$.ajax({\n";
		$text .= "						url: '../rest/".$obj['table']['name'].".php',\n";
		$text .= "						type: 'POST',\n";
		$text .= "						data: {\n";
		$text .= "							'metodo':'buscarPorId',\n";
		$text .= "							'data': dados\n";
		$text .= "						},\n";
		$text .= "						success: function (data) {\n";
		$text .= "							data = JSON.parse(data);\n";
		$text .= "							if(data.success) {\n";
		$text .= "								data = data.data;\n";
		foreach ($obj['table']['fields'] as $key) {
			if($key['Field'] != "datacadastro" && $key['Field'] != "dataedicao") {
				if(!empty($key['fk'])) {
					// $text .= "								$(\"#".$key['Field']."_cadastrar\").val(data.obj".$key['fk'].".id);\n";
					$text .= "								$(\"#".$key['Field']."_cadastrar\").val(data.id".$key['fk'].");\n";
				}else{
					$text .= "								$(\"#".$key['Field']."_cadastrar\").val(data.".$key['Field'].");\n";
				}
			}
		}

		$text .= "							$('html, body').animate({scrollTop:0}, 'slow');\n";
		$text .= "							}\n";
		$text .= "						}\n";
		$text .= "					});\n";
		$text .= "				});\n";

		// deletar
		$text .= "				$('.deletar').click(function (){\n";
		$text .= "					var dados = {\"id\":$(this).val()}\n\n";

		$text .= "					$.ajax({\n";
		$text .= "						url: '../rest/".$obj['table']['name'].".php',\n";
		$text .= "						type: 'POST',\n";
		$text .= "						data: {\n";
		$text .= "						'metodo':'deletar',\n";
		$text .= "							'data': dados\n";
		$text .= "						},\n";
		$text .= "						success: function (data) {\n";
		$text .= "							listar();\n";
		$text .= "							\$('.cx-msg').removeClass('hide');\n";
		$text .= "							setTimeout(function () {\$('.cx-msg').addClass('hide');}, 5000);\n";
		$text .= "						}\n";
		$text .= "					});\n\n";
		
		$text .= "				});\n\n";

		$text .= "			}\n";




		$text .= "			$('#salvar').click(function (){\n";
		$text .= "				var metodo = 'cadastrar';\n";
		$text .= "				if($(\"#id_cadastrar\").val()) metodo = 'atualizar';\n";
		$text .= "				var dados = {\n";
		foreach ($obj['table']['fields'] as $key) {
			if($key['Field'] != "datacadastro" && $key['Field'] != "dataedicao") {
				$text .= "					\"".$key['Field']."\":$(\"#".$key['Field']."_cadastrar\").val(),\n";
			}
		}
		$text = substr($text, 0, -2) . "\n";
		$text .= "				}\n\n";

		$text .= "				$.ajax({\n";
		$text .= "					url: '../rest/".$obj['table']['name'].".php',\n";
		$text .= "					type: 'POST',\n";
		$text .= "					data: {\n";
		$text .= "						'metodo':metodo,\n";
		$text .= "						'data': dados\n";
		$text .= "					},\n";
		$text .= "					success: function (data) {\n";
		$text .= "						listar();\n";
		$text .= "						\$('.cx-msg').removeClass('hide');\n";
		$text .= "						setTimeout(function () {\$('.cx-msg').addClass('hide');}, 5000);\n";
		$text .= "					}\n";
		$text .= "				});\n\n";

		foreach ($obj['table']['fields'] as $key) {
			if($key['Field'] != "datacadastro" && $key['Field'] != "dataedicao") {
				if(empty($key['fk'])) {
					$text .= "				$(\"#".$key['Field']."_cadastrar\").val('');\n";
				}
			}
		}

		$text .= "			});\n\n";

		$text .= "		});\n";
		$text .= "	</script>\n";

		$text .= "</body>\n";
		$text .= "<!-- Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães -->\n";
		$text .= "</html>\n";


		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);

	}
}
?>