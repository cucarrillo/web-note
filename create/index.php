<?php
/********************************************
 * Author: Cesar Ubaldo Carrillo
 * main page for create 
********************************************/

/* Imports */
require "webnote.php";

/* PHP Entry code */
function main()
{
    // check if the user submited a note
    if(hasValue("submit"))
    {
        if($_POST["submit"] == "Create note")
        {
            // get the values from the forum
            $note       = $_POST["note"];                                   // grab the note itself
            $edit       = hasValue("edit") ? "true" : "false";              // if the check box has a value then the value is true
            $password   = hasValue("password") ? $_POST["password"] : NULL; // if the password has value then we pass the password

            // create the note and get the ID
            $id = createNote($note, $edit, $password);

            // if the note is greater than 0 then it was created
            if($id > 0)
            {
                // success page
                header("location:result.php?result=success&id=$id");
            }
            else
            {
                // failed page
                header("location:result.php?result=failed");
            }
        }
    }
}

/* Execute main */
main(); ?>

<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Note-Share | Creator</title>
        <script>
            // button function to return to main page
            function rtMain() { window.location.href = "/"; }
            function chkDisabled()
            {
                // get textarea and submit button
                var text = document.getElementById("submitText");
                var button = document.getElementById("submitButton");

                // if the text area has text then enable the button
                button.disabled = (text.value.trim() == '');
            }
        </script>
    </head>
    <body>
        <div class="pageContainer">
            <form action="#" method="post" id="createForm">
                <div class="pageBlock"> 
                    <h1>Create Note</h1>
                </div>

                <div class="pageBlock"> 
                    <textarea onkeyup="chkDisabled();" class="textSubmission" name="note" form="createForm" id="submitText" placeholder="Note Text"></textarea>    
                </div>

                <div class="pageBlock">
                    <input class="check" id="editCheck" type="checkbox" name="edit">
                    <label class="centerText" for="editCheck">Note can be edited</label>
                </div>

                <div class="pageBlock">
                    <input class="textBox" type="password" name="password" placeholder="Note password">
                </div>
                
                <div class="pageBlock">
                    <input class="button" type="submit" name="submit" id="submitButton" value="Create note" disabled>
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