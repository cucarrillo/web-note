<?php
require "libSQL.php";
require "noteClass.php";

function getNote($noteID)
{
    $note = new Note();

    $note->load($noteID);

    return $note;
}

/*
if there is an ID then the note exists, so we retrive the note
*/

$hasID = isset($_GET['id']);
$hasNote = isset($_GET['note']);

if($hasID || !$hasNote)
{
    $msg = getNote($_GET['id'])->getMessage();

    echo "Message: \"$msg\"";
} /* if there is no ID and there is text then we create the note */
else if($hasNote)
{
    $msg = getNote($_GET['id'])->getMessage();

    echo "Message: \"$msg\"";
}

function main()
{
    /* We need to check if we the note exists */
    /* To do this we check two variables: ID and NOTE */
    /* 
    
    if and ID was provided then we load the note

    */
}

/* Page entry point */
main();

?>

<!-- Form to load a note -->
<form action="request.php" method="get">
    <span>Load Note: </span>
    <input type="text" name="load_id" value="<?php if(isset($_GET['load_id'])) { echo $_GET['load_id']; } else { echo "NOTE_ID"; }?>">
    <input type="submit" name="note_load" value="Load Note">
</form>

<br>

<!-- Form to create a note -->
<form action="request.php" method="get">
    <span>Note Text: </span>
    <input type="text" name="note" value="<?php if(isset($_GET['load_id'])) { echo getNote($_GET['load_id'])->getMessage(); }?>">
    <br>
    <span>Note ID: <?php if(isset($_GET['load_id'])) { echo $_GET['load_id'] } else { echo "NOTE_ID" } ?></span>
  	<br>
    <span>Can Edit: </span>
    <input type="checkbox" name="edit">
</form>


<!--
<form action="request.php" method="get">
    <span>Note ID: </span>
    <input  type="text" 
            name="id" 
            value="?php  
            if(isset($_GET['id']))
            { echo $_GET['id']; } else { echo ""; } ?>">
    <br>
    <span>Note Text: </span>
    <input  type="textarea"
            name="note" 
            value="?php
            if(isset($_GET['note']))
            { echo $_GET['note']; } else { echo ""; }?>">
    <br>
    <span>Can edit: </span><input type="checkbox" name="canEdit">
    <br>
    <input  type="text"
            name="password" 
            value="?php
            if(isset($_GET['password']))
            { echo $_GET['password']; } else { echo ""; }?>">
    <br>
    <input type="submit" name="submit">
</form>-->