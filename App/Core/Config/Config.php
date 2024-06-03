<?php

namespace app\Core\Config;

use Exception;
use PHPUnit\Runner\FileDoesNotExistException;

class Config
{
    private function configPathResolver(string $key): string
    {
        $configFile = CONFIG_PATH . strtolower(explode('.', $key)[0]) . '.php';
        if (!is_file($configFile) && !is_readable($configFile)) {
            throw new FileDoesNotExistException("{$configFile} File Does Not Exists");
        }
        return $configFile;
    }

    private function configKeyResolver(string $key): string
    {
        return explode('.', $key)[1];
    }

    private function getData(string $key): string
    {
        $configKye = $this->configKeyResolver($key);

        $data = require_once $this->configPathResolver($key);

        if (!is_array($data)) {
            throw new Exception('Config File Data Is Not Valid');
        }

        if (!array_key_exists($configKye, $data)) {
            throw new Exception('Array Key Not Exists');
        }

        return $data[$configKye];
    }

    public function get(string $key): array|string
    {
        if (count(explode('.', $key)) === 1) {
            $data = require_once $this->configPathResolver($key);
            return is_array($data) ? $data : [];
        }
        return $this->getData($key);
    }
}
