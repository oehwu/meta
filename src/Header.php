<?php
namespace OEHWU\Header;

/**
 * Class Header
 *
 * Returns the OEH WU header
 *
 * @package OEHWU\Header
 */
class Header
{

    /**
     * @var string URI to fetch
     */
    const HEADER_URL = 'https://oeh-wu.at/snippets/header.html';

    /**
     * @var string filename of temp file
     */
    const TMP_FILENAME = 'oehwu_web_header';

    /**
     * @var int cache time in seconds
     */
    const CACHE_TIME = 24 * 60 * 60;

    /**
     * returns the header HTML as string, or null if it fails
     *
     * @param bool $forceNewLoad don't use a cached version
     * @return null|string
     */
    public static function getHeader($forceNewLoad = false)
    {
        if (!self::hasCurl()) {
            return null;
        }

        $cache = self::fetchCache();
        if (false === $forceNewLoad && null !== $cache) {
            return $cache;
        }

        $c = curl_init();

        curl_setopt($c, CURLOPT_HTTPGET, 1);
        curl_setopt($c, CURLOPT_URL, self::HEADER_URL);
        curl_setopt($c, CURLOPT_AUTOREFERER, 1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($c);
        $header = curl_getinfo($c);

        curl_close($c);

        if ($response === false) {
            return null;
        }

        if ($header['http_code'] != 200) {
            return null;
        }

        self::writeCache($response);

        return $response;
    }

    /**
     * @return bool
     */
    private static function hasCurl()
    {
        return (function_exists('curl_init')) ? true : false;
    }

    /**
     * @return null|string
     */
    private static function fetchCache()
    {
        $fileName = self::getFileName();

        if (!file_exists($fileName)) {
            return null;
        }

        if (filemtime($fileName) + self::CACHE_TIME < time()) {
            unlink($fileName);
            return null;
        }

        return file_get_contents($fileName);
    }

    /**
     * @param string $headerStr
     */
    private static function writeCache($headerStr)
    {
        $fileName = self::getFileName();

        if (!is_writable($fileName)) {
            return;
        }

        $res = fopen($fileName, 'w');
        fwrite($res, $headerStr);
        fclose(($res));
    }

    /**
     * @return string
     */
    private static function getFileName()
    {
        return sys_get_temp_dir() . '/' . self::TMP_FILENAME;
    }
}
