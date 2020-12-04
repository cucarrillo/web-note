<?php

function connectDB()
{
    $dbhost     = getenv("MYSQL_SERVICE_HOST");
    $dbusername = getenv("dbusername");
    $dbpassword = getenv("dbpassword");
    $dbname     = getenv("dbname");

    $connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

    return $connect;
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
        $query = "SELECT * FROM notes where id = '$noteID';";

        // Execute the query
        $result = mysqli_query($connection, $query);

        // Gather results
        while($row = mysqli_fetch_assoc($result))
        {
            $noteMSG = $row['note'];

            $this->note       = $row['note'];
            $this->id         = $row['id'];
            $this->canEdit    = $row['canedit'];
            $this->password   = $row['password'];
        }
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
    return new Note($noteID);
    /*$dbhost     = getenv("MYSQL_SERVICE_HOST");
    $dbusername = getenv("dbusername");
    $dbpassword = getenv("dbpassword");
    $dbname     = getenv("dbname");

    $connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    $noteMSG = null;

    $note = "SELECT * FROM notes where id = '$noteID';";

    $result = mysqli_query($connect, $note);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $noteMSG = $row['note'];
        }
    }

    $connect->close();

    return $noteMSG;*/
}

if(isset($_GET['id']))
{
    echo $_GET['id'];
    
    $msg = getNote($_GET['id'])->getMessage();

    echo "Message: \"$msg\"";
}

?>

<form action="request.php" method="get">
    <input type="text" name="id">
    <input type="submit" name="submit">
</form>