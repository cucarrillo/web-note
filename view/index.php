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
            updateNote($_POST["noteID"], $_POST["noteMSG"]);
        }
    }
}

// Execute main
main();

?>

<style>
.submission 
{
    width: 200px;
    height: 200px;
}
</style>


<form action="#" method="post" id="updateForm">
    
    <!-- Form to load a note -->
    <span>Note ID: </span>
    <input type="text" name="id" placeholder="I.E: 2163" value="<?php echo hasValue('id') ? $_POST['id'] : ''; ?>">
    <input type="submit" name="submit" value="Load Note">
    
    <br>
    <br>

    <!-- Note load -->
    <textarea class="submission" 
                name="noteMSG" 
                form="updateForm" 
                placeholder="Note Text" 
                <?php /* Check if the note is editable */ echo loadNote($_POST['id'])[1] ? '' : 'disabled' ?>
                ><?php /* Load the note */ echo hasValue('id') ? loadNote($_POST['id'])[0] : ''; ?></textarea>
    
    <br>
    
    <span>
            <?php /* Alert the user if the note can be edited */ 
            echo loadNote($_POST['id'])[1] ? "This note can be edited" : "This note cannot be edited"; ?>
    </span>
      
    <br>
  	<br>

      <?php $pass = loadNote($_POST['id'])[2];
      
      if($pass == '')
      {
          echo "No password";
      }
      else
      {
          echo "<input type=\"password\" value=\"$pass\" disabled>";
          echo "<input type=\"button\" value=\"Copy Password\" onclick=\"copyPass();\">";
      }
      ?>

    <?php /* If editable then we show the update note button */ 
    echo loadNote($_POST['id'])[1] ? "<input type=\"submit\" name=\"submit\" value=\"Update\">" : ""; ?>
    
</form>