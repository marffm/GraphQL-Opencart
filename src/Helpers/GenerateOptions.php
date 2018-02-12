<?php

namespace Src\Helpers;

class GenerateOptions
{

    /**
     * Generate Options
     * @param array $args
     * @return array $options
     */
    public static function generateOptions(array $args) : array
    {
        $options = [];
        if($args['sort']){
            $options += [
                'sort' => [
                    'descricao' => $args['sort']
                ]
            ];
        }
        if($args['offset']){
            $options += ['skip' => $args['offset']];
        }
        if($args['limit']){
            $options += ['limit' => $args['limit']];
        }
        return $options;
    }


}