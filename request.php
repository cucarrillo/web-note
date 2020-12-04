<?php

function getNote($noteID)
{
    $dbhost     = getenv("MYSQL_SERVICE_HOST");
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

    return $noteMSG;
}

if(isset($_GET['id']))
{
    echo getNote($_GET['id']);

}

?>

<form action="request.php" method="get">
    <input type="text" name="id">
    <input type="submit" name="submit">
</form>