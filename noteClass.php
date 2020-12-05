<?php
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
        $this->canEdit  = $edit;
        $this->password = $password;

        // Connect to the database
        $connection = connectDB();

        // Create the insert query
        // ID auto creates
        $query = "INSERT INTO notes (note, edit, password) VALUES ($message, $edit, $password);";
        
        // Attempt the query
        if(mysqli_query($connection, $query))
        {
            // Check what ID we are up to
            $query = "SELECT * FROM notes";

            $idCount = mysql_num_rows($query);

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
    function canEdit()      { return $this->canEdit; }
    function getPassword()  { return $this->password; }
}
?>