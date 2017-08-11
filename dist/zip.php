<?php
/*
	Framework BlackCoffeePHP Gerador de Classes by Adelson Guimarães.
*/

// encoding
header('Content-type: text/html; charset=UTF-8');

Class Zip {
    private $obj;

    function __construct (Config $obj) {
        // diretório que será compactado
        $diretorio = getcwd().'/../src/';

        // inicializa a classe ZipArchive
        $zip = new ZipArchive();
        // abre o arquivo .zip
        if ($zip->open($obj->banco. ".zip", ZIPARCHIVE::CREATE) !== TRUE) {
            die ("Erro!");
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($diretorio));

        // itera cada pasta/arquivo contido no diretório especificado
        // foreach ($iterator as $key=>$value) {
        //     // if ( cho substr($key,-3) === '\..' ) {
        //     //     die($key);
        //     // }
        //     // adiciona o arquivo ao .zip
        //     echo 'aqui passou '.$key.' <br>';
        //     $zip->addFile(realpath($key), iconv('ISO-8859-1', 'IBM850', $key)) or die ("ERRO: Não é possível adicionar o arquivo: $key");
    
        // }

        // $zip->addFile(realpath(getcwd().'/../src/app/'), iconv('ISO-8859-1', 'IBM850', '/../src/app/')) or die ("ERRO: Não é possível adicionar o arquivo: /../src/app/");
        // $zip->addFile(realpath(getcwd().'/../src/app/app.js'), iconv('ISO-8859-1', 'IBM850', '/../src/app/app.js')) or die ("ERRO: Não é possível adicionar o arquivo: /../src/app/app.js");
        // $zip->addFile($diretorio.'/app/');
        // $zip->addFile($diretorio.'/app/app.js');

        // fecha e salva o arquivo .zip gerado
        $zip->close();
    }
}

?>