<?php

// Imports
require "webnote.php";

// Entry point
function main()
{
    if(hasValue("submit"))
    {
        if($_POST["submit"] == "Create note")
        {
            $note = $_POST["note"];
            $edit = hasValue("edit") ? "true" : "false";
            $password = hasValue("password") ? $_POST["password"] : NULL;

            $id = createNote($note, $edit, $password);

            echo "<script>alert(\"Note created (ID: $id)\");</script>";
        }
    }
}

// Execute main
main(); ?>

<!-- Web-Note created by Cesar Ubaldo Carrillo -->
<!-- index.html : webpage to create a note     -->
<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Web-Note Creator</title>
        <script>
            // button function to return to main page
            function rtMain() { ; }
        </script>
    </head>
    <body>
        <div class="pageContainer">
            <form action="#" method="post" id="createForm">
                <div class="pageBlock"> 
                    <h1>Create Note</h1>
                </div>

                <div class="pageBlock"> 
                    <textarea class="textSubmission" name="note" form="createForm" placeholder="Note Text"></textarea>    
                </div>

                <div class="pageBlock">
                    <input class="check" id="editCheck" type="checkbox" name="edit">
                    <label class="centerText" for="editCheck">Note can be edited</label>
                </div>

                <div class="pageBlock">
                    <input class="textBox" type="password" name="password" placeholder="Note password">
                </div>
                
                <div class="pageBlock">
                    <input class="button" type="submit" name="submit" value="Create note">
                </div>
            </form>
            
            <div class="pageBlock">
                <input class="button" type="button" value="Return to main page" onclick="rtMain();">
            </div>

            <div class="pageBlock">
                <h2>Created by Cesar Ubaldo Carrillo 
                <h2>website version 1.0</h2>
            </div>
        </div>
    </body>
</html>