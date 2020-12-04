<?php
if(isset($_GET['id']))
{
    $dbhost     = getenv("MYSQL_SERVICE_HOST");
    $dbusername = getenv("dbusername");
    $dbpassword = getenv("dbpassword");
    $dbname     = getenv("dbname");

    $connect = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
    
    $idTest = $_GET['id'];

    $sql = "SELECT * FROM notes where id = '$idTest';";

    $result = mysqli_query($connect, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo $row['note'];
        }
    }

}
?>

<form action="request.php" method="get">
    <input type="text" name="id">
    <input type="submit" name="submit">
</form>