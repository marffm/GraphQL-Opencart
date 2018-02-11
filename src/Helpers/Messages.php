<?php

namespace Gpd\Helpers;

class Messages
{
    /**
     * Returns message related to cod sended
     * @param int $cod
     * @return string $message
     */
    public static function getMessage(int $cod)
    {
        $strings = \Gpd\Helpers\File::getFile('strings');
        if(!$strings[(string)$cod]){
            return $strings['9999'];
        }
        return $strings[(string)$cod];        
    }


}