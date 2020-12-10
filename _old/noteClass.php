<?php

function createNote($note, $edit, $password)
{
    // Connect to the database
    $connection = connectDB();

    // If there is no password then we pass NULL, otherwise pass the password
    $passwordQuery = ($password == null) ? 'NULL' : $password;

    // MySQL query to add the new note
    $query = "INSERT INTO notes (note, edit, password) VALUES ('$note', $edit, $passwordQuery)";

    // Execute the query
    if(mysqli_query($connection, $query))
    {
        // If it is successful then we return the note ID
        
        // MySQL query to see how many notes we have
        $query = "SELECT * FROM notes;";


        $queryExecute = mysqli_query($connection, $query);

        $noteCount = mysqli_num_rows($queryExecute);

        disconnectDB($connection);

        return $noteCount;
    }
    else
    {
        // If the execute fails then we return error code -1
        disconnectDB($connection);

        return -1;
    }
}

function loadNote($id)
{
    // Connect to the database
    $connection = connectDB();
        
    // MySQL query search
    $query = "SELECT * FROM notes where id = '$id';";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Check if the note exists
    $resultCheck = mysqli_num_rows($result);


    $note = NULL;
    $edit = NULL;
    $password = NULL;

    // if note exists then load
    if($resultCheck > 0)
    {
        // Gather results
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

    return array($note, $edit, $password);
}

function noteExists($id)
{
    // Connect to the database
    $connection = connectDB();

    // MySQL query to find the note
    $query = "SELECT * FROM notes where id='$id'";

    // Count how many results we got back
    $resultCheck = mysqli_num_rows($result);

    // Close the connection
    disconnectDB($connection);

    // Return true if we found more than 1, otherwise return false
    return ($resultCheck > 0) ? true : false;
}

function updateNote($id, $note)
{
    // Check if the note exsists
    if(!noteExists($id)) { return false; }

    // Connect to the database
    $connection = connectDB();

    // MySQL query to find the note
    $query = "UPDATE notes SET note='$note' WHERE id = $id;";

    // Execute the query
    $result = mysqli_query($connection, $query);

    // Close the connection
    disconnectDB($connection);
    
    // Return the result
    return $result;
}

/* Note Class */
class Note
{
    // note properties
    private $note       = null;
    private $id         = null;
    private $edit       = null;
    private $password   = null;

    /* Creates and submits a note to the database */
    function create($message, $edit, $password)
    {
        //"INSERT INTO Students (name, lastname, email) VALUES ('Test', 'Testing', 'Testing@tesing.com')"

        // Set the passed values to the class
        $this->note     = $message;
        $this->edit  = $edit;
        $this->password = $password;

        // Connect to the database
        $connection = connectDB();

        $passwordQuery = $password == null ? 'NULL' : $password;

        // Create the insert query
        // ID auto creates
        $query = "INSERT INTO notes (note, edit, password) VALUES ('$message', $edit, $passwordQuery);";


        
        // Attempt the query
        if(mysqli_query($connection, $query))
        {
            // Check what ID we are up to
            $query = "SELECT * FROM notes;";

            $return = mysqli_query($connection, $query);

            $idCount = mysqli_num_rows($return);
            
            $this->id = $idCount;

            printMessage("Added note \"$this->id\"");
        }
        else // if failed
        {
            printMessage("Failed to add \"$message\"");
        }

        disconnectDB($connection);
    }

    function load($id)
    {
        // Connect to the database
        $connection = connectDB();
        
        // Create the query search
        $query = "SELECT * FROM notes where id = '$id';";

        // Execute the query
        $result = mysqli_query($connection, $query);

        // Check if the note exists
        $resultCheck = mysqli_num_rows($result);

        // if note exists then load
        if($resultCheck > 0)
        {
            // Gather results
            while($row = mysqli_fetch_assoc($result))
            {
                $this->note     = $row['note'];
                $this->id       = $row['id'];
                $this->edit     = $row['edit'];
                $this->password = $row['password'];
            }
        }
        else // if not then return false
        {
            printMessage("Failed to load note for id $id");
            return false;
        }

        // close the connection
        disconnectDB($connection);

        return true;
    }

    function update()
    {
        $connection = connectDB();

        $note = $this->note;
        $id = $this->id;

        echo "NOTE: $note || ";
        echo "ID: $id || ";

        $query = "UPDATE notes SET note='$note' WHERE id = $id;";

        $result = mysqli_query($connection, $query);

        disconnectDB($connection);
    }

    /* set the message */
    function setMessage($note)
    {
        $this->note = $note;
    }

    function getID()        { return $this->id; }
    function getMessage()   { return $this->note; }
    function canEdit()      { return $this->edit; }
    function getPassword()  { return $this->password; }
}
?>