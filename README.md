# OEH WU Header

small class to include the common OEH WU header

## Installation: composer support
    {
        "require": {
            "OEHWU/Header": "~1.0"
        },
        "repositories": [
            {
                "type": "vcs",
                "url": "https://git.oeh-wu.at/header.git"
            }
        ]
    }

## Usage
This package implements one public static method:

    OEHWU\Header\Header::getHeader()

The method returns the Header HTML `string` to be `echo`ed. The *cURL* library has to be installed. Otherwise the method silently fails and returns `null`.