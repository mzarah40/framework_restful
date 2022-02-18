<?php 

namespace App\Machinery;

class MakeClass
{

    private static $className;
    private static $controller;
    private static $model;

    public static function make ( string $className, string $classContent, string $type) 
    {

        self::$className = $className;

        switch ( $type )
        {
            case "controller":
                self::makeController( $classContent );
                break;
            case "model":
                self::makeModel ( $classContent );
                break;
        }
    }

    private static function makeController ( string $classContent )
    {
        self::$controller = "package_crud/" . self::$className . ".php";
        file_put_contents(self::$controller, $classContent);
    }

    private static function makeModel ( string $classContent )
    {
        self::$model  = "package_crud/" . self::$className . ".php";
        file_put_contents(self::$model, $classContent);
    }

    public function compact (bool $forceDownload=false) 
    {
        $id  =  date('d-m-Y_His');
        $zip = new \ZipArchive();
        $zip->open("package_crud/pacote_".$id.".zip", \ZipArchive::CREATE);
        $zip->addFile(self::$controller);
        $zip->addFile(self::$model);
        $zip->close();

        if ( $forceDownload ) {

            $zipado = "package_crud/pacote_" . $id . ".zip";

            switch(strtolower(substr(strrchr(basename($zipado),"."),1))){
                // verifica a extensão do arquivo para pegar o tipo
                case "pdf": $tipo="application/pdf"; break;
                case "exe": $tipo="application/octet-stream"; break;
                case "zip": $tipo="application/zip"; break;
                case "doc": $tipo="application/msword"; break;
                case "xls": $tipo="application/vnd.ms-excel"; break;
                case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
                case "gif": $tipo="image/gif"; break;
                case "png": $tipo="image/png"; break;
                case "jpg": $tipo="image/jpg"; break;
                case "mp3": $tipo="audio/mpeg"; break;
                case "php": $tipo="text/plain"; break;
                case "htm": // deixar vazio por seurança
                case "html": // deixar vazio por seurança

            }
            // informa tipo do arquivo ao navegador
            header('Content-Type:'.$tipo);
            // informa o tamanho do arquivo ao navegador
            header('Content-Length:'.filesize($zipado));
            // informa que é um anexo e faz abrir a janela do navegador
            header('Content-Disposition:attachment; filename='.basename($zipado));
            // também informa o nome do arquivo
            readfile($zipado);
            // aborta pos ações
            return;

        }
    }
}