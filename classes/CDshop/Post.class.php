<?php

namespace IMDterest;

use Exception;

class Post
{
    private $post;
    private $description;
    private $tag;
    private $cityLocation;

    /**
     * @return mixed
     */
    public function getPost($postId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT DISTINCT p.id AS id, pt.postId AS postId, p.userId AS userId, u.firstname AS userName, t.id AS topicId, t.name AS topic, p.image AS postImage, p.description AS postDescription, p.time AS postDate, p.cityLocation AS cityLocation
                                    FROM  users u INNER JOIN posts p ON u.id = p.userId INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id
                                    WHERE pt.postId =:postId");
        $statement->bindValue(':postId', $postId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        if (!empty($description)) {
            /* field is not empty */
            $this->description = $description;
        } else {
            throw new Exception("Please fill in a description.");
        }
    }

    /**
     * @return mixed
     */
    public function getCityLocation()
    {
        return $this->cityLocation;
    }

    /**
     * @param mixed $cityLocation
     */
    public function setCityLocation($cityLocation)
    {
        $this->cityLocation = $cityLocation;
    }



    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $description
     */
    public function setTag($tag)
    {
        if (!empty($tag)) {
            /* field is not empty */
            $this->description = $tag;
        } else {
            throw new Exception("Please select in a tag.");
        }
    }

    public function getTopics()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT t.name AS name, t.image AS image, count(u.topicid) AS amount, u.topicId AS topicId
                                    FROM topics t INNER JOIN users_topics u ON t.id = u.topicid
                                    GROUP BY 1
                                    ORDER BY t.name desc;");
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getTopicName($topicId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT name
                                    FROM topics
                                    WHERE id=:id");
        $statement->bindValue(':id', $topicId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res[0]['name'];
    }

    public function getRegistrationTopics()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT t.name AS name, t.image AS image, count(u.topicid) AS amount, u.topicId AS topicId
                                    FROM topics t INNER JOIN users_topics u ON t.id = u.topicid
                                    GROUP BY 1
                                    ORDER BY t.name desc LIMIT 5");
        $statement->execute();
        $res = $statement->fetchAll();

        if( empty( $res ) ) {
            $statement = $conn->prepare("SELECT t.name AS name, t.image AS image, count(u.topicid) AS amount, u.topicId AS topicId
                                        FROM topics t INNER JOIN users_topics u ON t.id = u.topicid
                                        GROUP BY 1
                                        ORDER BY t.name desc LIMIT 5");
            $statement->execute();
            $res = $statement->fetchAll();
        }
        return $res;
    }

    public function getFollowerPosts()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT u.firstname, pt.postId AS postId, t.id AS topicId, t.name AS topic, p.image AS postImage, p.description AS postDescription, p.time AS postDate, p.userId AS userId
                                    FROM posts p INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id INNER JOIN users u ON p.userId = u.id
                                    WHERE p.userId IN (SELECT followerId FROM followers WHERE myId =:myId)
                                    GROUP BY postId ORDER BY postDate DESC, 1, 2");
        $statement->bindValue('myId', $_SESSION['id']);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getTopicPosts()
    {
        $userId = $_SESSION['id'];
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT DISTINCT pt.postId AS postId, t.id AS topicId, t.name AS topic, p.image AS postImage, p.description AS postDescription, p.time AS postDate, p.userId AS userId
                                    FROM posts p INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id INNER JOIN users_topics ut ON t.id = ut.topicId INNER JOIN users u ON ut.userId = u.id
                                    WHERE t.id IN (SELECT topicId FROM users_topics WHERE userId=:userId) ORDER BY topic ASC, postDate DESC");
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getSearchedPosts()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT u.firstname, pt.postId AS postId, t.id AS topicId, t.name AS topic, p.image AS postImage, p.description AS postDescription, p.time AS postDate, p.userId AS userId
                                    FROM posts p INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id INNER JOIN users u ON p.userId = u.id
                                    WHERE p.description LIKE :searchqry OR p.cityLocation LIKE :searchqry
                                    ORDER BY postDate DESC, 1, 2");
        $statement->bindValue(":searchqry", '%' . $_GET["searchfield"] . '%');
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getPostLikes($postId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT COUNT(postId) as likes
                                    FROM likes
                                    WHERE postId=:postId
                                    GROUP BY postId");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getUserPosts($userId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT DISTINCT pt.postId AS postId, p.userId AS userId, t.id AS topicId, t.name AS topic, p.image AS postImage, u.firstname, p.description AS postDescription, p.time AS postDate, p.cityLocation AS cityLocation
                                    FROM posts p INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id INNER JOIN users u ON p.userId = u.id
                                    WHERE (userId = :userId)
                                    ORDER BY 1, 2");
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getCertainTopicPosts($topicId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT DISTINCT u.firstname, pt.postId AS postId, p.userId AS userId, t.id AS topicId, t.name AS topic, p.image AS postImage, p.description AS postDescription, p.time AS postDate, p.cityLocation AS cityLocation
                                    FROM posts p INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id INNER JOIN users u ON p.userId = u.id
                                    WHERE topicId = :topicId
                                    ORDER BY 1, 2");
        $statement->bindValue(':topicId', $topicId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getCertainPost($postId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT DISTINCT p.id AS id, pt.postId AS postId, p.userId AS userId, u.firstname AS userName, t.id AS topicId, t.name AS topic, p.image AS postImage, p.description AS postDescription, p.time AS postDate, p.cityLocation AS cityLocation
                                    FROM users u INNER JOIN posts p ON u.id = p.userId INNER JOIN posts_topics pt ON p.id = pt.postId INNER JOIN topics t ON pt.topicId = t.id
                                    WHERE (postId = :postId)");
        $statement->bindValue(':postId', $postId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    public function getLastPostId()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT MAX(id) AS postId
                                    FROM posts");
        $statement->execute();
        $res = $statement->fetch();
        return $res['postId'];
    }

    public function uploadPost($post)
    {
        $target_dir = "posts/";
        $imageFileType = pathinfo(basename($post["name"]), PATHINFO_EXTENSION);
        $target_file = $target_dir . md5($_SESSION["email"] . time()) . "." . $imageFileType;
        $uploadOk = 1;

        if (isset($_POST["submit"])) {
            $check = getimagesize($post["tmp_name"]);
            if ($check == false) {
                throw new Exception("File is not an image.");
                $uploadOk = 0;
            }
        }
        if (file_exists($target_file)) {
            throw new Exception("image already exists.");
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            throw new Exception("Image is not the right filetype.");
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            throw new Exception(" Something went wrong.");
        } else {
            if (move_uploaded_file($post["tmp_name"], $target_file)) {
                $current_user = $_SESSION["id"];
                $conn = Db::getInstance();
                $stmt = $conn->prepare("INSERT INTO posts (image, description, userId, time, cityLocation)
                                        VALUES (:image, :description, :userId, :time, :cityLocation)");
                $stmt->bindValue(":image", $target_file);
                $stmt->bindValue(":description", $this->getDescription());
                $stmt->bindValue(":userId", $current_user);
                $stmt->bindValue(":time", time());
                $stmt->bindValue(":cityLocation", $this->getCityLocation());
                $_SESSION["post"] = $target_file;
                return $stmt->execute();
            } else {
                throw new Exception(" Something went wrong.");
            }
        }
    }

    public function uploadTopic($postId, $topicId)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("INSERT INTO posts_topics (postId, topicId)
                                VALUES (:postId, :topicId)");
        $stmt->bindValue(":postId", $postId);
        $stmt->bindValue(":topicId", $topicId);
        return $stmt->execute();
    }

    public static function convertTime($time)
    {

        // 60s          = 1min
        // 3600s        = 60min = 1h
        // 86400s       = 24h   = 1d
        // 2592000s     = 30d   = 1month
        // 31536000s    = 365d  = 1y

        $currentTime = time();
        $timeAgo = $currentTime - $time;

        if ($timeAgo < 60) { // A second
            $convertedTime = $timeAgo . " seconds ago";
        } elseif ($timeAgo < 3600) { // A minute
            $convertedTime = floor($timeAgo/60) . " minutes ago";
        } elseif ($time < 86400) { // An hour
            $convertedTime = floor($timeAgo/3600) . " hours ago";
        } elseif ($timeAgo < 2592000) { // A day
            $convertedTime = floor($timeAgo/86400) . " days ago";
        } elseif ($timeAgo < 31536000) { // A month
            $convertedTime = floor($timeAgo/2592000) . " months ago";
        } else { // A year
            $convertedTime = floor($timeAgo/31536000) . " year(s) ago";
        }
        return $convertedTime;
    }

    public function checkLike($postId, $isLiked)
    {
        $userId = $_SESSION['id'];
        $conn = Db::getInstance();

        if ($isLiked == 'true') {
            // Put like in database
            $stmt = $conn->prepare("INSERT INTO likes (userId, postId)
                                    VALUES (:userId, :postId)");
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':postId', $postId);
            $stmt->execute();
            echo "like";
        } else {
            // Delete like from database
            $stmt = $conn->prepare("DELETE FROM likes
                                    WHERE userId=:userId AND postId=:postId");
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':postId', $postId);
            $stmt->execute();
            echo "unlike";
        }
    }

    public function getLike($postId)
    {
        $userId = $_SESSION['id'];
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT * FROM likes
                                WHERE userId=:userId AND postId=:postId");
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':postId', $postId);
        $stmt->execute();
        $res = $stmt->fetchAll();

        if(!empty($res)) {
            $liked = 1;
        }
        else {
            $liked = 0;
        }
        return $liked;
    }

    public function deletePost($postId)
    {
        $userId = $_SESSION['id'];

        $conn = Db::getInstance();
        $stmt = $conn->prepare("DELETE FROM posts
                                WHERE userId = :userId AND id = :postId");
        $stmt->bindvalue(':userId', $userId);
        $stmt->bindvalue(':postId', $postId);
        $stmt->execute();
    }

    public function deletePostTopics($postId, $topicId)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("DELETE FROM posts_topics
                                WHERE postId = :postId AND topicId = :topicId ");
        $stmt->bindvalue(':postId', $postId);
        $stmt->bindvalue(':topicId', $topicId);
        $this->getPost($postId);
        $stmt->execute();
        
    
    }
    
    public function countPosts()
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT COUNT(id) as count
                                FROM posts");
        $stmt->execute();
        $countPosts = $stmt->fetch()["count"];
        return $countPosts;
    }
    
    
    public function getPostReports($postId)
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT COUNT(postId) as reports
                                    FROM reports
                                    WHERE postId=:postId
                                    GROUP BY postId");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

   public function checkReport($postId, $isReported)
    {
        $userId = $_SESSION['id'];
        $conn = Db::getInstance();

        if ($isReported == 'true') {
            // Put report in database
            $stmt = $conn->prepare("INSERT INTO reports (userId, postId)
                                    VALUES (:userId, :postId)");
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':postId', $postId);
            print_r($stmt);
            $stmt->execute();
            echo "report";
        } else {
            // Delete report from database
            $stmt = $conn->prepare("DELETE FROM reports
                                    WHERE userId=:userId AND postId=:postId");
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':postId', $postId);
            $stmt->execute();
            echo "unreport";
        }
    }

    public function getReport($postId)
    {
        $userId = $_SESSION['id'];
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT *
                                FROM reports
                                WHERE userId=:userId AND postId=:postId");
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':postId', $postId);
        $stmt->execute();
        $res = $stmt->fetchAll();

        if(!empty($res)) {
            $reported = 1;
        }
        else {
            $reported = 0;
        }
        return $reported;
    }

}
