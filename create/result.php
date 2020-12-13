<?php
/********************************************
 * Author: Cesar Ubaldo Carrillo
 * result page for create's index.php 
********************************************/
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Note-Share | Success</title>
        <script>
            // button function to redirect to other pages
            function redirect(location) { window.location.href = "/" + location + "/"; }
        </script>
    </head>
    <body>
        <div class="pageContainer">
            <?php
            // get the result passed
            $result = $_GET["result"];

            if($result == "success")
            {
                $id = $_GET['id'];

                // success HTML
                echo '<div class="pageBlock">';
                echo '<h1>Note Created</h1>';
                echo '<p>Your note ID:</p>';
                echo '<p>#: <strong>'.$id.'</strong></p>';
                echo '<p>Click the button below to view your note</p>';
                echo '</div>';
                echo '<div class="pageBlock">';
                echo '<input class="button" type="button" value="View note" onclick="redirect(\'view\');">';
                echo '</div>';
            }
            else
            {
                // failed HTML
                echo '<div class="pageBlock">';
                echo '<h1>Note Failed to Create</h1>';
                echo '<p>Click below to try again</p>';
                echo '</div>';
                echo '<div class="pageBlock">';
                echo '<input class="button" type="button" value="Create note" onclick="redirect(\'create\');">';
                echo '</div>';
            }
            ?>
            
            <div class="pageBlock">
                <h2>Created by Cesar Ubaldo Carrillo 
                <h2>website version 1.0</h2>
            </div>
        </div>
    </body>
</html>