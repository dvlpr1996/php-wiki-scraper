<?php

namespace app\Core\Adapter;

use Dotenv\Dotenv;
use Exception;

class DotEnvAdapter
{
    private $dotenv;

    public function __construct(string $dotEnvPath)
    {
        $this->dotenv = Dotenv::createImmutable($dotEnvPath);
    }

    private function loadDotEnv(string $loadType)
    {
        $this->dotenv->$loadType();
    }

    public function requiredElement()
    {
        $this->loadDotEnv("safeLoad");

        try {
            $this->dotenv->required('SITE_TITLE')->notEmpty();
            $this->dotenv->required('APP_NAME')->notEmpty();
            $this->dotenv->required('BASE_PATH')->notEmpty();
            $this->dotenv->required('BASE_URL')->notEmpty();
            $this->dotenv->required('ROUTER_DEBUG')->notEmpty();
            $this->dotenv->required('DISPLAY_ERRORS')->notEmpty();
            $this->dotenv->required('DISPLAY_STARTUP_ERRORS')->notEmpty();
            $this->dotenv->required('ERROR_REPORTING')->notEmpty();
        } catch (Exception $e) {
           die($e->getMessage());
        }
    }
}
