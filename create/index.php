<?php
/* Imports */
require "webnote.php";

/* PHP Entry code */
function main()
{
    // Check if the user submited
    if(hasValue("submit"))
    {
        if($_POST["submit"] == "Create note")
        {
            // Get the values from the forum
            $note = $_POST["note"]; // grab the note itself
            $edit = hasValue("edit") ? "true" : "false"; // if the check box has a value then the value is true
            $password = hasValue("password") ? $_POST["password"] : NULL; // if the password has value then we pass the password

            // create the note and get the ID
            $id = createNote($note, $edit, $password);

            if($id > 0)
            {
                header("location:result.php?result=success&id=$id");
            }
            else
            {
                header("location:result.php?result=failed");
            }

            echo "<script>alert(\"Note created (ID: $id)\");</script>";
        }
    }
}

/* Execute main */
main(); ?>

<!-- Web-Note created by Cesar Ubaldo Carrillo -->
<!-- index.html : webpage to create a note     -->
<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Note-Share | Creator</title>
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