<!DOCTYPE html>
<html lang="en">

<?php
    global $rep;
    echo require($rep.'html/home.html');

    if (MdlUser::isUser())
        echo '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                <li>
                                     <a class="navbar-brand" href=./Index.php?sub= >uMusic</a>
                                </li>
                                <li>
                                    <a href="#">'.$_SESSION['log'].'</a>
                                </li>
                                <li>
                                    <a href="./Index.php?sub=logout">Log out</a>
                                </li>
                            </ul>
                    </div>
                 </nav>';
    else {
        if (MdlAdmin::isAdmin())
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
        else
            echo '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a class="navbar-brand" href=./Index.php?sub= >uMusic</a>
                            </li>
                            <li>
                                <a href="./Index.php?sub=login_view">Log in</a>
                            </li>
                        </ul>
                    </div>
                 </nav>';
    }

    foreach ((array) $results as $music) {
        echo "<br>";
        echo '<a class=link_home href=./Index.php?sub=music_details&id_music='.$music[0]. '>'.$music[1].'</a>';
        echo '<p class=positive>+'.$music[6].'</p> <p class=neutral>'.$music[8].'</p> <p class=negative>-'.$music[7].'</p>';
        if (MdlAdmin::isAdmin())
            echo '<a class=delete_link href=./Index.php?sub=delete_music&id_music='.$music[0].'>Delete</a>';
        echo "<br>";
    }
?>
</html>


