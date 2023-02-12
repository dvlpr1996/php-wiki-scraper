<?php

namespace app\Core\Config;

class Config
{
    private function configPathResolver(string $key): string
    {
        return CONFIG_PATH . strtolower(explode('.', $key)[0]) . '.php';
    }

    private function configKeyResolver(string $key): string
    {
        return explode('.', $key)[1];
    }

    private function getData(string $key): string
    {
        $configKye = $this->configKeyResolver($key);
        $configFile = $this->configPathResolver($key);

        if (!is_file($configFile) && !is_readable($configFile)) {
            die('fileCheck');
        }

        $data = require_once $configFile;

        if (!is_array($data)) {
            die('is_array');
        }

        if (!array_key_exists($configKye, $data)) {
            die('array_key_exists');
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
