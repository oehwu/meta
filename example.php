<?php
require_once 'src/Header.php';
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

<?= OEHWU\Header\Header::getHeader() ?>

</body>
</html>