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

?>

<!-- Form to load a note -->
<form action="request.php" method="get">
    <span>Load Note: </span>
    <input type="text" name="load_id" value="<?php echo hasValue('load_id') ? $_GET['load_id'] : ""; ?>">
    <input type="submit" name="note_load" value="Load Note">
</form>

<br>

<!-- Form to create a note -->
<form action="request.php" method="get">
    <span>Note Text: </span>
    <input type="text" name="note" value="<?php if(isset($_GET['load_id'])) { echo getNote($_GET['load_id'])->getMessage(); }?>">
    <br>
    <span>Note ID: </span>
    <input type="text" name="load_id" value="<?php if(isset($_GET['load_id'])) { echo $_GET['load_id']; } else { echo ""; } ?>">
  	<br>
    <span>Can Edit: </span>
    <input type="checkbox" name="edit">
    <br>
    <input type="submit" name="note_update" value="Update">
</form>