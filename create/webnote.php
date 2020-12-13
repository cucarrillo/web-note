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

function hasValue($value) { return isset($_POST[$value]) && !empty(trim($_POST[$value])); }

/* Creates a note and returns the ID */
// NOTE: -1 is an error code for failing
//       to create the note
function createNote($note, $edit, $password)
{
    // Connect to the database
    $connection = connectDB();


    // If there is no password then we pass NULL, otherwise pass the password
    $noteQuery = mysqli_real_escape_string($connection, $note);
    $passwordQuery = ($password == null) ? 'NULL' : "'".mysqli_real_escape_string($connection, $password)."'";
    
    // MySQL query to add the new note
    $query = "INSERT INTO notes (note, edit, password) VALUES ('$noteQuery', $edit, $passwordQuery);";
    
    $exec = mysqli_query($connection, $query);

    // Execute the query
    if($exec)
    {
        // If it is successful then we return the note ID
        
        // MySQL query to see how many notes we have
        $query = "SELECT * FROM notes;";

        // Execute query
        $queryExecute = mysqli_query($connection, $query);

        // Count the number of rows returned
        $noteCount = mysqli_num_rows($queryExecute);

        // Close the connection
        disconnectDB($connection);

        // Return the result (AKA the note ID)
        return $noteCount;
    }
    else
    {
        // If the execute fails then we return error code -1
        
        return mysqli_error($connection);
        
        disconnectDB($connection);

    }
}