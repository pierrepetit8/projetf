<?php
/**
 * Created by PhpStorm.
 * User: hpiat
 * Date: 09/01/2017
 * Time: 09:59
 */

global $rep;
echo require($rep.'html/details.html');

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



echo '<h2 class=nameMusic>'.$music->getName().'</h2>';
echo '<p class=nameArtistAlbum>'.$music->getArtist().' - '.$music->getAlbum().'</p>';
echo '<p class=Duration> Duration: '.$music->getDuration().' seconds</p>';
echo '<p class=Upload> Upload: '.$music->getUpload().'</p>';



echo '<div class=comments_div>';
foreach ((array) $results_comments as $comment) {
    echo '<p class=comments>' . $comment->getText() . '</p>';
    if (MdlAdmin::isAdmin())
        echo '<a href=./Index.php?sub=delete_comment&id_comment=' . $comment->getId() . ' class=del_comment >Delete</a>';
}
echo '</div>';
if (MdlAdmin::isAdmin() || MdlUser::isUser()) {
    $_SESSION['id_music'] = $music->getId();
    echo '<a href=./Index.php?sub=vote_positive&id_music='.$_SESSION['id_music'].' class=p_vote_link >+</a>';
    echo '<a href=./Index.php?sub=vote_neutral&id_music='.$_SESSION['id_music'].' class=neu_vote_link >+-</a>';
    echo '<a href=./Index.php?sub=vote_negative&id_music='.$_SESSION['id_music'].' class=n_vote_link >_</a>';
    echo '<div class="container">
            <form action="./Index.php" method="GET" class="commentForm">
                <textarea name="comment" class="commentField"></textarea>
                <br> <br>
                <input type="submit" name="sub" value="Post" class="postButton">
            </form>
          </div>';
}

else {
    echo '<p class=connection_message>You must be connected to vote';
    echo '<p class=comment_message>You must be connected to post a comment';
}