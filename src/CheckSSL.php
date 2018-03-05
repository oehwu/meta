<?php

namespace OEHWU\Meta;

/**
 * Class CheckSSL
 *
 * Simple Method to check if the connection to the client is encrypted.
 *
 * The connection to the backend web server is never encrypted, because the SSL wrapper (Pound) resides
 * on the reverse proxy and encrypts/decrypts at the OEH WU border.
 * Pound adds an HTTP header to allow the backend web server to determine if the connection was made using https://
 *
 * @package OEHWU\Meta
 */
class CheckSSL
{
    /**
     * Returns true if the X-SSL-Request HTTP header is present, thus the client accessed the ressource using https://
     *
     * @return bool
     */
    public static function isSSL()
    {
        if (isset($_SERVER['HTTP_X_SSL_REQUEST'])) {
            return true;
        }

        return false;
    }

    /**
     * Redirects the client to HTTPS, if it's not already on HTTPS
     *
     * We don't use $_SERVER['SERVER_PORT'] because the backend server is unaware of the SSL status, thus on port 80
     *
     * @return void
     */
    public static function redirect()
    {
        if (self::isSSL() === true) {
            return;
        }
        $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('Location: ' . $redirect);

        return;
    }
}
