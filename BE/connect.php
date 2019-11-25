<?php

// db credentials
define('DB_HOST', 'sql.endora.cz:3312');
define('DB_USER', 'clgf');
define('DB_PASS', 'Password01');
define('DB_NAME', 'clgf');

/*
define('DB_HOST', 'localhost');
define('DB_USER', 'clgf');
define('DB_PASS', 'Liberec1');
define('DB_NAME', 'clgf');
*/
// Connect with the database.
function connect()
{
    $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

    if (mysqli_connect_errno($connect)) {
        die("Failed to connect:" . mysqli_connect_error());
    }

    mysqli_set_charset($connect, "utf8");

    return $connect;
}

$con = connect();
