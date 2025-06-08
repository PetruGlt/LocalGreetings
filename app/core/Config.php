<?php

class Config
{
    private static $data = [];
    private static $loaded = false;

    public static function load(string $file = __DIR__ . '/../.env'): void
    {
        if (self::$loaded) {
            return;
        }

        if (!file_exists($file)) {
            throw new RuntimeException("Config file not found: $file");
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // Skip comments
            if (strpos($line, '#') === 0) {
                continue;
            }

            // Parse key=value
            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);

                $key = trim($key);
                $value = trim($value);

                // Remove surrounding quotes
                $value = preg_replace('/^["\'](.*)["\']$/', '$1', $value);

                self::$data[$key] = $value;

                // Also store in $_ENV and putenv for global use
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }

        self::$loaded = true;
    }

    public static function get(string $key, $default = null)
    {
        return self::$data[$key] ?? $_ENV[$key] ?? getenv($key) ?: $default;
    }
}
