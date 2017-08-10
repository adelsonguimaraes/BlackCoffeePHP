<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class createIndexTeste {

	function __construct () {

		if(!file_exists('../src')) mkdir('../src');
		if(!file_exists('../src/teste')) mkdir('../src/teste');

		$nomeProjeto = "BlackCoffeePHP";
			
		$fp = fopen("../src/teste/index.php", "a");
		
		$text = ""  

		."<?php\n"
		."// index testes\n\n"

		."	//path\n"
		."	\$path = '../teste';\n"
		."	\$diretorio = dir(\$path);\n"
		."  \$total = 0;\n"
		."?>\n"

		."<html>\n"
		."<head>\n"
		."	<title>Home de Testes</title>\n"

		."	<meta charset=\"utf-8\">\n"
    	."	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n"
    	."	<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n"

		."	<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" integrity=\"sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7\" crossorigin=\"anonymous\">\n"

		."	<style type=\"text/css\">\n"
		."	body {\n"
		."		background: #ddd;\n"
		."		background-image: url('../../dist/img/txtmad2.jpg');\n"
		."	}\n"
		."	.list {\n"
		."		display: block;\n"
		."		color: #666;\n"
		."	}\n"
		." .float-logo {\n"
        ." 		background: url('../../dist/img/bcphplogo.png') no-repeat;\n"
		."		background-size: 120px;\n"
        ."		background-position: 50%;\n"
        ."		height: 120px;\n"
        ."		width: 120px;\n"
        ."		padding: 10px;\n"
        ."		border-radius:50px;\n"
        ."		margin: 0 auto;\n"
        ."		position: fixed;\n"
        ."		right: 1%;\n"
		."		bottom: 6%;\n"
		."		z-index: 1050;\n"
        ."		color: black;\n"
		."	}\n"
		."	@media only screen and (max-width: 768px) {\n"
		."		/* For mobile phones: */\n"
		."		[class*=\"float-\"] {\n"
		."			background-size: 50px;\n"
		."			height: 50px;\n"
		."			width: 50px;\n"
		."			top: 1%;\n"
		."			z-index: 1050;\n"
		."		}\n"
		."		.logo > img {\n"
		."			top:500;\n"
		."			padding: 50px;\n"
		."			height: 300px;\n"
		."		}\n"
		."	}\n"
		."	</style>\n"

		."</head>\n"
		."<body>\n"

		."	<div class=\"float-logo\" onClick=window.location.replace('../../index.html')></div>\n"
		."	<nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">\n"
    	."		<div class=\"container\" style=\"padding-top:15px; text-align:center; color:#fff;\">\n"
	    ."	   		<h4>BlackCoffeePHP 2.0</h4>\n"
	    ."		</div>\n"
		."	</nav>\n"
		."	<br><br><br><br><br>\n"

		."	<div class=\"container\">\n"
		."		<div class=\"panel panel-default\">\n"
		."			<div class=\"panel-heading\">\n"
		."				<h3>Home de Teste - ".$nomeProjeto."<h3>\n"
		."			</div>\n"
		."			<div class=\"panel-body\">\n"
		."				<ul>\n"
		."					<?php\n"
		."						while (\$arquivo = \$diretorio -> read()) {\n"
		."							\$label = substr(\$arquivo, 0, strrpos(\$arquivo, \".\"));\n"
		."							if(strlen(\$label) >  3 && \$label != \"index\") {\n"
		."								\$total++;\n"
		."								?>\n"
		."									<li><a  class=\"list\" href=\"<?php echo \$arquivo ?>\"><label><?php echo ucfirst(\$label) ?></label></a></li>\n"
		."								<?php\n"
		."							}\n"
		."						}\n"
		."					?>\n"
		."				</ul>\n"
		."			</div>\n"
		."			<div class=\"panel-footer\">\n"
		."				<div> Foram listadas <?php echo \$total ?> Classes</div>\n"
		."			</div>\n"
		."		</div>\n"
		."	</div>\n"
		."	<br><br><br><br><br>\n"

		."	<nav class=\"navbar navbar-inverse navbar-fixed-bottom\" role=\"navigation\">\n"
	    ."		<div class=\"container\" style=\"padding-top:15px; text-align:center; color:#fff;\">\n"
		."	         BlackCoffeePHP 2017 - by Adelson Guimarães\n"
		."	    </div>\n"
		."	</nav>\n\n"

		."	<script ../src=\"https://code.jquery.com/jquery-2.2.4.min.js\"   integrity=\"sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=\"   crossorigin=\"anonymous\"></script>\n"
		."	<script ../src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\" integrity=\"sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS\" crossorigin=\"anonymous\"></script>\n"

		."	<script type=\"text/javascript\">\n"
		."		\$(function () {\n"
		."			\$('#gerar').click( function () {\n"
		."			if(\$('#host').val() === '' || \$('#user').val() === '' || \$('#banco').val() === '') {\n"
		."					return false;\n"
		."				}\n"
		."			});\n"
		."		});\n"
		."	</script>\n"

		."</body>\n"
		."<!-- Classe gerada com BlackCoffeePHP 2.0 - by Adelson Guimarães -->\n"
		."</html>\n";

		$escreve = fwrite($fp, $text, strlen($text));

		fclose($fp);
	}
}
?>