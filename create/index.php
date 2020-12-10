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
            $edit = hasValue("edit") ? "true" : "false";
            $password = hasValue("password") ? "'".$_POST["password"]."'" : NULL;

            $id = createNote($note, $edit, $password);

            echo "<script>alert(\"Note created (ID: $id)\");</script>";
        }
    }
}

// Execute main
main(); ?>

<!-- Webpage to create a note -->
<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="centerBorder">
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
        </div>
    </body>
</html>