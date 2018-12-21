<?php

namespace IMDterest;

use Exception;

class Comment
{
    private $comment;
    private $postId;
    private $userId;

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }



    public function save()
    {
        try  {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("INSERT INTO comments (comment, postId, userId)
                                    VALUES (:comment, :postId, :userId)");
            $stmt->bindValue(":comment", $this->comment);
            $stmt->bindValue(":postId", $this->postId);
            $stmt->bindValue(":userId", $_SESSION["id"]);
            $stmt->execute();

        }catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function getComments($postId)
    {
        try {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT c.id AS commentId, c.comment, c.timeStamp, u.id AS userId, u.firstname, u.lastname, u.avatar
                                    FROM comments c INNER JOIN users u ON c.userId = u.id
                                    WHERE postId= :postId
                                    ORDER BY c.id");
            $stmt->bindValue(':postId', $postId);
            $stmt->execute();
            $comment = $stmt->fetchAll();
            return $comment;
        } catch (Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}


