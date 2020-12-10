<!-- Webpage to create a note -->

<?php

// Imports
require "webnote.php";

// Entry point
function main()
{
    if(hasValue("submit"))
    {
        if($_POST["submit"] == "Create Note")
        {
            $note = $_POST["note"];
            $edit = $_POST["edit"];
            $password = hasValue("password") ? $_POST["password"] : NULL;

            createNote($note, $edit, $password);
        }
    }
}

// Execute main
main();

?>

<style>
.submission 
{
    width: 200px;
    height: 200px;
}
</style>


<form action="#" method="post" id="createForm">    
    <textarea class="submission" name="note" form="createForm" placeholder="Note Text"></textarea>
    <br>
  	<span>Note can be edited:</span>
  	<input type="checkbox" name="edit">
  	<br>
	<input type="password" name="password" placeholder="Note password">
  	<br>
    <input type="submit" name="submit" value="Create Note">
</form>