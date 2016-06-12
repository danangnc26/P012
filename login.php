<?php
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'function/route.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Persediaan Barang JJ Education Toys</title>
  <?php include "view/component/head-include.php" ?>
  <style type="text/css">
  .login-page{
    background: #d2d6de url("<?php echo base_url.'assets/img/logo.png' ?>") top left;
    background-size: 150px;
  }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" style="font-size:23px; color:#fff">
   
   <!-- <img src="<?php echo base_url.'assets/img/logo.png' ?>" height="150"> -->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <center><span style="font-size:21px;">Sistem Informasi Persediaan Barang</span><br>
   <span style="font-size:30px;">JJ Education Toys Semarang</span></center>
    <hr style="margin-bottom:10px;">
  	<h3 style="margin-top:0px;">Log In Form</h3>
  	<hr style="margin-top:0px;">

    <form action="<?php echo app_base.'authenticate' ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
        <span class="glyphicon form-control-feedback"><i class="fa fa-user"></i></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon form-control-feedback"><i class="fa fa-lock"></i> </span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php include "view/component/foot-include.php" ?>
</body>
</html>
