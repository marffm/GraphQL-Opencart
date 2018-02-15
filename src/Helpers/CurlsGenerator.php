<?php

namespace Src\Helpers;

class CurlsGenerator 
{


    /**
     * Generates Opencart Api Curls
     * @param array
     * @return
     */
    public static function generateOpencartCurl(array $data)
    {
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'key: ' . $data['dbSettings']['key'];

        $url = self::setUrl($data);
        // echo '<pre>' .json_encode($headers). '</pre>';die;
        $call = curl_init();
        curl_setopt_array($call, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
        ]);

        if($data['method'] == 'GET'){
            curl_setopt_array($call, [
                CURLOPT_CUSTOMREQUEST => $data['method']
            ]);
        } else if($data['method'] == 'POST'){
            curl_setopt_array($call, [
                CURLOPT_CUSTOMREQUEST => $data['method'],
                CURLOPT_POSTFIELDS => json_encode($data['data']),
                CURLOPT_POST => true
            ]);
        }

        curl_setopt_array($call, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        
        return $call;        
    }

    /**
     * Execute Opencart Call
     * @param object $call
     * @return array $response
     */
    public static function executeCurl($call) 
    {
        $response = curl_exec($call);
        curl_close($call);
        return $response;
    }


    /**
     * Generates the Url
     * @param array $query
     * @param array $dbSettings
     */
    private static function setUrl(array $data) : string
    {
        $url = $data['dbSettings']['domain'] . '/api.php//';
        if($data['dbSettings']['dbPrefix']){
            $url .= $data['dbSettings']['dbPrefix'];
        }
        $url .= $data['dbInformation']['collection'] . '/';
        if($data['query']['id']){
            $url .= $data['query']['id'];
        }
        return $url;
    }


}