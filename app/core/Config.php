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
            // Check root directory for .env as fallback
            $rootFile = dirname(__DIR__, 2) . '/.env';
            if (file_exists($rootFile)) {
                $file = $rootFile;
            } else {
                // If neither exists, rely on environment variables (Docker, Cloud platforms)
                self::$loaded = true;
                return;
            }
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

                // Do not override existing system/container environment variables
                $existingEnv = $_ENV[$key] ?? getenv($key);
                if ($existingEnv === false || $existingEnv === null || $existingEnv === '') {
                    self::$data[$key] = $value;
                    $_ENV[$key] = $value;
                    putenv("$key=$value");
                } else {
                    self::$data[$key] = $existingEnv;
                }
            }
        }

        self::$loaded = true;
    }

    public static function get(string $key, $default = null)
    {
        if (!self::$loaded) {
            self::load();
        }

        $val = $_ENV[$key] ?? getenv($key) ?? self::$data[$key] ?? null;
        if ($val !== false && $val !== null && $val !== '') {
            return $val;
        }

        if ($key === 'APP_URL') {
            if (isset($_SERVER['HTTP_HOST'])) {
                $scheme = (
                    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
                ) ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'];
                $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
                $base = ($scriptDir === '/' || $scriptDir === '.') ? '' : $scriptDir;
                return rtrim($scheme . '://' . $host . $base, '/');
            }
            return $default ?? '';
        }

        return $default;
    }
}
