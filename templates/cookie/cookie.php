<script>
    /*!
 * JavaScript Cookie v2.2.0
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
    ;(function (factory) {
        var registeredInModuleLoader = false;
        if (typeof define === 'function' && define.amd) {
            define(factory);
            registeredInModuleLoader = true;
        }
        if (typeof exports === 'object') {
            module.exports = factory();
            registeredInModuleLoader = true;
        }
        if (!registeredInModuleLoader) {
            var OldCookies = window.Cookies;
            var api = window.Cookies = factory();
            api.noConflict = function () {
                window.Cookies = OldCookies;
                return api;
            };
        }
    }(function () {
        function extend() {
            var i = 0;
            var result = {};
            for (; i < arguments.length; i++) {
                var attributes = arguments[i];
                for (var key in attributes) {
                    result[key] = attributes[key];
                }
            }
            return result;
        }

        function init(converter) {
            function api(key, value, attributes) {
                var result;
                if (typeof document === 'undefined') {
                    return;
                }

                // Write

                if (arguments.length > 1) {
                    attributes = extend({
                        path: '/'
                    }, api.defaults, attributes);

                    if (typeof attributes.expires === 'number') {
                        var expires = new Date();
                        expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
                        attributes.expires = expires;
                    }

                    // We're using "expires" because "max-age" is not supported by IE
                    attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

                    try {
                        result = JSON.stringify(value);
                        if (/^[\{\[]/.test(result)) {
                            value = result;
                        }
                    } catch (e) {
                    }

                    if (!converter.write) {
                        value = encodeURIComponent(String(value))
                            .replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
                    } else {
                        value = converter.write(value, key);
                    }

                    key = encodeURIComponent(String(key));
                    key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
                    key = key.replace(/[\(\)]/g, escape);

                    var stringifiedAttributes = '';

                    for (var attributeName in attributes) {
                        if (!attributes[attributeName]) {
                            continue;
                        }
                        stringifiedAttributes += '; ' + attributeName;
                        if (attributes[attributeName] === true) {
                            continue;
                        }
                        stringifiedAttributes += '=' + attributes[attributeName];
                    }
                    return (document.cookie = key + '=' + value + stringifiedAttributes);
                }

                // Read

                if (!key) {
                    result = {};
                }

                // To prevent the for loop in the first place assign an empty array
                // in case there are no cookies at all. Also prevents odd result when
                // calling "get()"
                var cookies = document.cookie ? document.cookie.split('; ') : [];
                var rdecode = /(%[0-9A-Z]{2})+/g;
                var i = 0;

                for (; i < cookies.length; i++) {
                    var parts = cookies[i].split('=');
                    var cookie = parts.slice(1).join('=');

                    if (!this.json && cookie.charAt(0) === '"') {
                        cookie = cookie.slice(1, -1);
                    }

                    try {
                        var name = parts[0].replace(rdecode, decodeURIComponent);
                        cookie = converter.read ?
                            converter.read(cookie, name) : converter(cookie, name) ||
                            cookie.replace(rdecode, decodeURIComponent);

                        if (this.json) {
                            try {
                                cookie = JSON.parse(cookie);
                            } catch (e) {
                            }
                        }

                        if (key === name) {
                            result = cookie;
                            break;
                        }

                        if (!key) {
                            result[name] = cookie;
                        }
                    } catch (e) {
                    }
                }

                return result;
            }

            api.set = api;
            api.get = function (key) {
                return api.call(api, key);
            };
            api.getJSON = function () {
                return api.apply({
                    json: true
                }, [].slice.call(arguments));
            };
            api.defaults = {};

            api.remove = function (key, attributes) {
                api(key, '', extend(attributes, {
                    expires: -1
                }));
            };

            api.withConverter = init;

            return api;
        }

        return init(function () {
        });
    }));

</script>
<script>
    (function cookie() {
        'use strict';

        var COOKIE_CONTAINER = '.cookie-container';

        function attachListeners() {
            var jqBody = $('body');
            jqBody.on('click', COOKIE_CONTAINER + ' button', hideCookieNotice);
        }

        function hideCookieNotice() {
            Cookies.set('cookie-notice', 'ok', {expires: 180});
            $(COOKIE_CONTAINER).hide();
        }

        function showNotice() {
            if (isCookieAlreadySet()) {
                return;
            }
            $(COOKIE_CONTAINER).show();
        }

        function isCookieAlreadySet() {
            return typeof Cookies.get('cookie-notice') !== 'undefined';
        }

        function init() {
            attachListeners();
            showNotice();
        }

        function loadJquery() {
            if (typeof(jQuery) === 'undefined') {
                createScriptTag('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', init);
                return;
            }

            init();
        }

        function createScriptTag(src, onload) {
            var scriptTag = document.createElement('script');
            scriptTag.type = 'text/javascript';
            scriptTag.src = src;
            scriptTag.onload = onload;
            document.getElementsByTagName('head')[0].appendChild(scriptTag);
        }

        window.onload = loadJquery;
    })();
</script>
<div class="cookie-container" style="display: none;
font-family: arial, helvetica, sans-serif;
position: fixed;
bottom: 0;
width: 100%;
background-color: #008bc7;
color: white;
text-align: center;
z-index:1000;
padding: 1em;">
    Wir verwenden Cookies, um deine Benutzererfahrung zu verbessern. Weitere Information findest du in der <a
            href="https://oeh-wu.at/meta/datenschutz" style="text-decoration: underline; color: white;">Datenschutzerklärung</a>.
    <button style="background: none;
border: 2px solid white;
color: white;
border-radius: 15px;
padding: 8px 2rem 8px 2rem;
font-size: 12px;
text-transform: uppercase;
cursor: pointer;
">OK
    </button>
</div>