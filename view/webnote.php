<?php
/********************************************
 * Author: Cesar Ubaldo Carrillo
 * lib class for views's index.php 
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

/* Loads a note with given ID */
function loadNote($id, $pass)
{
    // connect to the database
    $connection = connectDB();
        
    // MySQL query search
    $query = "SELECT * FROM notes where id = '$id';";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // check if the note exists
    $resultCheck = mysqli_num_rows($result);

    // note properties
    $note = NULL;
    $edit = NULL;
    $password = NULL;

    // if note exists then load
    if($resultCheck > 0)
    {
        // gather results
        while($row = mysqli_fetch_assoc($result))
        {
            $note     = $row['note'];
            $edit     = $row['edit'];
            $password = $row['password'];
        }
    }
    else // if not then return false
    {
        disconnectDB($connection);

        return false;
    }

    // close the connection
    disconnectDB($connection);

    // check if the note requires a password
    if($password != '' && $password != NULL)
    {
        // check if the user provided the correct password
        if($password == $pass)
        {
            // return note
            return array($note, $edit, $password);
        }
        else
        {
            // return error
            return array("Wrong password", false, NULL);
        }
    }
    else
    {
        // return note
        return array($note, $edit, $password);
    }
}

/* Checks if a note exists */
function noteExists($id)
{
    // connect to the database
    $connection = connectDB();

    // MySQL query to find the note
    $query = "SELECT * FROM notes where id='$id'";

    // execute the query
    $result = mysqli_query($connection, $query);
    
    // count how many results we got back
    $resultCheck = mysqli_num_rows($result);

    // close the connection
    disconnectDB($connection);

    // return true if we found more than 1, otherwise return false
    return ($resultCheck > 0) ? true : false;
}

/* Updates a notes message using the given ID */
function updateNote($id, $note)
{
    // check if the note exsists
    if(!noteExists($id)) { return false; }

    // connect to the database
    $connection = connectDB();

    // MySQL query to find the note
    $query = "UPDATE notes SET note='$note' WHERE id = $id;";

    // execute the query
    $result = mysqli_query($connection, $query);

    // close the connection
    disconnectDB($connection);
    
    // return the result
    return $result;
}
?>