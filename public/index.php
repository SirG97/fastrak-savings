<?php

require_once __DIR__.'/../bootstrap/init.php';

$appName = getenv('APP_NAME');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble</title>

    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    <h1 class=''><?php echo $appName; ?></h1>
    <button class="btn btn-primary"><?php var_dump (in_array('mod_rewrite', apache_get_modules())) ?></button>

    <script src="js/app.js"></script>
</body>
</html>