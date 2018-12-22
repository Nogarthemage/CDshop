<?php include('../assets/incl/global.php'); ?>
<?php
    use CDshop\User;

    spl_autoload_register(function ($class) {
        include_once("../classes/". str_replace('\\', '/', $class) . ".class.php");
    });

    if(!$isAdmin  ){
            header('Location: ../login.php');
    }

    $user = new User();
    $users = $user->getUsers();
?><!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | CD shop</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/foundation.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/stylesheet.css">
  </head>
  <body class="admin">

    <?php include('../assets/incl/header.php'); ?>


    <div class="row">
          <div class="medium-12 columns">
                <h1>User Administration</h1>
                <a href="users-add.php" class="button add"><i class="fas fa-plus-square"></i> Add User</a>

                <div class="row">
                    <div class="large-12 columns">
                                <div class="callout alert" style="display:none;">

                                </div>
                    </div>
                </div>

                <table>
                      <thead>
                        <tr>
                          <th width="">Firstname</th>
                          <th width="">Lastname</th>
                          <th width="">E-mail</th>
                          <th width="">Level</th>
                          <th width=""></th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php
                          if(!empty($users) > 0)
                          {
                              foreach($users as $user)
                              {
                          ?>

                              <tr>
                                <td><?php echo $user['firstname']; ?></td>
                                <td><?php echo $user['lastname']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['level'] ?></td>
                                <td class="text-right">

                                <a class="button" href="users-edit.php?userid=<?php echo $user['userid']; ?>">Edit</a>

                                <?php
                                if($user['userid'] != $userid ) {
                                ?>
                                 <a class="button button-remove" data-userid="<?php echo $user['userid']; ?>" href="#">Remove</a>


                                <?php
                                }
                                ?>
                              </tr>

                          <?php
                              }
                          }
                          ?>

                      </tbody>
                    </table>
          </div>
    </div>


    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="../assets/js/vendor/foundation.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/form-user-remove.js"></script>

  </body>
</html>
