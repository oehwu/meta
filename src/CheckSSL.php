<?php

declare(strict_types=1);

namespace OEHWU\Meta;

use function header;

/**
 * Simple Method to check if the connection to the client is encrypted.
 *
 * The connection to the backend web server is never encrypted, because the SSL wrapper resides
 * on the reverse proxy and encrypts/decrypts at the OEH WU border.
 * The reverse proxy adds an HTTP header to allow the backend web server to determine
 * if the connection was made using https://
 */
final class CheckSSL
{
    /**
     * Returns true if the X-SSL-Request HTTP header is present, thus the client accessed the ressource using https://
     */
    public static function isSSL(): bool
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
     */
    public static function redirect(): void
    {
        if (self::isSSL()) {
            return;
        }
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        $redirect = 'https://' . $host . $requestUri;
        header('Location: ' . $redirect);
    }
}
