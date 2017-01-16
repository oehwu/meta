# OEH WU Meta

small support classes 

## Installation: composer support
    {
        "require": {
            "oehwu/meta": "~2.0"
        },
        "repositories": [
            {
                "type": "vcs",
                "url": "https://git.oeh-wu.at/oehwu/meta.git"
            }
        ]
    }

## Usage: Header
This package implements one public static method:

    OEHWU\Meta\Header::getHeader()

The method returns the Header HTML `string` to be `echo`ed.
It should be used right after the opening `<body>` tag, with `<body>`'s margin and padding set to `0`.

The *cURL* library has to be installed. Otherwise the method silently fails and returns `null`.
