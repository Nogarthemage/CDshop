<?php include('assets/incl/global.php'); ?>
<?php

use CDshop\User;
use CDshop\Errorlog;

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    try {

        if (!empty($_POST)) {
            $email = $_POST['email'];
            $password = $_POST["password"];

            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->login();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();

        $Errorlog = new Errorlog();
        $Errorlog->writeError($e);
    }



?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CD shop - Login</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/foundation.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/stylesheet.css">
  </head>
  <body>


       <?php include('assets/incl/header.php'); ?>

      <div class="row">
            <div class="large-12 columns">
               <h1>Log in</h1
            </div>
      </div>


      <div class="row">

            <div class="medium-6 columns medium-centered">
                <div class="callout">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
                                  <input type="submit" value="Log in" class="button">
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
