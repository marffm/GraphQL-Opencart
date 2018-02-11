<?php

namespace Gpd\Engine;

class AppContext {

    /**
     * System's settings file
     * @var array 
     */
    protected $settings;

    protected $security;


    public function __construct()
    {
        $this->setSecurity();
        $this->setSettings();
    }

    /**
     * Set settings file in settings variable
     */
    protected function setSettings()
    {
        $settings = \Gpd\Helpers\File::getFile('settings');
        if(!$settings){
            throw \GraphQL\Error\Error::createLocatedError(1002);
        }
        $this->settings = $settings;
    }

    /**
     * Set Security Informations
     */
    protected function setSecurity()
    {
        $this->securityKey = $_SERVER['HTTP_APPKEY'] ?: false;
    }


    /**
     * Get Security
     * @return string
     */
    public function getSecurityKey()
    {
        return $this->securityKey;
    }

    /**
     * Returns Settings
     * @return array $settings
     */
    public function getSettings(string $name)
    {
        return $this->settings['settings'][$name];
    }

}