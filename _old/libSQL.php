<?php

/* Connects to the database */
function connectDB()
{
    // variables to connect to the database
    $dbhost     = getenv("MYSQL_SERVICE_HOST");
    $dbusername = getenv("dbusername");
    $dbpassword = getenv("dbpassword");
    $dbname     = getenv("dbname");

    // actual connection
    $connection = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    return $connection; // return connection
}

/* Disconnectes a connection */
function disconnectDB($connection) { $connection->close(); }

?>