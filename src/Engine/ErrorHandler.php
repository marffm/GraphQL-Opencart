<?php

namespace Src\Engine;

use GraphQL\Error\FormattedError;

class ErrorHandler extends \Exception
{

    /**
     * Returns error based on sent cod
     * @param int $cod
     */
    public static function Error(array $data)
    {
        if(isset($data['errors'][0]['message'])){
            $error = [
                'cod' => (int)$data['errors'][0]['message'],
                'msg' => \Src\Helpers\Messages::getMessage((int)$data['errors'][0]['message'])
            ];
            return $error;
        }
    }


}