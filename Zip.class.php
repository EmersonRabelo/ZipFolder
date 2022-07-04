<?php

/**
 * Cria arquivos compactados .zip
 * @author Emerson Teles Rabelo
**/

Class Zip {

    public static function ZipDir($sourcePath, $outZipPath){
        $pathInfo = pathinfo($sourcePath);
        $parentPath = $pathInfo['dirname'];
        $dirName = $pathInfo['basename'];
    
        $zip = new ZipArchive;
        $zip->open($outZipPath, ZipArchive::CREATE);
        $pathLength = strlen($parentPath.$dirName);

        if ($sourcePath == $dirName){
            self::dirToZip($sourcePath, $zip, $pathLength); 
        }else {
            self::dirToZip($sourcePath, $zip, $pathLength);
        }
        $zip->close();
        return true;
    }

    private static function dirToZip($folder, &$zipFile, $exclusiveLength){
        $handle = opendir($folder);   
        while(FALSE !== $f = readdir($handle)){
            if ($f != '.' && $f != '..' && $f != basename(__FILE__)){
                $filePath = "$folder/$f";

                $localPath = substr($filePath, $exclusiveLength);
                if (is_file($filePath)){
                    $zipFile->addFile($filePath, $localPath);
                }elseif(is_dir($filePath)) {
                    $zipFile->addEmptyDir($localPath);
                    self::dirToZip($filePath, $zipFile, $exclusiveLength);
                }
            }
        }
        closedir($handle);
    }

}
