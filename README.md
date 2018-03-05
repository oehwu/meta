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

## Usage: StudentId
Since winter semester 2017/2018 student IDs have 8 digits (and a university code letter).

This class provides two static methods to validate and filter/normalize a given student ID and a third combined method for convenience.
Both methods expect the *h* letter (university code letter for WU) to be present in the passed `$studentId`.
 
### Validation:

    OEHWU\Meta\StudentId::isValid(string $studentId): bool

Returns `true` if the student ID is valid, even for converted legacy IDs (e.g. `h01234567` is valid).

### Normalization:

    OEHWU\Meta\StudentId::filter(string $studentId): string

Sanitizes the student ID and returns the normalized variant.
If an e-mail address is provided as `$studenId` it will extract the local part of the address
and assumes that to be the student ID.

Legacy student IDs will be converted to the **old** format, i.e. `h01234567` will be converted to `h1234567`.

See the unit tests file for more examples.

### Combined:

    OEHWU\Meta\StudentId::check(string $studentId): ?string

Normalizes and validates the given `$studentId` and returns the normalized student ID
or `null` if the student ID is not valid. 


## Usage: Header
This class implements one public static method:

    OEHWU\Meta\Header::getHeader()

The method returns the Header HTML `string` to be `echo`ed.
It should be used right after the opening `<body>` tag, with `<body>`'s margin and padding set to `0`.

The *cURL* library has to be installed. Otherwise the method silently fails and returns `null`.

## Usage: CheckSSL
The package has two public static methods:

    OEHWU\CheckSSL\CheckSSL::isSSL()

Returns `bool` `true` or `false`.

    OEHWU\CheckSSL\CheckSSL::redirect()

Redirects the client to the SSL version of the current website, if not already there.
