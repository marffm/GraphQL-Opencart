<?php

namespace Src\Engine;

class AppContext {

    /**
     * Api key
     */
    protected $security;


    public function __construct()
    {
        $this->setSecurity();
    }

    /**
     * Set Security Informations
     */
    protected function setSecurity()
    {
        $this->securityKey = $_SERVER['HTTP_APPKEY'] ?: null;
    }


    /**
     * Get Security
     * @return string
     */
    public function getSecurityKey()
    {
        return $this->securityKey;
    }

}