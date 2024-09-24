<?php

namespace app\Core\Config;

use Exception;
use PHPUnit\Runner\FileDoesNotExistException;

class Config
{
    private static ?Config $instance = null;
    private array $configCache = [];

    private function __construct() {}

    public static function getInstance(): Config
    {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }

    private function configPathResolver(string $key): string
    {
        $configFile = CONFIG_PATH . strtolower(explode('.', $key)[0]) . '.php';
        if (!is_file($configFile) || !is_readable($configFile)) {
            throw new FileDoesNotExistException("Config file '{$configFile}' does not exist or is not readable.");
        }
        return $configFile;
    }

    private function configKeyResolver(string $key): string
    {
        $parts = explode('.', $key);
        if (count($parts) < 2) {
            throw new Exception("Invalid config key format. Expected 'file.key'.");
        }
        return $parts[1];
    }

    private function loadConfigData(string $key): array
    {
        $configFile = $this->configPathResolver($key);

        if (isset($this->configCache[$configFile])) {
            return $this->configCache[$configFile];
        }

        $data = require $configFile;

        if (!is_array($data)) {
            throw new Exception("Config file '{$configFile}' data is not a valid array.");
        }

        $this->configCache[$configFile] = $data;

        return $data;
    }

    private function getData(string $key): string
    {
        $configKey = $this->configKeyResolver($key);
        $data = $this->loadConfigData($key);

        if (!array_key_exists($configKey, $data)) {
            throw new Exception("Key '{$configKey}' does not exist in the configuration.");
        }

        return $data[$configKey];
    }

    public function get(string $key): array|string
    {
        $parts = explode('.', $key);

        if (count($parts) === 1) {
            $data = $this->loadConfigData($key);
            return $data;
        }

        return $this->getData($key);
    }
}
