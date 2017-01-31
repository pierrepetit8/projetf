<!DOCTYPE html>
<html lang="en">
<?php
global $rep;
echo require($rep.'html/add.html');

echo '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a class="navbar-brand" href=./Index.php?sub= >uMusic</a>
                </li>
                <li>
                    <a href="./Index.php?sub=add_music">Add music</a>
                </li>
                <li>
                    <a href="#">'.$_SESSION['log'].' (Admin)</a>
                </li>
                <li>
                    <a href="./Index.php?sub=logout">Log out</a>
                </li>
            </ul>
        </div>
      </nav>';
?>
</html>



