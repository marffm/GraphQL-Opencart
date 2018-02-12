<?php

namespace Src\Helpers;

class File
{

    /**
     * Returns Server Root
     * @return string
     */
    public static function getServerRoot()
    {
        if($_SERVER['DOCUMENT_ROOT']){
            return $_SERVER['DOCUMENT_ROOT'].'/..';
        } else {
            return getcwd();
        }
    }

    /**
     * Get file
     * @param string $nameFile
     * @return mixed $file
     */
    public static function getFile($nameFile)
    {
        $root = self::getServerRoot();
        $file = require $root . '/src//' . $nameFile . '.php';
        return $file;
    }

    /**
     * Returns list of files from Directory specified
     * @param string $directory
     * @return array $files
     */
    public static function getDirectoryFiles(string $directory)
    {
        $dir = self::getServerRoot() . '/src//' . $directory;
        $files = scandir($dir);
        $files = array_slice($files, 2);
        return $files;
    }
    


}