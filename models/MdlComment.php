<?php

/**
 * Created by PhpStorm.
 * User: hpiat
 * Date: 09/01/2017
 * Time: 12:25
 */
class MdlComment
{
    private $new_tab;

    public function getAllComments($id) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $c  = new CommentGateway($con);
        $results = $c->findAll($id);
        foreach ($results as $comment) {
            $new_comment = new Comment($comment[1], $comment[2]);
            $new_comment->setId($comment[0]);
            $this->new_tab[] = $new_comment;
        }
        return $this->new_tab;
    }

    public function addComment($comment) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $c  = new CommentGateway($con);
        $id = $c->insert($comment->getText(),$comment->getIdMusic());
        $comment->setId($id);
    }

    public function deleteComment($id) {
        global $base,$log_db,$pass_db;
        $con = new Connection($base,$log_db,$pass_db);
        $c = new CommentGateway($con);
        if ($c->delete($id))
            return true;
        return false;
    }
}