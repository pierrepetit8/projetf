<!DOCTYPE html>
<html lang="fr">

<h1>ERROR</h1>

<?php

if (isset($dataViewError)) {
    foreach ($dataViewError as $value)
        echo $value;
}
else
    echo "<br>Unknowned Error<br>";

if ($_REQUEST['sub']=='Add song')
    echo "<br> <br> <a href='Index.php?sub=add_music'>Back to add page</a>";

echo "<br> <br> <a href='Index.php'>Home</a>";

?>

</html>