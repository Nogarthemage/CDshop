<?php

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
            $user->setLevel('member');
            $user->register();
            $_SESSION['register'] = "true";
            header('Location: login.php');
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
    <title>CD shop - Registration</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/foundation.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
  </head>
  <body>


       <?php include('assets/incl/header.php'); ?>

      <div class="row">
            <div class="large-12 columns">
               <h1>Register as new member</h1
            </div>
      </div>


      <div class="row">

            <div class="medium-6 columns medium-centered">
                <div class="callout">

                    <form id="registrationform" action="" method="post">
                        <div class="row">
                              <div class="large-4 columns">
                                  <label>First name</label>
                              </div>
                              <div class="large-8 columns">
                                  <input id="firstname" type="text" name="firstname" >
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
                                  <input type="password" name="password" >
                              </div>
                        </div>

                        <div class="row">
                              <div class="large-4 columns">

                              </div>
                              <div class="large-8 columns">
                                  <input type="submit" value="Register">
                              </div>
                        </div>

                        <div class="errorfield" style="display:none;">
                            <div class="callout alert">
                             Please fill in all the fields.
                            </div>
                        </div>

                    </form>


                    <div class="form-success" style="display:none">
                        Thanks for registering.<br>
                        <a href="login.php">You can now log in.</a>
                    </div>
                    <div class="form-error" style="display:none">
                         Something went wrong, please try again.
                    </div>


                </div>

            </div>
      </div>


    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/vendor/foundation.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/form-validation-register.js"></script>
  </body>
</html>
