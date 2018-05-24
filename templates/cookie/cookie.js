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
