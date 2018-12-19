<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use CDshop\User;

session_start();

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });


    try {
        if (!empty($_POST)) {

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST["password"];

            $user = new User();
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setLevel('user');
            $user->register();
            $_SESSION['register'] = "true";
            header('Location: registered.php');
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD shop - Register</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/foundation.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
  </head>
  <body>


      <div class="bar">
          <div class="row">
                <div class="medium-6 columns">
                    <ul class="menu">
                       <li><a href="/">CDSHOP</a></li>
                     </ul>
                </div>
                <div class="medium-6 columns text-right">
                    <ul class="menu">
                       <li><a href="login.php">Login</a></li>
                       <li><a href="register.php">Register</a></li>
                       <li><a href="login.php"><i class="fas fa-shopping-cart"></i> Shoppingcart</a></li>
                     </ul>
                </div>
          </div>
      </div>

      <div class="row">
            <div class="large-12 columns">
               <h1>Register as new member</h1
            </div>
      </div>


      <div class="row">

            <div class="medium-6 columns medium-centered">
                <div class="callout">

                    <form action="" method="post">
                        <div class="row">
                              <div class="large-4 columns">
                                  <label>First name</label>
                              </div>
                              <div class="large-8 columns">
                                  <input type="text" name="firstname" >
                              </div>
                        </div>
                        <div class="row">
                              <div class="large-4 columns">
                                  <label>Last name</label>
                              </div>
                              <div class="large-8 columns">
                                  <input type="text" name="lastname" >
                              </div>
                        </div>
                        <div class="row">
                              <div class="large-4 columns">
                                  <label>E-mail</label>
                              </div>
                              <div class="large-8 columns">
                                  <input type="text" name="email" >
                              </div>
                        </div>
                        <div class="row">
                              <div class="large-4 columns">
                                  <label>Password</label>
                              </div>
                              <div class="large-8 columns">
                                  <input type="text" name="password" >
                              </div>
                        </div>

                        <div class="row">
                              <div class="large-4 columns">

                              </div>
                              <div class="large-8 columns">
                                  <input type="submit" value="Register">
                              </div>
                        </div>

                        <div class="row">
                            <div class="large-12 columns">
                                <?php if (isset($error)): ?>
                                        <div class="callout alert">
                                            <?php echo $error; ?>
                                        </div>
                                <?php endif; ?>
                            </div>
                        </div>

                    </form>


                </div>

            </div>
      </div>


    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
