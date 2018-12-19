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
                /* field is not empty */
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
                /* field is not empty */
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
                /* field is not empty */
                $this->email = $email;
            } else {
                throw new Exception("Please fill in a your email.");
            }
        }


        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            if (strlen($password)>=6) {
                /* field value is bigger as 6 characters */
                $this->password = $password;
            } else {
                throw new Exception("Please fill in password with at least 6 characters.");
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

        public function register()
        {
            echo 'registering';
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
        $stmt->bindValue(':email', $_SESSION['email']);
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

            $_SESSION["firstname"] = $user["firstname"];
            $_SESSION["lastname"] = $user["lastname"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["level"] = $user["level"];
            $_SESSION["id"] = $user["userid"];

            header("Location: index.php");
        } else {
            throw new Exception("Incorrect email and/or password.");
        }
    }

    public function update()
    {
        $_SESSION["firstname"] = $this->firstname;
        $_SESSION["lastname"] = $this->lastname;
        $_SESSION["email"] = $this->email;
        $_SESSION["password"] = $this->password;
        $conn = Db::getInstance();
        if (empty($this->password)) {
            $statement = $conn->prepare("UPDATE users
                                        SET firstname = :firstname, lastname = :lastname, email = :email
                                        WHERE id = :id");
        } elseif (strlen($this->password) < 6) {
            throw new Exception("Please fill in password with at least 6 characters.");
        } else {
            $statement = $conn->prepare("UPDATE users
                                        SET firstname = :firstname, lastname = :lastname, email = :email, password = :password
                                        WHERE id = :id");
            $options = ["cost" => 12];
            $hash = password_hash($this->password, PASSWORD_DEFAULT, $options);
            $statement->bindValue(":password", $hash);
        }
        $statement->bindValue(":firstname", $this->getFirstname());
        $statement->bindValue(":lastname", $this->getLastname());
        $statement->bindValue(":email", $this->getEmail());
        $statement->bindValue(":id", $_SESSION["id"]);
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


    public function deleteUser()
    {
        $userId = $_SESSION['id'];
        $conn = Db::getInstance();

        $statement = $conn->prepare("DELETE FROM user
                                    WHERE id=:id");
        $statement->bindValue(':id', $userId);
        $statement->execute();
    }


    public function checkLevel()
    {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT level FROM user WHERE id = :id");
            $statement->bindValue(":id", $_SESSION["USER_id"]);
            $statement->execute();
            $res = $statement->fetch();
            return $res;
    }

    public function isMember()
    {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT level FROM user WHERE userid = :id");
            $statement->bindValue(":id", $_SESSION["USER_id"]);
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
            $statement->bindValue(":id", $_SESSION["USER_id"]);
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
            if(isset($_SESSION["USER_id"])){
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT level FROM user WHERE userid = :id");
                $statement->bindValue(":id", $_SESSION["USER_id"]);
                $statement->execute();
                $res = $statement->fetch()['level'];

                if( ($res == "member") || ($res === "admin") ) {
                    return true;
                }
            }
            return false;

    }


}
