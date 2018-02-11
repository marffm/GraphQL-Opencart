<?php

namespace Gpd\Engine;

final class Security
{

    /**
     * @var array
     */
    private $settings;

    /**
     * @var array
     */
    private $publicMethods;

    /**
     * @var string
     */
    private $methodName;

    /**
     * Key sended by client by http header
     * @var string 
     */
    private $key;

    public function __construct(string $key = null, string $methodName = null)
    {
        $this->setSettings();
        if($methodName){
            $this->setPublicMethods();
            $this->methodName = $methodName;
        }
        if($key){
            $this->key = $key;
        }
    }

    /**
     * Check request is allowed
     */
    public function checkSecurity()
    {

        if(!$this->checkSecurityStatus()){
            return true;
        }
        if($this->methodName){
            if($this->checkPublicMethods()){
                return true;
            }
        }
        if($this->key){
            $auth = $this->checkSecurityKey();
            return $auth;
        }
        return false;
    }


    /**
     * Set security settings
     */
    private function setSettings()
    {
        $settings = \Gpd\Helpers\File::getFile('settings');
        if(!$settings){
            throw \GraphQL\Error\Error::createLocatedError(1002);
        }
        $this->settings = $settings['settings']['security'];
    }

    /**
     * Set public methods
     */
    private function setPublicMethods()
    {
        $publicMethods = \Gpd\Helpers\File::getFile('publicMethods');
        if(!$publicMethods){
            throw \GraphQL\Error\Error::createLocatedError(1004);
        }
        $this->publicMethods = $publicMethods;
    }

    /**
     * Checks security status
     */
    private function checkSecurityStatus()
    {
        return $this->settings['status'];
    }

    /**
     * Checks if Method is Public
     * @return boolean
     */
    private function checkPublicMethods()
    {
        return in_array($this->methodName, $this->publicMethods);
    }

    /**
     * Checks if key has authorization to perform the search
     * @return boolean
     */
    private function checkSecurityKey()
    {
        $token = explode('.', $this->key);
        if(!is_array($token)){
            return false;
        }
        // Verifies if Signature is Correct
        if($token[2] != $this->generateSignature($token[0], $token[1])){
            return false;
        }


        $payload = json_decode(base64_decode($token[1]), true);


        // Verifies the expiration data of key
        if(!$this->checkExpirationKey($payload)){
            return false;
        }

        // Verifies if app is Active
        if(!$this->checkActiveApp($payload)){
            return false;
        }
        return true;
    }

    /**
     * Generate Signature to compare with Jwt
     * @param string $header
     * @param string $payload
     * @return string $signature
     */
    private function generateSignature(string $header, string $payload)
    {
        $signature = hash_hmac($this->settings['encryptType'], "$header.$payload", $this->settings['appkey'], true);
        return base64_encode($signature);
    }

    /**
     * Verifies expiration of key
     * @param array $payload
     */
    private function checkExpirationKey($payload)
    {
        if($payload['exp'] && $payload['exp'] > time()){
            return true;
        }
        return false;
    }

    /**
     * Checks if app is still active
     * @param array $payload
     */
    private function checkActiveApp($payload)
    {
        $args['app_key'] = $payload['app_key'];
        $modelAplicacoes = new \Gpd\Model\AppCore\AplicacoesModel(null, $args);
        $aplicacao = $modelAplicacoes->getAplicacoes($args);
        if($aplicacao && $aplicacao['ativo']){
            return true;
        }
        return false;
    }

    /**
     * 
     */
    // private function generateHeader(){
    //     $header = [
    //         'typ' => 'JWT',
    //         'alg' => 'HS256'
    //     ];
    //     return base64_encode(json_encode($header));
    // }

    /**
     * 
     */
    // private function generatePayload(){
    //     $payload = [
    //         'app_key' => '9VAeeySkbw5VxRfdcbwhdsnmUgFtwtB7Ng5Zv8GC6JaNgaGtB7rKLZurUwMs9epvHC2xAWv8CLaRRwAJD7b4e4PahjnjjXByvGbfEuWkfJbeuWzcM3hu5Pew52fkjqSa',
    //         'exp' => time() + ($this->settings['exp']*60*60)
    //     ];
    //     return base64_encode(json_encode($payload));
    // }


}