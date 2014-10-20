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
     * URI to fetch
     */
    const HEADER_URL = 'https://oeh-wu.at/snippets/header.html';

    /**
     * returns the header HTML as string, or null if it fails
     *
     * @return string|null
     */
    public static function getHeader()
    {
        if (!self::hasCurl()) {
            return null;
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

        return $response;
    }

    private static function hasCurl()
    {
        return (function_exists('curl_init')) ? true : false;
    }
}