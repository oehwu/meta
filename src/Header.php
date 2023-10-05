<?php

declare(strict_types=1);

namespace OEHWU\Meta;

use function chmod;
use function curl_close;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function fclose;
use function file_exists;
use function file_get_contents;
use function filemtime;
use function fopen;
use function function_exists;
use function fwrite;
use function is_writable;
use function sys_get_temp_dir;
use function time;
use function unlink;

use const CURLOPT_AUTOREFERER;
use const CURLOPT_HTTPGET;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_URL;

/**
 * Returns the OEH WU header
 */
final class Header
{
    /**
     * @var string URI to fetch
     */
    private const HEADER_URL = 'https://oeh-wu.at/snippets/header.html';

    /**
     * @var string filename of temp file
     */
    private const TMP_FILENAME = 'oehwu_web_header';

    /**
     * @var int cache time in seconds
     * 24 * 60 * 60; one day
     */
    private const CACHE_TIME = 86400;

    /**
     * returns the header HTML as string, or null if it fails
     *
     * @param bool $forceNewLoad don't use a cached version
     */
    public static function getHeader(bool $forceNewLoad = false): string|null
    {
        if (!self::hasCurl()) {
            return null;
        }

        $cache = self::fetchCache();
        if ($forceNewLoad === false && $cache !== null) {
            return $cache;
        }

        $c = curl_init();

        curl_setopt($c, CURLOPT_HTTPGET, 1);
        curl_setopt($c, CURLOPT_URL, self::HEADER_URL);
        curl_setopt($c, CURLOPT_AUTOREFERER, 1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($c);
        /** @var array{http_code: int, ...} $header */
        $header = curl_getinfo($c);

        curl_close($c);

        if ($response === false || $response === true) {
            return null;
        }

        if ($header['http_code'] !== 200) {
            return null;
        }

        self::writeCache($response);

        return $response;
    }

    private static function hasCurl(): bool
    {
        return function_exists('curl_init');
    }

    private static function fetchCache(): string|null
    {
        $fileName = self::getFileName();

        if (!file_exists($fileName)) {
            return null;
        }

        if ((int)filemtime($fileName) + self::CACHE_TIME < time()) {
            self::deleteCacheFile($fileName);

            return null;
        }

        $content = file_get_contents($fileName);

        if ($content === false) {
            return null;
        }

        return $content;
    }

    private static function writeCache(string $headerStr): void
    {
        $fileName = self::getFileName();

        if (!is_writable(sys_get_temp_dir())) {
            return;
        }

        if (file_exists($fileName) && !is_writable($fileName)) {
            return;
        }

        $res = fopen($fileName, 'wb');

        if ($res === false) {
            return;
        }

        fwrite($res, $headerStr);
        fclose($res);
        chmod($fileName, 0666);
    }

    private static function getFileName(): string
    {
        return sys_get_temp_dir() . '/' . self::TMP_FILENAME;
    }

    private static function deleteCacheFile(string $fileName): void
    {
        if (!is_writable($fileName)) {
            return;
        }
        unlink($fileName);
    }
}
