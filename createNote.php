<?php
require "libSQL.php";
require "noteClass.php";

function getNote($noteID)
{
    $note = new Note();

    $note->load($noteID);

    return $note;
}

function hasValue($value)
{
  return isset($_GET[$value]) && !empty(trim($_GET[$value]));
}

function getNoteMessage($noteID)
{
    return getNote($noteID)->getMessage();
}

function updateNote($noteID, $noteMSG, $noteEDIT, $notePASS)
{
    echo "updateD?:D:D:D:";
    $note = getNote($noteID);
    $note->setMessage($noteMSG);

    $note->update();

}

function noteExists($noteID)
{

}

function createNote($note, $edit, $password)
{
    $note = new Note();

    $note->create($note, $edit, $password);
}



/*
function main()
{
    if(isset($_GET['load_id']) && isset($_GET['note']) && isset($_GET['note_update']))
    {
        echo "updated";

        $note = getNote($_GET['load_id']);

        $note->setMessage($_GET['note']);
        $note->update();
    }

    if(!hasValue('load_id') && isset($_GET['note']) && isset($_GET['note_update']))
    {
        echo "created";

        $note = new Note();
        $note->create($_GET['note'], false, null);
    }
}

main();*/

function main()
{
    if(hasValue("submit"))
    {
        if($_GET["submit"] == "Create Note")
        {
            createNote($_GET["noteMSG"], true, null);
        }
    }
}

main();

?>

<style>
.submission 
{
    width: 200px;
    height: 200px;
}
</style>


<form action="createNote.php" method="get" id="createForm">    
    <textarea class="submission" name="noteMSG" form="createForm" placeholder="Note Text"></textarea>
    <br>
  	<span>Note can be edited:</span>
  	<input type="checkbox" name="noteEDIT">
  	<br>
	<input type="password" placeholder="Note password">
  	<br>
    <input type="submit" name="submit" value="Create Note">
</form>