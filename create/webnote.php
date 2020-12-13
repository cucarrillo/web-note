<?php
/********************************************
 * Author: Cesar Ubaldo Carrillo
 * lib class for create's index.php 
********************************************/

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

function hasValue($value) { return isset($_POST[$value]) && !empty(trim($_POST[$value])); }

/* Creates a note and returns the ID */
function createNote($note, $edit, $password)
{
    // connect to the database
    $connection = connectDB();


    // if there is no password then we pass NULL, otherwise pass the password
    $noteQuery     = mysqli_real_escape_string($connection, $note);
    $passwordQuery = ($password == null) ? 'NULL' : "'".mysqli_real_escape_string($connection, $password)."'";
    
    // MySQL query to add the new note
    $query = "INSERT INTO notes (note, edit, password) VALUES ('$noteQuery', $edit, $passwordQuery);";

    // execute the query & get results
    $exec = mysqli_query($connection, $query);

    if($exec)
    {
        // if it is successful then we return the note ID
        
        // MySQL query to see how many notes we have
        $query = "SELECT * FROM notes;";

        // execute query
        $queryExecute = mysqli_query($connection, $query);

        // count the number of rows returned
        $noteCount = mysqli_num_rows($queryExecute);

        // close the connection
        disconnectDB($connection);

        // return the result (AKA the note ID)
        return $noteCount;
    }
    else
    {
        // close the connection
        disconnectDB($connection);

        // if the execute fails then we return the error
        return mysqli_error($connection);
    }
}