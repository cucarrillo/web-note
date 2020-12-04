<?php

if(isset($_GET['ip']))
{
    $dbhost     = getenv("MYSQL_SERVICE_HOST");
    $dbusername = getenv("dbusername");
    $dbpassword = getenv("dbpassword");
    $dbname     = getenv("dbname");

    echo "Connecting to {$dbhost} w/ $dbusername : $dbpassword on $dbname";

    $connect = mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    
    $sql = "SELECT * FROM notes;";
    $result = mysqli_query($connect, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo $row['id'];
            echo $row['note'];
        }
    }

}
?>

<form action="request.php" method="get">
    <input type="text" name="ip">
    <input type="submit" name="ip">
</form>