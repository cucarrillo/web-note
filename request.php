<?php

/* Connects to the database */
function connectDB()
{
    $dbhost     = getenv("MYSQL_SERVICE_HOST");
    $dbusername = getenv("dbusername");
    $dbpassword = getenv("dbpassword");
    $dbname     = getenv("dbname");

    $connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    return $connect; // return connection
}

class Note
{
    private $note       = null;
    private $id         = null;
    private $canEdit    = null;
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
            $this->canEdit    = $row['canedit'];
            $this->password   = $row['password'];
        }

        // close the connection
        $connection->close();
    }

    function setMessage($note)
    {
        $this->note = $note;
    }
    
    function submit($note)
    {
        
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
    <input type="text" name="id" value="<?php
    
    if(isset($_GET['id']))
    {
        echo $_GET['id'];
    }
    else
    {
        echo "";
    }
    ?>">
    <input type="submit" name="submit">
</form>