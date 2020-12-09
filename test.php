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
    $note = getNote($noteID);
    $note->setMessage($noteMSG);

    $note->update();

}

function noteExists($noteID)
{

}

function createNote($note, $edit, $password)
{

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
        if($_GET["submit"] == "Update")
        {
            echo "test";
            updateNote($_GET["noteID"], $_GET["noteMSG"], false, null);
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


<form action="test.php" method="get" id="updateForm">
    
    <!-- Form to load a note -->
    <span>Note ID: </span>
    <input type="text" name="noteID" placeholder="I.E: 2163" value="<?php echo hasValue('noteID') ? $_GET['noteID'] : ''; ?>">
    <input type="submit" name="submit" value="Load Note">
    
    <br>
    <br>

    <!-- Form to create a note -->
    <textarea class="submission" name="noteMSG" form="updateForm" placeholder="Note Text" <?php echo getNote($_GET['noteID'])->canEdit() ? '' : 'disabled' ?>><?php echo hasValue('noteID') ? getNoteMessage($_GET['noteID']) : ''; ?></textarea>
    <br>
    <span><?php echo getNote($_GET['noteID'])->canEdit() ? "This note can be edited" : "This note cannot be edited"; ?></span>
  	<br>
  	<br>

      <?php $pass = getNote($_GET['noteID'])->getPassword(); 
      
      if($pass == '')
      {
          echo "no password";
      }
      else
      {
          echo $pass;
      }

      
      ?>
      	
    <input type="button" value="Copy Password">
    <?php if(getNote($_GET['noteID'])->canEdit()) { echo "<input type=\"submit\" name=\"submit\" value=\"Update\">"; } ?>

    
</form>