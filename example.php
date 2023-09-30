<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OEH WU Header</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>

<?= OEHWU\Meta\Header::getHeader() ?>

<?= OEHWU\Meta\Cookie::getSnippet() ?>
</body>
</html>
