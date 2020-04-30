<?php

require_once __DIR__.'/../bootstrap/init.php';
use Illuminate\Database\Capsule\Manager as Capsule;
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

    <button class="btn btn-primary"></button>
<?php $user = Capsule::table('users')->get();
    var_dump($user);
?>
    <script src="js/app.js"></script>
</body>
</html>