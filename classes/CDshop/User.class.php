<?php

namespace CDshop;

use Exception;

class User
{

    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $level;


        public function getFirstname()
        {
            return $this->firstname;
        }

        public function setFirstname($firstname)
        {
            if (!empty($firstname)) {
                $this->firstname = $firstname;
            } else {
                throw new Exception("Please fill in your first name.");
            }
        }


        public function getLastname()
        {
            return $this->lastname;
        }

        public function setLastname($lastname)
        {
            if (!empty($lastname)) {
                $this->lastname = $lastname;
            } else {
                throw new Exception("Please fill in your last name.");
            }
        }


        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            if (!empty($email)) {
                $this->email = $email;
            } else {
                throw new Exception("Please fill in your email.");
            }
        }


        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            if (!empty($password)) {
                $this->password = $password;
            } else {
                throw new Exception("Please fill in your password.");
            }
        }


        public function getLevel()
        {
            return $this->level;
        }

        public function setLevel($level)
        {
            if (!empty($level)) {
                /* field is not empty */
                $this->level = $level;
            } else {
                throw new Exception("Please set the level.");
            }
        }


        public function getUser($userId)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT *
                                        FROM user
                                        WHERE userid = :userId");
            $statement->bindValue(":userId", $userId);
            $statement->execute();
            $res = $statement->fetch();
            return $res;
        }

        public function getUsers()
        {
            $conn = Db::getInstance();
            $stmt = $conn->prepare("SELECT * FROM user ORDER BY regdate DESC");
            $stmt->execute();
            $users = $stmt->fetchAll();
            return $users;
        }


        public function register()
        {
            try {

                $conn = Db::getInstance();

                $statement = $conn->prepare("SELECT email
                                            FROM user
                                            WHERE email = :email");
                $statement->bindValue(":email", $this->email);
                $statement->execute();
                $res = $statement->fetch();

                if (!empty($res)) {
                    throw new Exception("This email has already been used.");
                } else {

                    $options=
                    [
                        'cost' => 12
                    ];

                    $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);

                    $statement = $conn->prepare("INSERT INTO user (firstname, lastname, email, password, level, regdate)
                                                VALUES (:firstname, :lastname, :email, :password, :level, :regdate)");
                    $statement->bindValue(":firstname", $this->getFirstname());
                    $statement->bindValue(":lastname", $this->getLastname());
                    $statement->bindValue(":email", $this->getEmail());
                    $statement->bindValue(":password", $hash);
                    $statement->bindValue(":level", $this->getLevel());
                    $statement->bindValue(":regdate", date("Y-m-d H:i"));

                    return $statement->execute();
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
                return $error;
            }
        }

    public function getCurrentUserId()
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT id
                                FROM user
                                WHERE email=:email");
        $stmt->bindValue(':email', $_SESSION['user_email']);
        $stmt->execute();
        $res = $stmt->fetch();
        $lastUserId = $res['id'];

        return $lastUserId;
    }

    public function emailCheck()
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT *
                                FROM user
                                WHERE email = :email");
        $stmt->bindValue(":email", $this->getEmail());
        $stmt->execute();
        $email = $stmt->fetch();
        if(!empty($email)) {
            return false;
        } else {
            return true;
        }
    }

    public function login()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT *
                                    FROM user
                                    WHERE email = :email");
        $statement->bindValue(":email", $this->getEmail());
        $statement->execute();
        $user = $statement->fetch();

        if ($statement->rowCount() == 1 && password_verify($this->getPassword(), $user['password'])) {

            $_SESSION["user_firstname"] = $user["firstname"];
            $_SESSION["user_lastname"] = $user["lastname"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_level"] = $user["level"];
            $_SESSION["user_id"] = $user["userid"];

            header("Location: index.php");
        } else {
            throw new Exception("Incorrect email and/or password.");
        }
    }

    public function updateUserByID($userid)
    {

        $conn = Db::getInstance();
        if (empty($this->password)) {
            $statement = $conn->prepare("UPDATE user
                                        SET firstname = :firstname, lastname = :lastname, email = :email, level = :level
                                        WHERE userid = :id");
        } else {
            $statement = $conn->prepare("UPDATE user
                                        SET firstname = :firstname, lastname = :lastname, email = :email, level = :level, password = :password
                                        WHERE userid = :id");
            $options = ["cost" => 12];
            $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $statement->bindValue(":password", $hash);
        }
        $statement->bindValue(":firstname", $this->getFirstname());
        $statement->bindValue(":lastname", $this->getLastname());
        $statement->bindValue(":email", $this->getEmail());
        $statement->bindValue(":level", $this->getLevel());
        $statement->bindValue(":id", $userid);

        //if admin updating himself, update session variables
        if($_SESSION["user_id"] == $userid){
            $_SESSION["user_firstname"] = $this->firstname;
            $_SESSION["user_lastname"] = $this->lastname;
            $_SESSION["user_email"] = $this->email;
            $_SESSION["user_level"] = $this->level;
        }


        return $statement->execute();
    }


    public function countUsers()
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT COUNT(id) as count
                                FROM user");
        $stmt->execute();
        $countUsers = $stmt->fetch()["count"];
        return $countUsers;
    }


    public function deleteUser($userid)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("DELETE FROM user WHERE userid=:id");
        $statement->bindValue(':id', $userid);
        return $statement->execute();
    }


    public function checkLevel()
    {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT level FROM user WHERE userid = :id");
            $statement->bindValue(":id", $_SESSION["user_id"]);
            $statement->execute();
            $res = $statement->fetch();
            return $res;
    }

    public function isMember()
    {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT level FROM user WHERE userid = :id");
            $statement->bindValue(":id", $_SESSION["user_id"]);
            $statement->execute();
            $res = $statement->fetch()['level'];

            if( $res == "member" ) {
                return true;
            } else {
                return false;
            }
    }

    public function isAdmin()
    {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT level FROM user WHERE userid = :id");
            $statement->bindValue(":id", $_SESSION["user_id"]);
            $statement->execute();
            $res = $statement->fetch()['level'];

            if( $res == "admin" ) {
                return true;
            } else {
                return false;
            }
    }

    public function isRegistered()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT level FROM user WHERE userid = :id");
        $statement->bindValue(":id", $_SESSION["user_id"]);
        $statement->execute();
        $res = $statement->fetch()['level'];

        if( ($res == "member") || ($res === "admin") ) {
            return true;
        }

    }


}
