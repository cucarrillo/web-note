<?php
// Imports
require "webnote.php";

// Entry Point
function main()
{
    if(hasValue("submit"))
    {
        if($_POST["submit"] == "Update")
        {
            updateNote($_POST["id"], $_POST["note"]);
        }
    }
}

// Execute main
main();?>

<!-- Web-Note created by Cesar Ubaldo Carrillo -->
<!-- index.html : webpage to view/edit a note  -->
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Web-Note Viewer</title>
    </head>
    <body>
        <div class="pageContainer">
            <form action="#" method="post" id="updateForm">
                <div class="pageBlock"> 
                    <h1>Create Note</h1>
                </div>
                <div class="pageBlock">
                    <input class="textBox" type="text" name="id" placeholder="Note ID" value="<?php echo hasValue('id') ? $_POST['id'] : ''; ?>">
                </div>
                <div class="pageBlock">
                    <input class="textBox" type="password" name="password" placeholder="Note Password" value="<?php echo hasValue('password') ? $_POST['password'] : '' ?>">
                </div>

                <div class="pageBlock">
                    <input class="button" type="submit" name="submit" value="Load Note">
                </div>
                
                <br>
                
                <div class="pageBlock">
                    <textarea class="textSubmission" name="note" form="updateForm" placeholder="Note Text" <?php /* Check if the note is editable */ echo loadNote($_POST['id'], $_POST['password'])[1] ? '' : 'disabled' ?>><?php /* Load the note */ echo hasValue('id') ? loadNote($_POST['id'], $_POST['password'])[0] : ''; ?></textarea>
                </div>
                
                <div class="pageBlock">
                    <label>This note can be edited</label>
                </div>

                <?php /* If editable then we show the update note button */ 
                echo loadNote($_POST['id'], $_POST['password'])[1] ? "<div class=\"pageBlock\"><input class=\"button\" type=\"submit\" name=\"submit\" value=\"Update\"></div>" : ""; ?>
            </form>
        </div>
    </body>
</html>