<?php

namespace app\Core\Adapter;

use Dotenv\Dotenv;
use Exception;

class DotEnvAdapter
{
    private static ?DotEnvAdapter $instance = null;

    private Dotenv $dotenv;

    private function __construct(string $dotEnvPath)
    {
        $this->dotenv = Dotenv::createImmutable($dotEnvPath);
    }

    public static function getInstance(string $dotEnvPath): DotEnvAdapter
    {
        if (self::$instance === null) {
            self::$instance = new DotEnvAdapter($dotEnvPath);
        }
        return self::$instance;
    }

    public function loadDotEnv(string $loadType = 'load'): void
    {
        if (method_exists($this->dotenv, $loadType)) {
            $this->dotenv->$loadType();
        } else {
            throw new Exception("Invalid load type: {$loadType}");
        }
    }

    public function requiredElement(array $requiredElements): void
    {
        if(empty($requiredElements)) {
            throw new Exception("Required elements can not be empty");
        }

        $this->loadDotEnv("safeLoad");

        try {
            $this->dotenv->required($requiredElements)->notEmpty();
        } catch (Exception $e) {
            die('Environment Error: ' . $e->getMessage());
        }
    }
}
