<?php

namespace Src\Helpers;

use Src\Helpers\OutputFormatter;

class Output
{

    const OUTPUT_FORMAT = 'json';

    public function __construct(array $data)
    {
        $outputMode = 'output' . ucfirst(self::OUTPUT_FORMAT);
        $output = $this->$outputMode($data);
        echo $output;
    }

    /**
     * Print a json in screen
     * @param array $data
     */
    protected function outputJson(array $data)
    {
        header('Content-Type: application/json', true, !$data['data'] ? 500 : 200);
        $result = json_encode(OutputFormatter::formatOutput($data));
        return $result;
    }

}