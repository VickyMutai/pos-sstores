<?php
include_once 'db/connect_db.php';
session_start();
if(isset($_POST['btn_login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = $pdo->prepare("select * from user where username='$username' AND password='$password'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($row['username']==$username AND $row['password']==$password AND $row['role']=="Admin" AND $row['is_active']=="1"){
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['fullname']=$row['fullname'];
        $_SESSION['role']=$row['role'];
        $message = 'success';
        header('refresh:2;dashboard.php');
    }else if($row['username']==$username AND $row['password']==$password AND $row['role']=="Sales" AND $row['is_active']=="1"){
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['fullname']=$row['fullname'];
        $_SESSION['role']=$row['role'];
        $message = 'success';
        header('refresh:2;dashboard.php');
    }else {
        $errormsg = 'error';
    }

}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sambai Stores | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 4.3 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <link rel="shortcut icon" href="img/logo.jpg">

    <!-- jQuery 3 -->
  <script src="js/jquery.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <!--Sweetalert Plugin --->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page lockscreen">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Sambai Stores|</b>POS</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><b>Login</b></p>

    <form action="" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="text-muted text-center btn-block btn btn-primary btn-rect" name="btn_login" style="color:black; margin-left: 100px;">Log In</button>
        </div>
      </div>
      <?php
        if(!empty($message)){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Login Success", "Welcome '.$_SESSION['role'].'", "success", {
              button: "Continue",
                });
              });
              </script>';
            }else{}
        if(empty($errormsg)){
        }else{
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Login Fail", "Username or Password is Wrong!", "error", {
              button: "Continue",
                });
              });
          </script>';
        }
      ?>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>


</body>
</html>
