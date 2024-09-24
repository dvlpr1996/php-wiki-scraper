<?php

namespace app\Core\Adapter;

use Jenssegers\Blade\Blade;
use app\exceptions\ViewDoesNotExistException;

class BladeViewAdapter
{
    private static ?BladeViewAdapter $instance = null;
    private ?Blade $blade = null;

    private const VIEW_EXTENSION = '.blade.php';
    private const CACHE_TPL_PATH = CACHE_PATH . 'views/';

    private function __construct() {}

    public static function getInstance(): BladeViewAdapter
    {
        if (self::$instance === null) {
            self::$instance = new BladeViewAdapter();
        }
        return self::$instance;
    }

    private function load(): Blade
    {
        if (!is_dir(self::CACHE_TPL_PATH)) {
            if (!mkdir(self::CACHE_TPL_PATH, 0755, true)) {
                throw new \RuntimeException('Failed to create cache directory at ' . self::CACHE_TPL_PATH);
            }
        }

        if ($this->blade === null) {
            $this->blade = new Blade(VIEW_PATH, self::CACHE_TPL_PATH);
        }

        return $this->blade;
    }

    private function renderView(string $viewPath, array $viewData = []): void
    {
        $resolvedPath = $this->generateViewPath($viewPath);

        if (!file_exists($resolvedPath)) {
            throw new ViewDoesNotExistException("View file '{$resolvedPath}' does not exist.");
        }

        echo $this->load()->render($viewPath, $viewData);
    }

    private function generateViewPath(string $path): string
    {
        $viewFilePath = str_replace('.', '/', $path);
        return VIEW_PATH . $viewFilePath . self::VIEW_EXTENSION;
    }

    public function display(string $viewPath, array $viewData = []): void
    {
        $this->renderView(strtolower($viewPath), $viewData);
    }
}
