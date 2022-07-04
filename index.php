<?php


require 'Zip.class.php';


try{
    // Diretório que deseja compactar
    $pathFrom = 'toZip';
    // Nome do arquivo zip a ser criado
    $zipName = 'newZipName';
    // Diretório para onde o arquivo será compactado
    $pathTo = 'zipped/'.$zipName.'.zip';

    $zip = new Zip;

    $zipper = $zip->zipDir($pathFrom,$pathTo);
    if ($zipper){
        echo 'Arquivo Zipado com sucesso!';
    }

}catch(\Exception $e){
    echo 'Error: '.$e->getMessage();
    die();
}


