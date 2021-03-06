<?php
/********************************************
 * Author: Cesar Ubaldo Carrillo
 * main page for view 
********************************************/

/* Imports */
require "webnote.php";

/* PHP Entry code */
function main()
{
    // check if submit has value & if the value is "Update"
    if(hasValue("submit"))
    {
        if($_POST["submit"] == "Update")
        {
            updateNote($_POST["id"], $_POST["note"]); // update the note
        }
    }
}

/* Execute main */
main();?>

<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Note-Share | Viewer</title>
        <script>
            // button function to return to main page
            function rtMain() { window.location.href = "/"; }
        </script>
    </head>
    <body>
        <div class="pageContainer">
            <form action="#" method="post" id="updateForm">
                <div class="pageBlock"> 
                    <h1>View Note</h1>
                </div>
                
                <div class="pageBlock">
                    <input  class="textBox" 
                            type="text" 
                            name="id" 
                            placeholder="Note ID" 
                            value="<?php /* check if value was passed */ echo hasValue('id') ? $_POST['id'] : ''; ?>">
                </div
                >
                <div class="pageBlock">
                    <input  class="textBox" 
                            type="password" 
                            name="password" 
                            placeholder="Note Password" 
                            value="<?php /* check if value was passed */ echo hasValue('password') ? $_POST['password'] : '' ?>">
                </div>

                <div class="pageBlock">
                    <input class="button" type="submit" name="submit" value="Load Note">
                </div>
                
                <br>
                
                <div class="pageBlock">
                    <textarea   class="textSubmission" 
                                name="note" 
                                form="updateForm" 
                                placeholder="Note Text" 
                                <?php /* check if the note is editable */ echo loadNote($_POST['id'], $_POST['password'])[1] ? '' : 'disabled' ?>
                                ><?php /* load the note */ echo hasValue('id') ? loadNote($_POST['id'], $_POST['password'])[0] : ''; ?></textarea>
                </div>

                <?php /* if editable then we show the update note button */ 
                echo loadNote($_POST['id'], $_POST['password'])[1] ? 
                            "<div class=\"pageBlock\"><input class=\"button\" type=\"submit\" name=\"submit\" value=\"Update\"></div>" : 
                            "<div class=\"pageBlock\"><p>This note cannot be changed.</p></div>"; ?>
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