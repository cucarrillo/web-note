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
    $connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    return $connect; // return connection
}

function log($message) { echo "<script>console.log(\"$message\")</script>"; }

/* Note Class */
class Note
{
    // note properties
    private $note       = null;
    private $id         = null;
    private $edit    = null;
    private $password   = null;

    function __construct($id)
    {
        // Connect to the database
        $connection = connectDB();
        
        // Create the query search
        $query = "SELECT * FROM notes where id = '$id';";

        // Execute the query
        $result = mysqli_query($connection, $query);

        // Gather results
        while($row = mysqli_fetch_assoc($result))
        {
            $this->note       = $row['note'];
            $this->id         = $row['id'];
            $this->edit    = $row['edit'];
            $this->password   = $row['password'];
        }

        // close the connection
        $connection->close();
    }

    /* set the message */
    function setMessage($note)
    {
        $this->note = $note;
    }
    
    function submit($note)
    {
        //"INSERT INTO Students (name, lastname, email) VALUES ('Test', 'Testing', 'Testing@tesing.com')"

        $connection = connectDB();

        $query = "INSERT INTO notes (id, note, edit, password) VALUES ($this->id, $this->note, $this->edit, $this->password)";
        
        if(mysqli_query($connection, $query))
        {
            $noteid = $this->id;

            log("Added note \"$noteid\"");
        }

        $connection->close();
    }

    function getID()        { return $this->id; }
    function getMessage()   { return $this->note; }
    function canEdit()      { return $this->canEdit; }
    function getPassword()  { return $this->password; }
}

function getNote($noteID)
{
    $note = new Note($noteID);

    return $note;
}

if(isset($_GET['id']))
{
    $msg = getNote($_GET['id'])->getMessage();

    echo "Message: \"$msg\"";
}

?>

<form action="request.php" method="get">
    <span>Note ID: </span>
    <input  type="text" 
            name="id" 
            value="<?php  
            if(isset($_GET['id']))
            { echo $_GET['id']; } else { echo ""; } ?>">
    <br>
    <span>Note Text: </span>
    <input  type="textarea"
            name="note" 
            value="<?php
            if(isset($_GET['note']))
            { echo $_GET['note']; } else { echo ""; }?>">
    <br>
    <span>Can edit: </span><input type="checkbox" name="canEdit">
    <br>
    <input type="submit" name="submit">
</form>