<?php

if(isset($_POST["ip"]))
{
    echo "processing";
    
    $serverName = $_POST["ip"];
    $serverUsername = "webnoteusr";
    $serverPassword = "webnoteusr";
    $serverName = "webnote";

    $connect = mysqli_connect($serverName, $serverUsername, $serverPassword, $serverName);
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