<?php include('../assets/incl/global.php'); ?>
<?php

use CDshop\User;

    spl_autoload_register(function ($class) {
        include_once("classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    if(!$isAdmin){
            header('Location: ../login.php');
    }

?><!doctype html>

<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User | CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body class="admin">

    <?php include('../assets/incl/header.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h1>Add User</h1>

                <div class="row">
                    <div class="large-12 columns">
                        <div class="callout alert" style="display:none;"> </div>
                    </div>
                </div>

                <div class="row">

                      <div class="medium-6 columns ">
                          <div class="callout">

                              <form id="form-add-user" action="" method="post">
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
                                            <input type="text" name="email">
                                        </div>
                                  </div>
                                  <div class="row">
                                        <div class="large-4 columns">
                                            <label>Level</label>
                                        </div>
                                        <div class="large-8 columns">
                                            <select name="level">
                                              <option value="admin">admin</option>
                                              <option value="member">member</option>
                                            </select>

                                        </div>
                                  </div>

                                  <div class="row">
                                        <div class="large-4 columns">

                                        </div>
                                        <div class="large-8 columns">
                                            <input type="submit" value="Add user" class="button">
                                        </div>
                                  </div>




                              </form>

                          </div>

                      </div>
                </div>
          </div>
    </div>






    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="../assets/js/vendor/foundation.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/form-user-add.js"></script>

  </body>
</html>
