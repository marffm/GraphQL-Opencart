<?php

namespace Src\Helpers;

class OutputFormatter
{
    /**
     * Set Output data to default format to output
     * @param array $data
     * @return array $formated
     */
    public static function formatOutput(array $data)
    {
        if($data['errors']){
            $error = \Src\Engine\ErrorHandler::Error($data);
        }
        $result = $data;
        $result += [
            'success' => !$error ? 1 : 0,
            'msg' => [
                'cod' => $error['cod']?: 1001,
                'msg' => $error['msg']?: \Src\Helpers\Messages::getMessage(1001)
            ]
        ];
        return $result;
    }

}