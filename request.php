<?php
echo "PHP Enabled";

$serverName = "10.116.0.72";
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

?>